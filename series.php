<?php

require 'conection.php';

function traerSeries(PDO $db) {
 $query = $db->prepare("SELECT * FROM series");
  $query->execute();
  return $query->fetchAll(PDO::FETCH_ASSOC);
//   return $query->fetchAll();

}
$series = traerSeries($db);
// print_r(json_encode($series)); exit();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Series</title>
</head>
<body>
    <h3><a href="peliculas.php">Peliculas</a> | Series</h3>
    <ul>
        <?php foreach($series as $serie) : ?>
        
            <li><a href="serie.php?id=<?=$serie['id']?>"><?=$serie['title']?></a></li>
        <?php endforeach;?>
    </ul>
    <a href="agregarPelicula.php">Agregar Pelicula</a>
</body>
</html>