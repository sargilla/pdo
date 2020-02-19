<?php 

require 'conection.php';
// var_dump($db);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Series y Pelis</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="center">
        <ul class="menu">
            <li><a href="/series.php">Series</a></li>
            <li><a href="/peliculas.php">Pelis</a></li>
            <li><a href="actores.php">Actores</a></li>
        </ul>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="get" >
            <div class="tipo">

            </div>
            <div class="buscador">
                <input type="text" name='buscar' required><button type="submit">Buscar</button>
            </div>
        </form>
    </div>
</div>
    
</body>
</html>