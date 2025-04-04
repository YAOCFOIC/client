<?php

require_once APP_PATH . '/models/Product.php';

class ProductController {
    private $productModel;

    public function __construct() {
        $this->productModel = new Product();
    }

    public function index() {
        $productos = $this->productModel->getAll();
        require VIEW_PATH . 'products/list.php';
    }

    public function create() {
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = htmlspecialchars($_POST['nombre']);
            $desc = htmlspecialchars($_POST['descripcion']);
            $precio = floatval($_POST['precio']);
            $stock = intval($_POST['stock']);

            $this->productModel->create($nombre, $desc, $precio, $stock);
            header('Location: ' . BASE_URL . '/products');
            exit;
        }

        require VIEW_PATH . 'products/create.php';
    }

    public function edit() {
    
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
        $id = $_GET['id'] ?? null;
        if (!$id) {
            require VIEW_PATH . 'errors/404.php';
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = htmlspecialchars($_POST['nombre']);
            $desc = htmlspecialchars($_POST['descripcion']);
            $precio = floatval($_POST['precio']);
            $stock = intval($_POST['stock']);

            $this->productModel->update($id, $nombre, $desc, $precio, $stock);
            header('Location: ' . BASE_URL . '/products');
            exit;
        }

        $producto = $this->productModel->getById($id);
        require VIEW_PATH . 'products/edit.php';
    }
    public function delete() {
        session_start();
        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
        $id = $_GET['id'] ?? null;
    
        if ($id) {
            $this->productModel->delete($id);
            header('Location: ' . BASE_URL . '/products');
            exit;
        } else {
            http_response_code(400);
            echo "ID no proporcionado.";
        }
    }
}
