<?php 
http_response_code(404); // Establece el código de respuesta HTTP
include VIEW_PATH . '../views/partials/header.php'; 
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <!-- Ilustración SVG (alternativa a imágenes) -->
            <svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="#dc3545" class="bi bi-exclamation-octagon mb-4" viewBox="0 0 16 16">
                <path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
                <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
            </svg>
            
            <h1 class="display-4 fw-bold text-danger">404</h1>
            <h2 class="mb-4">¡Página no encontrada!</h2>
            
            <p class="lead mb-4">Lo sentimos, la página que buscas no existe o ha sido movida.</p>
            
        </div>
    </div>
</div>

<?php include VIEW_PATH . '../views/partials/footer.php'; ?>
