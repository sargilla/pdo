<?php

require 'conection.php';

function traerGeneros(PDO $db) {
    $query = $db->prepare("SELECT name FROM genres ORDER BY name");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
$generos = traerGeneros($db);

function traerGenerosPelis(PDO $db) {
    $query = $db->prepare("SELECT genres.name AS name, movies.id AS id, movies.title AS title FROM genres
    INNER JOIN movies ON genres.id=movies.genre_id");
    $query->execute();
       return $query->fetchAll(PDO::FETCH_ASSOC);
}
$generosPelis = traerGenerosPelis($db);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Géneros</title>
    <?php include 'header.php'; ?>
</head>
<body>
    <div class="container">
        <?php include 'menu.php'; ?>
        <ul>
            <?php foreach($generos as $genero) : ?>
                <li><?=$genero['name']?>
                    <ul>
                        <?php foreach($generosPelis as $generoPeli) :
                            if($genero['name'] == $generoPeli['name']){ ?>
                                <li><a href="pelicula.php?id=<?=$generoPeli['id']?>">• <?=$generoPeli['title']?></a></li>
                        <?php } endforeach;?>
                    </ul>
                </li>
            <?php endforeach;?>
        </ul>
    </div>
</body>
</html>