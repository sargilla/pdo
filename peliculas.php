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
    <h3>Peliculas</h3>
    <ul>
        <?php foreach($peliculas as $pelicula) : ?>
        
            <li><a href="pelicula.php?id=<?=$pelicula['id']?>"><?=$pelicula['title']?></a></li>
        <?php endforeach;?>
    </ul>
    <a href="series.php">Series</a>
</body>
</html>