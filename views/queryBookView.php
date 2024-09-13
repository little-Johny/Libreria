<?php 
require_once '../controller/queryBookController.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>
    <!-- !Importación de estilos con Bootstrap a través de CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .actions {
            margin: 0;
            display: flex;
            flex-direction: column; /* Apilar los botones verticalmente */
            gap: 5px; /* Espacio entre botones */
        }
        .bg-body-secondary{
            
            margin-top:100px;
            width: 90%;
            display: flex;
            flex-direction: column;
            
            
        }
    </style>
<body class="bg-body-secondary ">

<?php include_once '../navbar.php'; ?> 
    <h3 class="mb-4">Libros Registrados</h3>

<!--     //! Tabla de libros registrados 
 -->    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">ISBN</th>
                <th scope="col">Título</th>
                <th scope="col">Autor</th>
                <th scope="col">Fecha de Publicación</th>
                <th scope="col">Precio</th>
                <th scope="col">Imagen</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($libros as $libro): ?>
            <tr>
                <td><?php echo htmlspecialchars($libro->id_libro); ?></td>
                <td><?php echo htmlspecialchars($libro->isbn); ?></td>
                <td><?php echo htmlspecialchars($libro->titulo); ?></td>
                <td><?php echo htmlspecialchars($libro->autor); ?></td>
                <td><?php echo htmlspecialchars($libro->fecha_publicacion); ?></td>
                <td><?php echo htmlspecialchars($libro->precio_venta); ?></td>                          
                <td><?php echo htmlspecialchars($libro->imagen ?? 'Imagen no disponible'); ?></td>                          
                                        

                <td class="actions">
                    <a href="updateBookView.php?id_libro=<?php echo htmlspecialchars($libro->id_libro); ?>" class="btn btn-primary">Editar</a>
                    <a type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal<?php echo htmlspecialchars($libro->id_libro); ?>">Eliminar</a>
                <!-- Modal Confirmación Eliminación -->
                <div class="modal fade" id="confirmModal<?php echo htmlspecialchars($libro->id_libro); ?>" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmModalLabel">Confirmar Eliminación</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ¿Estás seguro de que deseas eliminar este libro?
                            </div>
                                <div class="modal-footer">
                                    <form action="../controller/deleteBookController.php" method="POST">
                                        <input type="hidden" name="id_libro" value="<?php echo htmlspecialchars($libro->id_libro); ?>">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    </td>
                </tr>
            <?php endforeach; ?>                        
            
        </tbody>
    </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>