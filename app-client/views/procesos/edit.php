<?php require VIEW_PATH . 'partials/header.php'; ?>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0"><i class="bi bi-pencil-square"></i> Editar Proceso</h3>
        </div>
        
        <div class="card-body">
            <form action="<?= BASE_URL ?>/procesos/update?id=<?= htmlspecialchars($proceso['id']) ?>" method="POST" class="needs-validation" novalidate>
                <!-- Sección Información Básica -->
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <i class="bi bi-info-circle"></i> Información Básica
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="objeto" class="form-label">Objeto</label>
                                <input type="text" class="form-control" id="objeto" name="objeto"
                                       value="<?= htmlspecialchars($proceso['objeto']) ?>" 
                                       placeholder="Descripción breve del proceso" required>
                                <div class="invalid-feedback">
                                    Por favor ingrese el objeto del proceso
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <textarea class="form-control" id="descripcion" name="descripcion"
                                          rows="4" required><?= htmlspecialchars($proceso['descripcion']) ?></textarea>
                                <div class="invalid-feedback">
                                    Por favor ingrese una descripción válida
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="moneda" class="form-label">Moneda</label>
                                <select class="form-select" id="moneda" name="moneda" required>
                                    <option value="COP" <?= $proceso['moneda'] === 'COP' ? 'selected' : '' ?>>Peso Colombiano (COP)</option>
                                    <option value="USD" <?= $proceso['moneda'] === 'USD' ? 'selected' : '' ?>>Dólar Estadounidense (USD)</option>
                                    <option value="EUR" <?= $proceso['moneda'] === 'EUR' ? 'selected' : '' ?>>Euro (EUR)</option>
                                </select>
                                <div class="invalid-feedback">
                                    Seleccione la moneda del proceso
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="presupuesto" class="form-label">Presupuesto</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" class="form-control" id="presupuesto" name="presupuesto"
                                           value="<?= htmlspecialchars($proceso['presupuesto']) ?>" required>
                                    <div class="invalid-feedback">
                                        Ingrese un monto válido
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <label for="actividad" class="form-label">Actividad</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="actividad" name="actividad"
                                           value="<?= htmlspecialchars($proceso['actividad']) ?>" required>
                                    <button class="btn btn-outline-secondary" type="button" 
                                            data-bs-toggle="modal" data-bs-target="#buscarActividadModal">
                                        <i class="bi bi-search"></i> Buscar
                                    </button>
                                    <div class="invalid-feedback">
                                        Seleccione una actividad válida
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sección Cronograma -->
                <div class="card mb-4">
                    <div class="card-header bg-warning text-dark">
                        <i class="bi bi-calendar-event"></i> Cronograma
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="fecha_inicio" class="form-label">Fecha/Hora Inicio</label>
                                <input type="datetime-local" class="form-control" id="fecha_inicio" name="fecha_inicio"
                                       value="<?= date('Y-m-d\TH:i', strtotime($proceso['fecha_inicio'])) ?>" required>
                                <div class="invalid-feedback">
                                    Seleccione fecha y hora de inicio
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="fecha_cierre" class="form-label">Fecha/Hora Cierre</label>
                                <input type="datetime-local" class="form-control" id="fecha_cierre" name="fecha_cierre"
                                       value="<?= date('Y-m-d\TH:i', strtotime($proceso['fecha_cierre'])) ?>" required>
                                <div class="invalid-feedback">
                                    Seleccione fecha y hora de cierre
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sección Documentación -->
                <div class="card mb-4">
                    <div class="card-header bg-secondary text-white">
                        <i class="bi bi-files"></i> Documentación
                    </div>
                    <div class="card-body">
                        <div id="documentosContainer">
                            <!-- Aquí iría la lógica para mostrar documentos existentes -->
                            <div class="documento-item mb-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Título documento">
                                    <button class="btn btn-outline-danger" type="button">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                                <textarea class="form-control mt-2" rows="2" 
                                          placeholder="Descripción opcional"></textarea>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary mt-2">
                            <i class="bi bi-plus"></i> Agregar Documento
                        </button>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="<?= BASE_URL ?>/procesos" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Actualizar Proceso
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require VIEW_PATH . 'partials/footer.php'; ?>