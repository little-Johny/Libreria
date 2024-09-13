<?php 
    require_once '../conexion.php';

if($_SERVER["REQUEST_METHOD"]=== "POST"){
    $id_libro =$_POST['id_libro'];
    $isbn = $_POST['isbn'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $fecha = $_POST['fecha'];
    $precio = $_POST['precio'];
    $ruta = '../img/'; // Directorio donde se guardarán las imágenes
    $imagen = null;


    $sentencia = $database->prepare("UPDATE Libro 
                                    SET isbn = ?, titulo = ?, autor = ?, fecha_publicacion = ?, precio_venta = ?, ruta_img = ?, imagen = ?
                                    WHERE id_libro = ?");

    $result=$sentencia->execute([$isbn, $titulo, $autor, $fecha, $precio, $ruta, $imagen, $id_libro]);

    if ($result) {
        header("Location: ../views/queryBookView.php");
        echo "Actualizacion completa";
    } else {
        echo "Error al actualizar la información del paciente.";
    }
}