<?php
try {
        require_once '../conexion.php';

    // Recoger datos del formulario
        $isbn = $_POST['isbn'];
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $fecha = $_POST['fecha'];
        $precio = $_POST['precio'];
        $ruta = '../img/'; // Directorio donde se guardarán las imágenes
        $imagen = null; // Si no se sube una imagen, el valor en la base de datos será null

    // Verificar si se ha subido un archivo
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreArchivo = $_FILES['imagen']['name'];
        $rutaTemporal = $_FILES['imagen']['tmp_name'];
        $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);

        // Crear un nombre único para la imagen
        $nuevoNombreArchivo = uniqid('img_', true) . '.' . $extension;
        $rutaDestino = $ruta . $nuevoNombreArchivo;

        // Mover la imagen a la carpeta de destino
        if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
            $imagen = $nuevoNombreArchivo; // Guardar el nombre de la imagen en la base de datos
        } else {
                echo "<script>
                        alert('Error al subir la imagen');
                        window.history.back();
                        </script>";
                exit;
        }
}

    // Preparar la consulta de inserción
        $createQuery = $database->prepare("INSERT INTO libro (isbn, titulo, autor, fecha_publicacion, precio_venta, ruta_img, imagen) VALUES(?,?,?,?,?,?,?);");
        $result = $createQuery->execute([$isbn, $titulo, $autor, $fecha, $precio, $ruta, $imagen]);

        if ($result === TRUE) {
        // Redirigir a la página deseada después de la inserción exitosa
        header("Location: ../views/queryBookView.php");
        exit; // Asegúrate de que el script se detenga después de la redirección
        } else {
        echo "<script>
                alert('Error al registrar el libro');
                window.history.back();
        </script>";
        }
} catch (PDOException $e) {
        echo "<script>
                alert('Error en la base de datos: " . $e->getMessage() . "');
                window.history.back();
        </script>";
} catch (Exception $error) {
        echo "Error: " . $error->getMessage();
}

