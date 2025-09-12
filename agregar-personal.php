<?php
session_start();
if(isset($_SESSION['usuario'])== null){
    Header('Location: index.php');
}
include_once('./conf/conf.php');

$nombre = isset($_POST['nombre']) ? $_POST['nombre']:""; 
$telefono= isset($_POST['telefono']) ? $_POST['telefono']:""; 
$dui = isset($_POST['dui']) ? $_POST['dui']:""; 
$fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento']:""; 
$departamento = isset($_POST['departamento']) ? $_POST['departamento']:""; 
$distrito = isset($_POST['distrito']) ? $_POST['distrito']:""; 
$colonia = isset($_POST['colonia']) ? $_POST['colonia']:""; 
$calle = isset($_POST['calle']) ? $_POST['calle']:""; 
$casa = isset($_POST['casa']) ? $_POST['casa']:""; 
$imagen = isset($_POST['imagen']) ? $_POST['imagen']:"";


if($_SERVER['REQUEST_METHOD']=='POST'){
    $nombre = isset($_POST['nombre']) ? $_POST['nombre']:"";
    $telefono= isset($_POST['telefono']) ? $_POST['telefono']:"";
    $dui = isset($_POST['dui']) ? $_POST['dui']:"";
    $fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento']:"";
    $departamento = isset($_POST['departamento']) ? $_POST['departamento']:"";
    $distrito = isset($_POST['distrito']) ? $_POST['distrito']:"";
    $colonia = isset($_POST['colonia']) ? $_POST['colonia']:"";
    $calle = isset($_POST['calle']) ? $_POST['calle']:"";
    $casa = isset($_POST['casa']) ? $_POST['casa']:"";

    // MANEJO DE IMAGEN
    $rutaImagen = "";
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $directorio = "uploads/";
        if (!is_dir($directorio)) {
            mkdir($directorio, 0777, true);
        }
        $rutaImagen = $directorio . time() . "_" . basename($_FILES["imagen"]["name"]);
        move_uploaded_file($_FILES["imagen"]["tmp_name"], $rutaImagen);
    }

    $vericar_dui="SELECT * from tbl_personas WHERE dui='$dui'";
    $verificar_sql= mysqli_query($con, $vericar_dui);
    if(mysqli_num_rows($verificar_sql)>=1){
        echo "<script>alert('El numero de DUI ya existe pruebe con otro')</script>";
    }else {
        $insertar = "INSERT INTO tbl_personas (nombre, telefono, dui, fecha_nacimiento, departamento, distrito, colonia, calle, casa, imagen)
        VALUES ('$nombre', '$telefono', '$dui', '$fecha_nacimiento', '$departamento', '$distrito', '$colonia', '$calle', '$casa', '$rutaImagen')";
        $ejecucion= mysqli_query($con, $insertar);
            if($ejecucion){
                header('Location: personas.php');
            }else{
            header('Location: agregar-personal.php');
            }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Agregar personal</title>
    <style>
        .contenido{
            margin:40px;
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
        <form action="" method="POST" class="form-control" enctype="multipart/form-data">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required placeholder="Ingrese su nombre completo" value="<?php echo $nombre ?>">
            <br>
            <label for="telefono" class="form-label">Telefono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" required placeholder="Ingrese su noumero de telefono" value="<?php echo $telefono ?>">
            <br>
            <label for="dui" class="form-label">Dui</label>
            <input type="text" name="dui" id="dui" class="form-control" required placeholder="Ingrese su DUI" value="<?php echo $dui ?>">
            <br>
            <label for="fecha_nacimiento" class="form-label">Fecha Nacimiento</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" required placeholder="Ingrese su fecha de nacimiento" value="<?php echo $fecha_nacimiento ?>">
            <br>
            <label for="departamento" class="form-label">Departamento</label>
            <input type="text" name="departamento" id="departamento" class="form-control" required placeholder="Ingrese Departamento" value="<?php echo $departamento ?>">
            <br>
            <label for="distrito" class="form-label">Distrito</label>
            <input type="text" name="distrito" id="distrito" class="form-control" required placeholder="Ingrese el distrito" value="<?php echo $distrito ?>">
            <br>
            <fieldset>
                <legend>Dirección</legend>

                <label for="colonia" class="form-label">Colonia:</label>
                <input type="text" id="colonia" name="colonia" id="colonia" class="form-control" required placeholder="Ingrese el nombre de la colonia" value="<?php echo $colonia ?>">

                <label for="calle" class="form-label">Calle/Polígono:</label>
                <input type="text" id="calle" name="calle" id="calle" class="form-control" required placeholder="Ingrese la calle/poligono" value="<?php echo $calle ?>">

                <label for="casa" class="form-label">Casa/Apartamento:</label>
                <input type="text" id="casa" name="casa" id="casa" class="form-control" required placeholder="Ingrese casa/apartamento" value="<?php echo $casa ?>">
            </fieldset>
            <br>
            <label for="imagen" class="form-label">Selecciona una imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*">
            <br>
            <input type="submit" class="form-control btn btn-primary" value="Registrar">
        </form>
    </div>
</body>
</html>