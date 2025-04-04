<?php
require_once APP_PATH . '/models/Product.php';
require_once APP_PATH . '/models/Order.php';

class OrderController {
    private $productModel;
    private $orderModel;

    public function __construct() {
        // Asegúrate de que la sesión esté iniciada
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->productModel = new Product();
        $this->orderModel = new Order();
    }

    public function cart() {
        // Validar que el usuario esté autenticado
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    
        // Inicializar el carrito si no existe
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
        }
    
        // Si se agrega un producto al carrito
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_producto']) && !isset($_POST['confirmar_pedido'])) {
            $id = intval($_POST['id_producto']);
            $cantidad = intval($_POST['cantidad']);
            $producto = $this->productModel->getById($id);
        
            if ($producto && $producto['stock'] >= $cantidad) {
                if (isset($_SESSION['carrito'][$id])) {
                    $_SESSION['carrito'][$id]['cantidad'] += $cantidad;
                } else {
                    $_SESSION['carrito'][$id] = [
                        'id'       => $producto['id'],
                        'nombre'   => $producto['nombre'],
                        'precio'   => $producto['precio'],
                        'cantidad' => $cantidad
                    ];
                }
            }
        }
        
    
        // Si se envía la confirmación del pedido
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmar_pedido'])) {
            $this->confirmarPedido();
        }

        require VIEW_PATH . '/orders/cart.php';
    }
    
    public function confirmarPedido() {
        // Validar que el usuario esté autenticado
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    
        // Verificar que el carrito no esté vacío
        if (empty($_SESSION['carrito'])) {
            header('Location: ' . BASE_URL . '/cart');
            exit;
        }
    
        $idUsuario = $_SESSION['user']['id'];
        // Calcular el total de la compra solo con los pedidos pendientes
        $total = array_sum(array_map(function($item) {
            return $item['precio'] * $item['cantidad'];
        }, $_SESSION['carrito']));
    
        // Crear el pedido en la base de datos con estado 'pendiente'
        $idPedido = $this->orderModel->crearPedido($idUsuario, $total);
    
        // Guardar los detalles del pedido
        foreach ($_SESSION['carrito'] as $item) {
            $this->orderModel->agregarDetalle($idPedido, $item['id'], $item['cantidad'], $item['precio']);
        }
    
        // Limpiar el carrito después de confirmar la compra
        unset($_SESSION['carrito']);
    
        // Redirigir al historial (que muestra solo pedidos pendientes)
        header('Location: ' . BASE_URL . '/orders');
        exit;
    }

    public function clear() {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
        // Eliminar la variable del carrito
        unset($_SESSION['carrito']);
        // Redirigir al carrito
        header('Location: ' . BASE_URL . '/cart');
        exit;
    }
    
    public function history() {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    
        $idUsuario = $_SESSION['user']['id'];
        $limite = 7; // Número de pedidos por página
        $paginaActual = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $inicio = ($paginaActual - 1) * $limite;
    
        // Obtener pedidos paginados
        $pedidos = $this->orderModel->getPedidosPaginados($idUsuario, $inicio, $limite);
        $totalPedidos = $this->orderModel->contarPedidos($idUsuario);
        $totalPaginas = ceil($totalPedidos / $limite);
    
        require VIEW_PATH . '/orders/history.php';
    }

    public function removeFromCart() {
        // Verificar si el usuario está autenticado
        if (!isset($_SESSION['user'])) {
            die("No autenticado.");
        }
    
        // Verificar si hay un ID en la URL
        if (!isset($_GET['id'])) {
            die("ID de producto no encontrado.");
        }
    
        $id = intval($_GET['id']);
    
        // Verificar si el producto está en el carrito en sesión
        if (!isset($_SESSION['carrito'][$id])) {
            die("Producto no está en el carrito.");
        }
    
        unset($_SESSION['carrito'][$id]);
    
        // Redirigir de vuelta al carrito
        header('Location: ' . BASE_URL . '/cart');
        exit;
    }
}
