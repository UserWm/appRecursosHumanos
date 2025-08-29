<?php
include_once('./conf/conf.php');
    $id=isset($_POST['id']) ? $_POST['id']:"";
    $eliminar="DELETE from usuario where id= $id";
    $ejecutar_eliminar= mysqli_query($con, $eliminar);
    if($ejecutar_eliminar){
        header('Location: usuarios.php');
    }
?>