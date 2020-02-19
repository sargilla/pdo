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
    <?php include 'header.php'; ?>
</head>
<body>
    <div class="container">
        <?php include 'menu.php'; ?>
        <ul>
            <?php foreach($series as $serie) : ?>
                <li><a href="serie.php?id=<?=$serie['id']?>"><?=$serie['title']?></a></li>
            <?php endforeach;?>
        </ul>
    </div>    
</body>
</html>