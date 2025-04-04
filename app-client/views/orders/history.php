<?php require VIEW_PATH . '/partials/header.php'; ?>

<div class="container mt-4">
    <h2>Historial de Pedidos</h2>

    <?php if (empty($pedidos)) : ?>
        <p>No tienes pedidos en tu historial.</p>
    <?php else : ?>
        <table class="table table-bordered table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th class="text-center">ID Pedido</th>
                    <th class="text-center">Pedido</th>
                    <th class="text-center">Fecha</th>
                    <th class="text-center">Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pedidos as $pedido) : ?>
                    <tr>
                        <td class="text-center font-weight-bold"><?= htmlspecialchars($pedido['id']) ?></td>
                        <td class="text-success text-right font-weight-bold">$<?= number_format($pedido['total'], 2) ?></td>
                        <td class="text-center"> <?= date('d/m/Y H:i', strtotime($pedido['creado_en'])) ?></td>
                        
                        <td class="text-center">
                        <?php 
                        $badgeClass = match(strtolower($pedido['estado'])) {
                            'completado' => 'success',
                            'pendiente' => 'warning',
                            'cancelado' => 'danger',
                            default => 'secondary'
                        };
                        ?>
                        <span class="badge badge-pill text-<?=$badgeClass?>">
                            <?= ucfirst($pedido['estado']) ?>
                        </span>
                    </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Paginación -->
        <nav>
            <ul class="pagination ">
                <?php if ($paginaActual > 1) : ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= BASE_URL ?>/history?page=<?= $paginaActual - 1 ?>">Anterior</a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPaginas; $i++) : ?>
                    <li class="page-item <?= $i == $paginaActual ? 'active' : '' ?>">
                        <a class="page-link" href="<?= BASE_URL ?>/history?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($paginaActual < $totalPaginas) : ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= BASE_URL ?>/history?page=<?= $paginaActual + 1 ?>">Siguiente</a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>

    <?php endif; ?>
</div>

<?php require VIEW_PATH . '/partials/footer.php'; ?>
