<?php

require 'conection.php';

function traerSerie(PDO $db, $id) {
    $query = $db->prepare("SELECT * FROM series WHERE id = :id");
    $query->execute([
        'id'=> $id
    ]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

function traerEpisodios(PDO $db, $id) {
    $query = $db->prepare("SELECT  episodes.title as episode_title ,episodes.number as episode_number ,seasons.title as season_title ,seasons.number as season_number  FROM episodes
        INNER JOIN seasons ON episodes.season_id = seasons.id and year(episodes.release_date) = 2013
        INNER JOIN series ON series.id = seasons.serie_id AND series.id = :id ");
    $query->execute([
        'id'=> $id
    ]);
    return [
        'cdad' => $query->rowCount(),
        'data' => $query->fetchAll(PDO::FETCH_ASSOC)
    ];
    // return $query->fetchAll(PDO::FETCH_ASSOC);
}

function contarEpisodios(PDO $db, $id) {
    $query = $db->prepare("SELECT  count(*) as 'cdad_episodes'
        FROM episodes
        INNER JOIN seasons ON episodes.season_id = seasons.id and year(episodes.release_date) = 2013
        INNER JOIN series ON series.id = seasons.serie_id AND series.id = :id ");
    $query->execute([
        'id'=> $id
    ]);
    
    return $query->fetch(PDO::FETCH_ASSOC);
}


if(isset($_GET['id'])){
    $serie = traerSerie($db,$_GET['id']);
    $episodios = traerEpisodios($db,$_GET['id']);
//    echo json_encode($episodios); exit;
} else {
    header('Location:series.php');
}

// $series = traerSeries($db);
// print_r(json_encode($series)); exit();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Serie <?=$serie['title']?></title>
</head>
<body>
    <h3>Serie <?=$serie['title']?></h3>
    <h4><?=$episodios['cdad']?> <?=$episodios['cdad'] > 1 ? 'Episodios': 'Episodio'?></h4>
    <ul>
      <?php foreach($episodios['data'] as $episodio) : ?>
            <li><?=$episodio['episode_number']?> : <?=$episodio['episode_title']?> (<?=$episodio['season_title']?>)</li>
        <?php endforeach;?>
    </ul>
    <a href="series.php">Volver</a>
</body>
</html>