<?php
$index = '/Libreria_Quiz/index.php';
$create = '/Libreria_Quiz/views/createBookView.php';
$read = '/Libreria_Quiz/views/queryBookView.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NAVBAR</title>
    <!-- Importación de estilos con Bootstrap a través de CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Estilos locales -->
    <style>
        /* Puedes agregar estilos personalizados aquí si es necesario */
    </style>
</head>
<body>
    <nav class="navbar bg-body-tertiary fixed-top">
        <div class="container-fluid">
            <!-- Sección del logo de la empresa -->
            <a class="navbar-brand fs-3" href="<?php echo $index ?>">Libreria AllBooks</a>
            
            <!-- Sección del botón de menú -->
            <button class="btn menu-btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                <span class="navbar-toggler-icon"></span> <!-- Aquí se añade el ícono del menú hamburguesa -->
            </button>

            <!-- Sección de menú -->
            <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
                <!-- Sección de header del menú / botón de cierre -->
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Libreria AllBooks</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                
                <!-- Opciones del menú -->
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="<?php echo $index ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $create ?>">Crear Nuevo libro</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $read ?>">Ver inventario de libros</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Importación de paquete de funcionalidades para estilos de Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>    
</html>
