<?php

require 'conection.php';

function traerPelicula(PDO $db, $id) {
    $query = $db->prepare("SELECT * FROM movies WHERE id = :id");
    $query->execute([
        'id'=> $id
    ]);
    return $query->fetch(PDO::FETCH_ASSOC);
}





if(isset($_GET['id'])){
    $pelicula = traerPelicula($db,$_GET['id']);
} else {
    header('Location:peliculas.php');
}

// $series = traerPeliculas($db);
// print_r(json_encode($series)); exit();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelicula <?=$pelicula['title']?></title>
</head>
<body>
    <h3>Pelicula <?=$pelicula['title']?></h3>

    <a href="peliculas.php">Volver</a>
</body>
</html>