<?php include VIEW_PATH . '../views/partials/header.php'; ?>

<div class="container py-4">
    <div class="row justify-content-center">
        
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h2 class="h4 mb-0">Crear Nuevo Producto</h2>
                </div>
                
                <div class="card-body">
                    <form method="POST" action="<?= BASE_URL ?>/products/create" class="needs-validation" novalidate>
                        <!-- Campo Nombre -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" 
                                   placeholder="Ej: Laptop HP 15-dw1024la" required>
                            <div class="invalid-feedback">
                                Por favor ingresa el nombre del producto
                            </div>
                        </div>
                        
                        <!-- Campo Descripción -->
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" 
                                      rows="3" placeholder="Características del producto..."></textarea>
                        </div>
                        
                        <div class="row g-3">
                            <!-- Campo Precio -->
                            <div class="col-md-6">
                                <label for="precio" class="form-label">Precio ($)</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" class="form-control" id="precio" 
                                           name="precio" placeholder="0.00" min="0" required>
                                    <div class="invalid-feedback">
                                        Ingresa un precio válido
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Campo Stock -->
                            <div class="col-md-6">
                                <label for="stock" class="form-label">Stock Disponible</label>
                                <input type="number" class="form-control" id="stock" name="stock" 
                                       placeholder="0" min="0" required>
                                <div class="invalid-feedback">
                                    Ingresa la cantidad disponible
                                </div>
                            </div>
                        </div>
                        
                        <!-- Botones de acción -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <a href="<?= BASE_URL ?>/products" class="btn btn-secondary me-md-2">
                                <i class="bi bi-arrow-left"></i> Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Guardar Producto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Validación de formulario
(function() {
    'use strict'
    
    const forms = document.querySelectorAll('.needs-validation')
    
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            
            form.classList.add('was-validated')
        }, false)
    })
})()
</script>

<?php include VIEW_PATH . '../views/partials/footer.php'; ?>