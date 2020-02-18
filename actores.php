<?php

require 'conection.php';

function traerActores(PDO $db) {
 $query = $db->prepare("SELECT * FROM actors ORDER BY first_name, last_name");
  $query->execute();
  return $query->fetchAll(PDO::FETCH_ASSOC);
}
$actores = traerActores($db);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actores</title>
</head>
<body>
    <h3><a href="peliculas.php">Peliculas</a> | <a href="series.php">Series</a>   | Actores</h3>
    <ul>
        <?php foreach($actores as $actor) : ?>
            <li><?=$actor['first_name']?> <?=$actor['last_name']?></li>
        <?php endforeach;?>
    </ul>
</body>
</html>