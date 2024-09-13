
<?php 
try {
    // Conexión a la base de datos
    require_once '../conexion.php';

    // Preparar la consulta para obtener todos los pacientes con detalles adicionales
    $query = $database->prepare("SELECT * FROM Libro ;");
    $query->execute();
    $libros = $query->fetchAll(PDO::FETCH_OBJ);

    
} catch (PDOException $error) {
    echo "Error de base de datos: " . $error->getMessage();
}
