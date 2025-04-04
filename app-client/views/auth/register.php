<?php include VIEW_PATH . '../views/partials/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4 p-md-5">
                    <h2 class="text-center mb-4 fw-bold">Registro de Usuario</h2>
                    
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <?= htmlspecialchars($error) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
                        <?php unset($_SESSION['success']); ?>
                    <?php endif; ?>
                    
                    <form method="POST" action="<?= BASE_URL ?>/register" class="needs-validation" novalidate>
                        <div class="row g-3">
                            <!-- Campo Nombre -->
                            <div class="col-12">
                                <label for="nombre" class="form-label">Nombre completo</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text">
                                        <i class="bi bi-person"></i>
                                    </span>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        id="nombre" 
                                        name="nombre" 
                                        placeholder="Ej: Juan Pérez" 
                                        required
                                        pattern=".{3,50}"
                                        title="Mínimo 3 caracteres"
                                    >
                                    <div class="invalid-feedback">
                                        Por favor ingresa tu nombre completo
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Campo Email -->
                            <div class="col-12">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                    <input 
                                        type="email" 
                                        class="form-control" 
                                        id="email" 
                                        name="email" 
                                        placeholder="ejemplo@correo.com" 
                                        required
                                    >
                                    <div class="invalid-feedback">
                                        Ingresa un correo válido
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Contraseña -->
                            <div class="col-md-6">
                                <label for="password" class="form-label">Contraseña</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock"></i>
                                    </span>
                                    <input 
                                        type="password" 
                                        class="form-control" 
                                        id="password" 
                                        name="password" 
                                        placeholder="Mínimo 8 caracteres" 
                                        required
                                        minlength="8"
                                        pattern="^(?=.*[A-Za-z])(?=.*\d).{8,}$"
                                        title="Debe contener al menos una letra y un número"
                                    >
                                    <button 
                                        class="btn btn-outline-secondary toggle-password" 
                                        type="button"
                                        data-target="password"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <div class="invalid-feedback">
                                        Mínimo 8 caracteres con letras y números
                                    </div>
                                </div>
                                <div class="form-text">Use 8+ caracteres con letras y números</div>
                            </div>
                            
                            <!-- Confirmar Contraseña -->
                            <div class="col-md-6">
                                <label for="confirmar" class="form-label">Confirmar Contraseña</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text">
                                        <i class="bi bi-lock-fill"></i>
                                    </span>
                                    <input 
                                        type="password" 
                                        class="form-control" 
                                        id="confirmar" 
                                        name="confirm" 
                                        placeholder="Repite tu contraseña" 
                                        required
                                    >
                                    <button 
                                        class="btn btn-outline-secondary toggle-password" 
                                        type="button"
                                        data-target="confirmar"
                                    >
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <div class="invalid-feedback">
                                        Las contraseñas deben coincidir
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Términos y condiciones -->
                            <div class="col-12">
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        id="terminos" 
                                        required
                                    >
                                    <label class="form-check-label" for="terminos">
                                        Acepto los <a href="/terminos">términos y condiciones</a>
                                    </label>
                                    <div class="invalid-feedback">
                                        Debes aceptar los términos
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Botón de submit -->
                            <div class="col-12 mt-4">
                                <button class="btn btn-primary w-100 py-2" type="submit">
                                    <i class="bi bi-person-plus"></i> Registrar cuenta
                                </button>
                            </div>
                            
                            <!-- Enlace a login -->
                            <div class="col-12 text-center mt-3">
                                <p class="mb-0">
                                    ¿Ya tienes cuenta? <a href="<?= BASE_URL ?>/login">Inicia sesión aquí</a>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Validación de contraseñas coincidentes
document.querySelector('form').addEventListener('submit', function(e) {
    let password = document.getElementById('password');
    let confirmar = document.getElementById('confirmar');
    
    if(password.value !== confirmar.value) {
        confirmar.setCustomValidity("Las contraseñas no coinciden");
        confirmar.reportValidity();
        e.preventDefault();
    } else {
        confirmar.setCustomValidity('');
    }
});

// Mostrar/ocultar contraseña
document.querySelectorAll('.toggle-password').forEach(button => {
    button.addEventListener('click', function() {
        const target = document.getElementById(this.getAttribute('data-target'));
        const icon = this.querySelector('i');
        
        if(target.type === 'password') {
            target.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            target.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    });
});
</script>

<?php include VIEW_PATH . '../views/partials/footer.php'; ?>