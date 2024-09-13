<?php

require_once '../model/Database.php';
class Libro {
    private $conexion;
    private $table = "Libro";

    public $id_libro;
    public $isbn;
    public $titulo;
    public $autor;
    public $fecha_publicacion;
    public $precio_venta;
    public $ruta_img;
    public $imagen;

    // Función para crear una nueva instancia de la clase Libro en la base de datos usando el método __construct
    public function __construct($database) {
        // Usamos $this para referirnos al objeto actual, es decir, a cada instancia de la clase Libro. 
        // Esto nos ayuda a acceder a las propiedades del objeto desde dentro de los métodos de la misma clase.
        $this->conexion = $database;
    }

    // Función para consultar las instancias de la clase libro
    public function read() {
        // Creamos una sentencia
        $sentencia = $this->conexion->prepare("SELECT * FROM " . $this->table);
        $sentencia->execute();
        return $sentencia;
    }

    public function create() {
        // Usar parámetros con : nos asegura una consulta SQL más segura y sin inyecciones SQL, ya que permite que los parámetros se preparen con placeholders.
        $sentencia = $this->conexion->prepare("INSERT INTO " . $this->table . " (isbn, titulo, autor, fecha_publicacion, precio_venta, ruta_img, imagen) 
        VALUES (:isbn, :titulo, :autor, :fecha_publicacion, :precio_venta, :ruta_img, :imagen)");
        
        // La ruta de la imagen se debe definir en el controlador
        // $this->ruta_img = '../img';
        
        // bindParam nos ayuda a vincular variable con placeholders de consultas preparadas 
        $sentencia->bindParam(':isbn', $this->isbn);
        $sentencia->bindParam(':titulo', $this->titulo);
        $sentencia->bindParam(':autor', $this->autor);
        $sentencia->bindParam(':fecha_publicacion', $this->fecha_publicacion);
        $sentencia->bindParam(':precio_venta', $this->precio_venta);
        $sentencia->bindParam(':ruta_img', $this->ruta_img);
        $sentencia->bindParam(':imagen', $this->imagen);

        // La imagen y su enrutamiento se deben gestionar en el controlador
        if ($sentencia->execute()) {
            return true;
        }
        return false;
    }

    public function update() {
        // Preparar la consulta SQL para actualizar los datos del libro
        $sentencia = $this->conexion->prepare("UPDATE " . $this->table . " 
        SET isbn = :isbn, titulo = :titulo, autor = :autor, fecha_publicacion = :fecha_publicacion, precio_venta = :precio_venta, ruta_img = :ruta_img, imagen = :imagen
        WHERE id_libro = :id_libro");

        // Vincular parámetros a la consulta
        $sentencia->bindParam(':isbn', $this->isbn);
        $sentencia->bindParam(':titulo', $this->titulo);
        $sentencia->bindParam(':autor', $this->autor);
        $sentencia->bindParam(':fecha_publicacion', $this->fecha_publicacion);
        $sentencia->bindParam(':precio_venta', $this->precio_venta);
        $sentencia->bindParam(':ruta_img', $this->ruta_img);
        $sentencia->bindParam(':imagen', $this->imagen);
        $sentencia->bindParam(':id_libro', $this->id_libro);

        // Ejecutar la consulta
        if ($sentencia->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        // Preparar la consulta SQL para eliminar un libro
        $sentencia = $this->conexion->prepare("DELETE FROM " . $this->table . " WHERE id_libro = :id_libro");
    
        // Vincular el parámetro a la consulta
        $sentencia->bindParam(':id_libro', $this->id_libro);
    
        // Ejecutar la consulta
        if ($sentencia->execute()) {
            return true;
        }
        return false;
    }
}
