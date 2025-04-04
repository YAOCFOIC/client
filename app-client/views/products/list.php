<?php include VIEW_PATH . '../views/partials/header.php'; ?>
<div class="container mt-4">
    <?php if (isset($_SESSION['user']) && $_SESSION['user']['rol'] === 'admin' ) : ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Lista de Productos</h2>
        <a href="<?= BASE_URL ?>/products/create" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nuevo Producto
        </a>
    </div>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($productos as $producto): ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($producto['nombre']) ?></h5>
                        <div class="mb-2">
                            <span class="badge bg-<?= ($producto['stock'] > 0) ? 'success' : 'danger' ?>">
                                <?= ($producto['stock'] > 0) ? 'En stock: ' . $producto['stock'] : 'Agotado' ?>
                            </span>
                        </div>
                        <h4 class="text-primary">$<?= number_format($producto['precio'], 2) ?></h4>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="d-flex justify-content-between">
                            <a href="<?= BASE_URL ?>/products/edit?id=<?= $producto['id'] ?>" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                            <a href="<?= BASE_URL ?>/products/delete?id=<?= $producto['id'] ?>" 
                            class="btn btn-sm btn-outline-danger"
                            onclick="return confirm('¿Seguro que deseas eliminar?')">
                            <i class="bi bi-trash"></i> Eliminar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php elseif (isset($_SESSION['user']) && $_SESSION['user']['rol'] === 'cliente' ) : ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($productos as $producto): ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($producto['nombre']) ?></h5>
                        <div class="mb-2">
                            <span class="badge bg-<?= ($producto['stock'] > 0) ? 'success' : 'danger' ?>">
                                <?= ($producto['stock'] > 0) ? 'En stock: ' . $producto['stock'] : 'Agotado' ?>
                            </span>
                        </div>
                        <h4 class="text-primary">$<?= number_format($producto['precio'], 2) ?></h4>
                    </div>
                    <div class="card-footer bg-transparent">
                        <form action="<?= BASE_URL ?>/cart" method="POST">
                            <input type="hidden" name="id_producto" value="<?= $producto['id'] ?>">
                            <input type="hidden" name="cantidad" value="1"> 
                            <button type="submit" class="btn btn-sm btn-outline-success">
                                <i class="bi bi-cart-plus"></i> Agregar al carrito
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($productos as $producto): ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($producto['nombre']) ?></h5>
                        <div class="mb-2">
                            <span class="badge bg-<?= ($producto['stock'] > 0) ? 'success' : 'danger' ?>">
                                <?= ($producto['stock'] > 0) ? 'En stock: ' . $producto['stock'] : 'Agotado' ?>
                            </span>
                        </div>
                        <h4 class="text-primary">$<?= number_format($producto['precio'], 2) ?></h4>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="card-body">
                            <h5 class="card-title">Descripción</h5>
                            <div class="mb-2">
                                <span class="">
                                    <?= htmlspecialchars($producto['descripcion'])?>
                                </span>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    
</div>

<?php include VIEW_PATH . '../views/partials/footer.php'; ?>