<?php 
require_once '../conexion.php';

if (!isset($_POST["id_libro"]) || empty($_POST["id_libro"])) {
    exit('ID de libro no proporcionado.');
}

$id_libro = $_POST["id_libro"];

// Recuperar la información del libro para obtener el nombre del archivo de imagen
$sentencia = $database->prepare("SELECT imagen FROM Libro WHERE id_libro = ?");
$sentencia->execute([$id_libro]);
$libro = $sentencia->fetch(PDO::FETCH_OBJ);

if ($libro === false) {
    exit('¡No existe ningún libro con ese ID!');
}

// Eliminar el libro de la base de datos
$delete = $database->prepare("DELETE FROM Libro WHERE id_libro = ?");
$resultado = $delete->execute([$id_libro]);

if ($resultado) {
    // Eliminar la imagen del directorio si existe
    if ($libro->imagen) {
        $rutaImagen = '../img/' . $libro->imagen;
        if (file_exists($rutaImagen)) {
            unlink($rutaImagen); // Elimina el archivo
        }
    }

    echo '
    <script> 
        alert("El Libro ha sido eliminado correctamente.");
        window.location.href = "../views/queryBookView.php";
    </script>
    ';
} else {
    echo '
    <script> 
        alert("El Libro NO pudo ser eliminado.");
        window.location.href = "../views/queryBookView.php";
    </script>
    ';
}
?>
