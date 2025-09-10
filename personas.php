<?php

include_once('./conf/conf.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="foto" >
    <input type="submit" value="enviar">
    </form>

        <table>
            <tr>
            <th>archivos</th>
            </tr>
            
                <?php 
                $consultarfotos="SELECT * FROM tbl_personas";
                $consulta=mysqli_query($con,$consultarfotos);

                while($data=mysqli_fetch_array($consulta)){
                $info= new SplFileInfo($data['foto']);
                $extension = pathinfo($info->getFilename(), PATHINFO_EXTENSION);
                echo "<tr>";
                if($extension== "png" ){
                echo "<td> <img style='width:100px;'src='./imgs/".$data['foto']."'></td>";
                }else{
                    echo "<td><a href='./imgs/".$data['foto']."' target='_blank'> Ver</a></td>";
                }
                echo "</tr>";
                }
                ?>
            
        </table>
</body>
</html>
<?php

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $imagen = isset($_FILES['foto']) ? $_FILES['foto']:"";

    // var_dump($imagen);
    $tamano= $_FILES['foto']['size'];
   $temname=$_FILES['foto']['tmp_name'];
   $nombre=$_FILES['foto']['name'];
    // $valorMb= $tamano/1048576;
    // echo "Tamaño ".$valorMb." MB <br>";
    // echo "temporal name ".$temname."<br>";
    // echo "Nombre ". $nombre."<br>";

    // $nombre= $_FILES['foto']['name'];
    // $temnombre= $_FILES['foto']['tmp_name'];
    // echo $nombre;

    $ruta= "./imgs/".$nombre;
    if(move_uploaded_file($temname, './imgs/'.$nombre))
    {
     $consulta="INSERT INTO tbl_personas (id, foto) values (null, '$nombre')";
     $ejecutar= mysqli_query($con,$consulta);
    }

}

?>