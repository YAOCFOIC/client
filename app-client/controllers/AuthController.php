<?php


require_once __DIR__ . '/../models/User.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = htmlspecialchars($_POST['email']);
            $password = $_POST['password'];
            $user = $this->userModel->getByEmail($email);
            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'nombre' => $user['nombre'],
                    'rol' => $user['rol']
                ];
                header('Location: ' . BASE_URL . '/products');
                exit;
            } else {
                $error = "Credenciales inválidas.";
                require VIEW_PATH . 'auth/login.php';
            }
        } else {
            require VIEW_PATH . 'auth/login.php';
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = trim($_POST['nombre']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $password_confirm = $_POST['confirm'];
    
            // Validaciones
            if (empty($nombre) || empty($email) || empty($password) || empty($password_confirm)) {
                $_SESSION['error'] = "Todos los campos son obligatorios.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = "Correo no válido.";
            } elseif (strlen($password) < 6) {
                $_SESSION['error'] = "La contraseña debe tener al menos 6 caracteres.";
            } elseif ($password !== $password_confirm) {
                $_SESSION['error'] = "Las contraseñas no coinciden.";
            } else {
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $result = $this->authModel->registerUser($nombre, $email, $hash);
    
                if ($result) {
                    $_SESSION['success'] = "Registro exitoso. Inicia sesión.";
                    header('Location: ' . BASE_URL . '/login');
                    exit;
                } else {
                    $_SESSION['error'] = "Error al registrar usuario.";
                }
            }
        }
    
        require VIEW_PATH . '/auth/register.php';
    }

    public function logout() {
        session_start(); // Asegurar que la sesión está iniciada
        session_unset(); // Limpiar todas las variables de sesión
        session_destroy(); // Destruir la sesión
    
        // Eliminar la cookie de sesión si existe
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
    
        header('Location: ' . BASE_URL . '/login');
        exit;
    }
}
