<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Tienda</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <header class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container-fluid">
            <!-- Logo/Marca -->
            <a class="navbar-brand fs-3" href="<?= BASE_URL ?>/products">Mi Tienda</a>
            
            <!-- Botón para móvil -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Elementos de navegación -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <nav class="navbar-nav ms-auto">
                    <a class="nav-link" href="<?= BASE_URL ?>/products">Productos</a>

                    <?php if (isset($_SESSION['user'])): ?>
                        <a class="nav-link" href="<?= BASE_URL ?>/cart/index">Carrito</a>
                        <a class="nav-link" href="<?= BASE_URL ?>/history">Historial</a>
                        <a class="nav-link" href="<?= BASE_URL ?>/procesos">Procesos/Eventos</a>
                        <a class="nav-link text-danger" href="<?= BASE_URL ?>/logout">Salir</a>
                    <?php else: ?>
                        <a class="nav-link" href="<?= BASE_URL ?>/login">Login</a>
                        <a class="nav-link" href="<?= BASE_URL ?>/register">Registrarse</a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </header>


