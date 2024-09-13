<?php
require_once '../conexion.php';

if (!isset($_GET["id_libro"]) || empty($_GET["id_libro"])) {
    echo "ID de libro no proporcionado.";
    exit();
}

$id = $_GET["id_libro"];

$sentencia = $database->prepare("SELECT * FROM Libro WHERE id_libro = ?;");
$sentencia->execute([$id]);
$libros = $sentencia->fetch(PDO::FETCH_OBJ);

if ($libros === false) {
    echo "¡No existe ningún libro con ese ID!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar libro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .container {
            margin-top: 100px;
            padding: 20px;
            border: 2px solid #ced4da; /* Borde del contenedor */
            border-radius: 10px;
            background-color: #f8f9fa;
        }
        .profile-image-container {
            position: relative;
            width: 100%;
            padding-top: 100%; /* Aspect Ratio 1:1 */
            border: 2px solid #ced4da;
            border-radius: 5px;
            overflow: hidden;
            background-color: #e9ecef;
            text-align: center;
        }
        .profile-image-container img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .custom-file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
            padding: 0;
            border: 1px solid #ced4da;
            border-radius: 5px;
            background-color: #e9ecef;
            text-align: center;
        }
        .custom-file-input-wrapper input[type="file"] {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }
        .custom-file-input-wrapper label {
            display: block;
            padding: 10px;
            cursor: pointer;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            text-align: center;
        }
        .custom-file-input-wrapper label:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php include_once '../navbar.php'; ?>
    
    <form class="container" method="post" action="../controller/updateBookController.php" enctype="multipart/form-data">
        <input type="hidden" name="id_libro" value="<?php echo $libros->id_libro; ?>">
        <input type="hidden" name="imagen_actual" value="<?php echo $libros->imagen; ?>">
        
        <div class="row mb-3 d-flex justify-content-lg-center">
            <div class="col-md-6 text-center">
                <p for="imagen" class="form-label">Imagen del Libro (opcional):</p>
                <div class="profile-image-container">
                    <img id="previewImage" src="/img/<?php echo $libros->imagen; ?>" alt="Vista previa" style="display:block;">
                    <div class="custom-file-input-wrapper">
                        <label for="imagen">Seleccionar imagen</label>
                        <input type="file" id="imagen" name="imagen" accept="image/*">
                    </div>
                </div>
            </div>
        </div>
                                
        <div class="row">
            <div class="col-4 mb-3">
                <label for="isbn" class="form-label">ISBN</label>
                <input type="text" class="form-control" id="isbn" name="isbn" value="<?php echo $libros->isbn; ?>">
            </div>

            <div class="col-4 mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $libros->titulo; ?>">
            </div>

            <div class="col-4 mb-3 form-check">
                <label for="autor" class="form-label">Autor</label>
                <input type="text" class="form-control" id="autor" name="autor" value="<?php echo $libros->autor; ?>">
            </div>
        </div>

        <div class="row">
            <div class="col-6 mb-3">
                <label for="fecha" class="form-label">Fecha de publicación</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $libros->fecha_publicacion; ?>">
            </div>

            <div class="col-6 mb-3">
                <label for="precio" class="form-label">Precio de venta:</label>
                <input type="text" class="form-control" id="precio" name="precio" value="<?php echo $libros->precio_venta; ?>">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>

    <script>
        document.getElementById('imagen').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const previewImage = document.getElementById('previewImage');
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                previewImage.src = '';
                previewImage.style.display = 'none';
            }
        });
    </script>
</body>
</html>
