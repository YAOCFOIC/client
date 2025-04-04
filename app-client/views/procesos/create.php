<?php require VIEW_PATH . '/partials/header.php'; ?>

<div class="container mt-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Crear Nuevo Proceso</h2>
        <a href="<?= BASE_URL ?>/procesos" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <form action="<?= BASE_URL ?>/procesos/store" method="POST" class="needs-validation" novalidate>
        <!-- Sección Información Básica -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <i class="bi bi-info-circle"></i> Información Básica
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label for="objeto" class="form-label">Objeto</label>
                        <input type="text" name="objeto" id="objeto" class="form-control" 
                               placeholder="Ingrese el objeto del proceso" required>
                        <div class="invalid-feedback">
                            Por favor ingrese el objeto del proceso
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <label for="descripcion" class="form-label">Descripción/Alcance</label>
                        <textarea name="descripcion" id="descripcion" class="form-control" 
                                  rows="3" placeholder="Descripción detallada del proceso"></textarea>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="moneda" class="form-label">Moneda</label>
                        <select name="moneda" id="moneda" class="form-select" required>
                            <option value="">Seleccionar...</option>
                            <option value="COP">Peso Colombiano (COP)</option>
                            <option value="USD">Dólar Estadounidense (USD)</option>
                            <option value="EUR">Euro (EUR)</option>
                        </select>
                        <div class="invalid-feedback">
                            Seleccione la moneda del proceso
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="presupuesto" class="form-label">Presupuesto</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" name="presupuesto" id="presupuesto" 
                                   class="form-control" step="0.01" min="0" 
                                   placeholder="Monto presupuestado" required>
                            <div class="invalid-feedback">
                                Ingrese un monto válido
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <label for="actividad" class="form-label">Actividad</label>
                        <div class="input-group">
                            <input type="text" name="actividad" id="actividad" 
                                   class="form-control" placeholder="Buscar actividad" required>
                            <button class="btn btn-outline-secondary" type="button" 
                                    data-bs-toggle="modal" data-bs-target="#buscarActividadModal">
                                <i class="bi bi-search"></i> Buscar
                            </button>
                            <div class="invalid-feedback">
                                Seleccione una actividad
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección Cronograma -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <i class="bi bi-calendar-event"></i> Cronograma
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="fecha_inicio" class="form-label">Fecha/Hora Inicio</label>
                        <input type="datetime-local" name="fecha_inicio" id="fecha_inicio" 
                               class="form-control" required>
                        <div class="invalid-feedback">
                            Seleccione fecha y hora de inicio
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="fecha_fin" class="form-label">Fecha/Hora Cierre</label>
                        <input type="datetime-local" name="fecha_fin" id="fecha_fin" 
                               class="form-control" required>
                        <div class="invalid-feedback">
                            Seleccione fecha y hora de cierre
                        </div>
                    </div>
                </div>
                <div class="alert alert-info mt-3">
                    <h6 class="alert-heading">Flujo de estados:</h6>
                    <div class="d-flex justify-content-between">
                        <span class="badge bg-secondary"><i class="bi bi-hourglass-split"></i> Activo</span>
                        <i class="bi bi-arrow-right text-muted align-self-center"></i>
                        <span class="badge bg-primary"><i class="bi bi-megaphone"></i> Publicado</span>
                        <i class="bi bi-arrow-right text-muted align-self-center"></i>
                        <span class="badge bg-success"><i class="bi bi-clipboard-check"></i> Evaluación</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="reset" class="btn btn-outline-danger">
                <i class="bi bi-x-circle"></i> Limpiar
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Guardar Proceso
            </button>
        </div>
    </form>
</div>

<!-- Modal Búsqueda Actividad -->
<div class="modal fade" id="buscarActividadModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Buscar Actividad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Contenido de búsqueda de actividades aquí -->
                <p class="text-muted">Integrar con maestra de actividades...</p>
            </div>
        </div>
    </div>
</div>

<?php require VIEW_PATH . '/partials/footer.php'; ?>