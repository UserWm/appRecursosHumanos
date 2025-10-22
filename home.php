<?php
session_start();
include_once("./conf/conf.php");
// echo "Bienvenido ".$_SESSION['usuario'];

if (isset($_SESSION['usuario']) == null) {
    Header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/themes/adaptive.js"></script>
    <title>Panel Contentido</title>

    <style>
        body {
            font-family:
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Roboto,
                Helvetica,
                Arial,
                "Apple Color Emoji",
                "Segoe UI Emoji",
                "Segoe UI Symbol",
                sans-serif;
            background: var(--highcharts-background-color);
            color: var(--highcharts-neutral-color-100);
        }

        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }

        #container {
            height: 400px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid var(--highcharts-neutral-color-10, #e6e6e6);
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: var(--highcharts-neutral-color-60, #666);
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tbody tr:nth-child(even) {
            background: var(--highcharts-neutral-color-3, #f7f7f7);
        }

        .highcharts-description {
            margin: 0.3rem 10px;
        }
    </style>
</head>

<body>
    <?php
    include_once('./nav.php');
    ?>
<form action="" method="POST">
    <select name="departamento" id="">
        <?php
        $select = "select DISTINCT(departamento) as depto from tbl_personas";
        $ejecucion= mysqli_query($con, $select);
        while($deptos= mysqli_fetch_array($ejecucion)){
            echo "<option value='".$deptos['depto']."'>".$deptos['depto']."</option>";
        }
        ?>
        
    </select>
    <input type="submit" value="Ver">
</form>
<figure class="highcharts-figure">
    <div id="container"></div>
</figure>
</body>
</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $variabledept= $_POST['departamento'];
   
    ?>
    <script>
    Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Cantidad de personas registradas por departamento de El Salvador'
    },
    subtitle: {
        text:
            'Ejemplo de grafico'
    },

    xAxis: {
        categories: [
            <?php
                $consulta="select DISTINCT(departamento) as dep, count(departamento) as Total from tbl_personas  where departamento='$variabledept' group by (departamento);";
                $exe=mysqli_query($con, $consulta);
                while($dep=mysqli_fetch_array($exe)){
                    echo "'".$dep['dep']."',";
                }
            ?>

        ],
        crosshair: true,
        accessibility: {
            description: 'Countries'
        }
    },

    yAxis: {
        min: 0,
        title: {
            text: 'Personas'
        }
    },
    tooltip: {
        valueSuffix: ' (Cantidad)'
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
        {
            name: 'Departamentos',
            data: [ 
                <?php
                $data="select DISTINCT(departamento), count(departamento) as Total from tbl_personas  where departamento='$variabledept' group by (departamento) ";
                $execData= mysqli_query($con, $data);
                while($datos=mysqli_fetch_array($execData)){
                    echo $datos['Total'].",";
                }
                ?>
            ]
        }
    ]
});

</script>
<?php
}else {
?>
<script>
    Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Cantidad de personas registradas por departamento de El Salvador'
    },
    subtitle: {
        text:
            'Ejemplo de grafico'
    },

    xAxis: {
        categories: [
            <?php
                $consulta="select DISTINCT(departamento) as dep, count(departamento) as Total from tbl_personas group by (departamento);";
                $exe=mysqli_query($con, $consulta);
                while($dep=mysqli_fetch_array($exe)){
                    echo "'".$dep['dep']."',";
                }
            ?>

        ],
        crosshair: true,
        accessibility: {
            description: 'Countries'
        }
    },

    yAxis: {
        min: 0,
        title: {
            text: 'Personas'
        }
    },
    tooltip: {
        valueSuffix: ' (Cantidad)'
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
        {
            name: 'Departamentos',
            data: [ 
                <?php
                $data="select DISTINCT(departamento), count(departamento) as Total from tbl_personas  group by (departamento) ";
                $execData= mysqli_query($con, $data);
                while($datos=mysqli_fetch_array($execData)){
                    echo $datos['Total'].",";
                }
                ?>
            ]
        }
    ]
});

</script>
<?php
}
?>