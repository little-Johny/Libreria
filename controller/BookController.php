<?php 
// Importar el modelo para poder implementarlo
require_once '../model/BookModel.php';

// Clase para el controlador de libros
class LibroController {
    private $model;

    // Constructor que recibe la conexión a la base de datos y crea una instancia del modelo
    public function __construct($database) {
        $this->model = new Libro($database);
    }

    // Función para crear un nuevo libro
    public function crear($isbn, $titulo, $autor, $fecha_publicacion, $precio_venta, $ruta_img, $imagen) {
        // Asignación de los valores a las propiedades del modelo
        $this->model->isbn = $isbn;
        $this->model->titulo = $titulo;
        $this->model->autor = $autor;
        $this->model->fecha_publicacion = $fecha_publicacion;
        $this->model->precio_venta = $precio_venta;
        $this->model->ruta_img = $ruta_img;
        $this->model->imagen = $imagen;

        // Llamada al método create del modelo y verificación del resultado
        if ($this->model->create()) {
            echo "Libro creado e insertado correctamente en la base de datos.";
        } else {
            echo "Error al crear el libro.";
        }
    }
}

    // Verificar si la solicitud es POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Incluir el archivo de conexión a la base de datos
        require_once '../conexion.php'; 
        $database = new Database();
        $db = $database->getConnection();

        // Crear una instancia del controlador de libros
        $libroController = new LibroController($db);

        // Obtener los datos del formulario
        $isbn = $_POST['isbn'];
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $fecha_publicacion = $_POST['fecha'];
        $precio_venta = $_POST['precio'];

        // Manejar la carga de la imagen
        $ruta_img = ''; // Definir la ruta donde se almacenarán las imágenes
        $imagen = ''; // Nombre del archivo de imagen

        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
            $imagen = $_FILES['imagen']['name'];
            $tmp_name = $_FILES['imagen']['tmp_name'];
            $upload_dir = '../img/'; // Directorio de carga
            move_uploaded_file($tmp_name, $upload_dir . $imagen);
        }

        // Llamar al método para crear el libro
        $libroController->crear($isbn, $titulo, $autor, $fecha_publicacion, $precio_venta, $ruta_img, $imagen);
}
