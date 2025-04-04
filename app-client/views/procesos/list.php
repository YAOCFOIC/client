<?php require VIEW_PATH . '/partials/header.php'; ?>

<div class="container mt-4">
    <!-- Filtros -->
    <div class="card mb-4 shadow">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Filtros de Búsqueda</h5>
        </div>
        <div class="card-body">
            <form method="GET" action="<?= BASE_URL ?>/procesos">
                <div class="row g-3">
                    <div class="col-12 col-md-6 col-lg-3">
                        <input type="text" class="form-control" name="usuario" placeholder="Usuario" 
                               value="<?= htmlspecialchars($_GET['usuario'] ?? '') ?>">
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <input type="text" class="form-control" name="objeto" placeholder="Objeto" 
                               value="<?= htmlspecialchars($_GET['objeto'] ?? '') ?>">
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <input type="text" class="form-control" name="descripcion" placeholder="Descripción" 
                               value="<?= htmlspecialchars($_GET['descripcion'] ?? '') ?>">
                    </div>
                    <div class="col-12 col-md-6 col-lg-2">
                        <input type="text" class="form-control" name="moneda" placeholder="Moneda" 
                               value="<?= htmlspecialchars($_GET['moneda'] ?? '') ?>">
                    </div>
                    <div class="col-12 col-md-6 col-lg-2">
                        <input type="number" step="0.01" class="form-control" name="presupuesto" placeholder="Presupuesto" 
                               value="<?= htmlspecialchars($_GET['presupuesto'] ?? '') ?>">
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <input type="text" class="form-control" name="actividad" placeholder="Actividad" 
                               value="<?= htmlspecialchars($_GET['actividad'] ?? '') ?>">
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <input type="date" class="form-control" name="fecha_inicio" 
                               value="<?= htmlspecialchars($_GET['fecha_inicio'] ?? '') ?>">
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <input type="date" class="form-control" name="fecha_cierre" 
                               value="<?= htmlspecialchars($_GET['fecha_cierre'] ?? '') ?>">
                    </div>
                    <div class="col-12 d-flex justify-content-end gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-funnel"></i> Filtrar
                        </button>
                        <button type="submit" 
                                formaction="<?= BASE_URL ?>/procesos/exportExcel" 
                                class="btn btn-success"
                                title="Exportar a Excel todos los registros filtrados">
                            <i class="bi bi-file-earmark-excel"></i> Exportar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Listado de procesos -->
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Procesos/Eventos</h3>
            <a href="<?= BASE_URL ?>/procesos/create" class="btn btn-light">
                <i class="bi bi-plus-circle"></i> Nuevo Proceso
            </a>
        </div>
        
        <div class="card-body">
            <?php if (empty($procesos)): ?>
                <div class="alert alert-info mb-0">
                    No se encontraron procesos registrados
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Objeto</th>
                                <th>Actividad</th>
                                <th>Estado</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($procesos as $proceso): ?>
                                <tr>
                                    <td class="fw-bold"><?= $proceso['id'] ?></td>
                                    <td><?= htmlspecialchars($proceso['objeto']) ?></td>
                                    <td><?= htmlspecialchars($proceso['actividad']) ?></td>
                                    <td>
                                        <span class="badge bg-<?= 
                                            match($proceso['estado']) {
                                                'activo' => 'success',
                                                'pendiente' => 'warning',
                                                'cancelado' => 'danger',
                                                default => 'secondary'
                                            }
                                        ?>">
                                            <?= htmlspecialchars($proceso['estado']) ?>
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <div class="btn-group" role="group">
                                            <a href="<?= BASE_URL ?>/procesos/edit?id=<?= $proceso['id'] ?>" 
                                               class="btn btn-outline-primary btn-sm"
                                               title="Editar">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="<?= BASE_URL ?>/procesos/delete?id=<?= $proceso['id'] ?>" 
                                               class="btn btn-outline-danger btn-sm"
                                               title="Eliminar"
                                               onclick="return confirm('¿Está seguro de eliminar este proceso?')">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require VIEW_PATH . '/partials/footer.php'; ?>