<?php
require_once 'conexion.php';

// Consultar los libros disponibles
$sentencia = $database->prepare("SELECT * FROM Libro;");
$sentencia->execute();
$libros = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libros Disponibles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .book-card {
            transition: transform 0.2s ease-in-out;
        }

        .book-card:hover {
            transform: scale(1.05);
        }

        .book-card img {
            object-fit: cover;
            height: 250px;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .container {
            margin-top: 80px;
        }

        .book-title {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .book-author {
            font-size: 1rem;
            color: #6c757d;
        }

        .book-price {
            font-size: 1.1rem;
            color: #28a745;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php include_once 'navbar.php'; ?>

    <div class="container">
        <h1 class="text-center mb-4">Libros Disponibles</h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">

            <?php foreach ($libros as $libro) : ?>
            <div class="col">
                <div class="card h-100 book-card shadow-sm">
                    <img src="img/<?php echo $libro->imagen; ?>" class="card-img-top" alt="Portada del libro <?php echo $libro->titulo; ?>">
                    <div class="card-body">
                        <h5 class="book-title"><?php echo $libro->titulo; ?></h5>
                        <p class="book-author">Por <?php echo $libro->autor; ?></p>
                        <p class="book-price">$<?php echo number_format($libro->precio_venta, 2); ?></p>
<!--                         <a href="detalleLibro.php?id_libro=<?php echo $libro->id_libro; ?>" class="btn btn-primary w-100">Ver Detalles</a>
-->                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
