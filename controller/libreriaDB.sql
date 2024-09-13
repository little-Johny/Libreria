create database libreria;
use libreria

create table Libro(
    id_libro INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    isbn VARCHAR(15),
    titulo VARCHAR(200),
    autor VARCHAR(250),
    fecha_publicacion DATE,
    precio_venta DECIMAL(10,2),
    ruta_img VARCHAR(255),
    imagen VARCHAR(250) NULL
);