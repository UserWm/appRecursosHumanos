<?php
session_start();
if(isset($_SESSION['usuario'])== null){
    Header('Location: index.php');
}
include_once('./conf/conf.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Personal</title>
    <style>
        .contenido{
            margin: 40px
        }
    </style>
</head>
<body>
    <?php
    include_once('nav.php');
    $consulta= "SELECT * FROM tbl_personas";
    $ejecutar_consulta= mysqli_query($con, $consulta);
    $i=1;
    ?>
    <div class="contenido">
        <br>
        <a href="agregar-personal.php" class="btn btn-success">Nuevo Personal</a>
        <br>
        <table class="table">
            <tr>
                <th>N°</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Dui</th>
                <th>Fecha de nacimiento</th>
                <th>Departamento</th>
                <th>Distrito</th>
                <th>Colonia</th>
                <th>Calle</th>
                <th>Casa</th>
                <th>Imagen</th>
                <th>Feche de registro</th>
                <th>Acción</th>
                <th></th>
            </tr>
            <?php
            while($lista= mysqli_fetch_array($ejecutar_consulta)){
            ?>
            <tr>
                <td>
                    <?php echo $i++ ?>
                </td>
                <td>
                    <?php echo $lista['nombre'] ?>
                </td>
                <td>
                    <?php echo $lista['telefono'] ?>
                </td>
                <td>
                    <?php echo $lista['dui'] ?>
                </td>
                <td>
                    <?php echo $lista['fecha_nacimiento'] ?>
                </td>
                <td>
                    <?php echo $lista['departamento'] ?>
                </td>
                <td>
                    <?php echo $lista['distrito'] ?>
                </td>
                <td>
                    <?php echo $lista['colonia'] ?>
                </td>
                <td>
                    <?php echo $lista['calle'] ?>
                </td>
                <td>
                    <?php echo $lista['casa'] ?>
                </td>
                <td>
                    <img src="<?php echo $lista['imagen']; ?>" alt="avatar" width="50" height="50"> 
                </td>
                <td>
                    <?php echo $lista['fecha_registro'] ?>
                </td>
                <td>
                   <a href="editar-personal.php?id= <?php echo $lista['id'] ?>" class="btn btn-primary" value="Editar">Editar</a>
                </td>
                <td>
                    <form action="eliminar-personal.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $lista['id'] ?>">
                        <button  class="btn btn-danger" >Eliminar</button>
                    </form>
                </td>
                <td>
    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#verModal<?php echo $lista['id']; ?>">
        Ver
    </button>
</td>

<div class="modal fade" id="verModal<?php echo $lista['id']; ?>" tabindex="-1" aria-labelledby="verModalLabel<?php echo $lista['id']; ?>" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="verModalLabel<?php echo $lista['id']; ?>">Detalles de <?php echo $lista['nombre']; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-4 text-center">
                <img src="<?php echo $lista['imagen']; ?>" alt="avatar" class="img-thumbnail" width="150" height="150">
            </div>
            <div class="col-md-8">
                <p><strong>Nombre:</strong> <?php echo $lista['nombre']; ?></p>
                <p><strong>Teléfono:</strong> <?php echo $lista['telefono']; ?></p>
                <p><strong>DUI:</strong> <?php echo $lista['dui']; ?></p>
                <p><strong>Fecha de nacimiento:</strong> <?php echo $lista['fecha_nacimiento']; ?></p>
                <p><strong>Departamento:</strong> <?php echo $lista['departamento']; ?></p>
                <p><strong>Distrito:</strong> <?php echo $lista['distrito']; ?></p>
                <p><strong>Colonia:</strong> <?php echo $lista['colonia']; ?></p>
                <p><strong>Calle:</strong> <?php echo $lista['calle']; ?></p>
                <p><strong>Casa:</strong> <?php echo $lista['casa']; ?></p>
                <p><strong>Fecha de registro:</strong> <?php echo $lista['fecha_registro']; ?></p>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
            <?php
                }
            ?>
        </table>
    </div>


    <?php
    
    mysqli_close($con);
    ?>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>