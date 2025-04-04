<?php include VIEW_PATH . '/partials/header.php'; ?>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Carrito de Compras</h2>
        <a href="<?= BASE_URL ?>/products" class="btn btn-outline-primary">
            <i class="bi bi-arrow-left"></i> Seguir Comprando
        </a>
    </div>

    <?php if (!empty($_SESSION['carrito'])): ?>
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Producto</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-end">Precio Unitario</th>
                        <th class="text-end">Subtotal</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php foreach ($_SESSION['carrito'] as $item): ?>
                        <?php 
                            $subtotal = $item['precio'] * $item['cantidad']; 
                            $total += $subtotal; 
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($item['nombre']) ?></td>
                            <td class="text-center"><?= $item['cantidad'] ?></td>
                            <td class="text-end">$<?= number_format($item['precio'], 2) ?></td>
                            <td class="text-end fw-bold">$<?= number_format($subtotal, 2) ?></td>
                            <td class="text-center">
                            <a href="<?= BASE_URL ?>/orders/removeFromCart?id=<?= $item['id'] ?>" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                <i class="bi bi-trash"></i>
                            </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot class="table-group-divider">
                    <tr>
                        <td colspan="3" class="text-end fw-bold">TOTAL</td>
                        <td class="text-end fw-bold h5 text-primary">$<?= number_format($total, 2) ?></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- Formulario para confirmar la compra -->
        <form method="POST" action="<?= BASE_URL ?>/history">
            <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="<?= BASE_URL ?>/orders/clear" class="btn btn-outline-danger">
                    <i class="bi bi-cart-x"></i> Vaciar Carrito
                </a>
                <button type="submit" name="confirmar_pedido" class="btn btn-success btn-lg px-4">
                    <i class="bi bi-check-circle"></i> Confirmar Compra
                </button>
            </div>
        </form>
    <?php else: ?>
        <div class="alert alert-info text-center py-4">
            <div class="py-3">
                <i class="bi bi-cart-x" style="font-size: 3rem;"></i>
                <h4 class="mt-3">Tu carrito está vacío</h4>
                <p class="mb-3">Agrega productos para comenzar a comprar</p>
                <a href="<?= BASE_URL ?>/products" class="btn btn-primary">
                    <i class="bi bi-bag"></i> Ver Productos
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php include VIEW_PATH . '/partials/footer.php'; ?>
