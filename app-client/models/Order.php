<?php

require_once 'Database.php';

class Order {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    // Crear un nuevo pedido
    public function crearPedido($idUsuario, $total) {
        // Insertar el pedido con estado 'pendiente'
        $stmt = $this->db->prepare("INSERT INTO pedidos (id_usuario, total, estado, creado_en) VALUES (?, ?, 'pendiente', NOW())");
        $stmt->execute([$idUsuario, $total]);
        return $this->db->lastInsertId(); // Retorna el ID del nuevo pedido
    }

    // Agregar detalles del pedido
    public function agregarDetalle($idPedido, $idProducto, $cantidad, $precio) {
        $stmt = $this->db->prepare("INSERT INTO detalle_pedido (id_pedido, id_producto, cantidad, precio) VALUES (?, ?, ?, ?)");
        $stmt->execute([$idPedido, $idProducto, $cantidad, $precio]);
    }

    // Obtener pedidos por usuario
    public function getPedidosByUser($idUsuario) {
        // Se muestran solo los pedidos en estado 'pendiente'
        $stmt = $this->db->prepare("SELECT * FROM pedidos WHERE id_usuario = ? AND estado = 'pendiente' ORDER BY creado_en DESC");
        $stmt->execute([$idUsuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener detalles de un pedido específico
    public function getDetallesByPedido($idPedido) {
        $stmt = $this->db->prepare("SELECT dp.*, p.nombre FROM detalles_pedido dp 
                                    JOIN productos p ON dp.id_producto = p.id 
                                    WHERE dp.id_pedido = ?");
        $stmt->execute([$idPedido]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPedidosPaginados($idUsuario, $inicio, $limite) {
        $query = "SELECT * FROM pedidos WHERE id_usuario = ? ORDER BY creado_en DESC LIMIT $inicio, $limite";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$idUsuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function contarPedidos($idUsuario) {
        $query = "SELECT COUNT(*) FROM pedidos WHERE id_usuario = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$idUsuario]);
        return $stmt->fetchColumn(); 
    }

}
