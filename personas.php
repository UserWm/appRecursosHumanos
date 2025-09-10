<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="foto">
    <input type="submit" value="enviar">
    </form>
</body>
</html>
<?php
include_once('./conf/conf.php');
if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $imagen = isset($_FILES['foto']) ? $_FILES['foto']:"";

    $nombre= $_FILES['foto']['name'];
    $temnombre= $_FILES['foto']['tmp_name'];
    echo $nombre;

    move_uploaded_file($temnombre, './imgs/'.$nombre);
}

?>