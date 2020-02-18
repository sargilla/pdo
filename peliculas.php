<?php

require 'conection.php';

function traerMovies(PDO $db) {
 $query = $db->prepare("SELECT * FROM movies");
  $query->execute();
  return $query->fetchAll(PDO::FETCH_ASSOC);
//   return $query->fetchAll();

}
$peliculas = traerMovies($db);
// print_r(json_encode($peliculas)); exit();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peliculas</title>
</head>
<body>
    <h3>Peliculas |  <a href="series.php">Series</a> | <a href="actores.php">Actores</a></h3>
    <?php if(isset($_GET['exito'])) : ?>
    <h4 style="color:red;"><strong>Se guardó la película</strong></h4>
    <?php endif; ?>
    <ul>
        <?php foreach($peliculas as $pelicula) : ?>
        
            <li><a href="pelicula.php?id=<?=$pelicula['id']?>"><?=$pelicula['title']?></a></li>
        <?php endforeach;?>
    </ul>
    <a href="agregarPelicula.php">Agregar Pelicula</a>
</body>
</html>