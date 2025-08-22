<?php
include_once('./conf/conf.php');
$correo= isset($_POST['email']) ? $_POST['email']:"";
$pwd=  isset($_POST['pwd']) ? $_POST['pwd']:"";
$pwdFormat= MD5($pwd);

$consulta=" SELECT email, pwd from usuario where email= '$correo' AND pwd='$pwdFormat'";
$ejecucion= (mysqli_query($con,$consulta));
// var_dump($ejecucion);
$validar= mysqli_num_rows($ejecucion);
if($validar>0){
    header('Location: home.php');
}else {
    header('Location: index.php?error=error');
}
?>