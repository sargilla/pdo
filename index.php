<?php 

require 'conection.php';

function buscarEnMovies($db,$aguja){
    $query = $db->prepare("SELECT * FROM movies WHERE title LIKE :busqueda");
    $query->execute([
        'busqueda' => $aguja
    ]);
    return  $query->fetchAll(PDO::FETCH_ASSOC);
}

function buscarEnSeries($db,$aguja){
    $query = $db->prepare("SELECT *, genres.name FROM series,genres WHERE title LIKE :busqueda AND series.genre_id = genres.id");
    $query->execute([
        'busqueda' => $aguja
    ]);
    return  $query->fetchAll(PDO::FETCH_ASSOC);
}

if(isset($_GET['buscar']) && $_GET['buscar'] != ''){
    $busqueda = $_GET['buscar'];
    if(isset($_GET['tipo'])){
        if($_GET['tipo'] == 'pelicula'){
            $resultados = buscarEnMovies($db,"%$busqueda%");
        }
        if($_GET['tipo'] == 'serie'){
            $resultados = buscarEnSeries($db,"%$busqueda%");
        }
    } else {
        $errores['tipo']= "Debe elegir un tipo de búsqueda"; 
    }
} else {
    $errores['buscar'] = "Debe ingresar una búsqueda";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Series y Pelis</title>
    <?php include 'header.php'; ?>
</head>
<body>
<div class="center <?php echo !isset($_GET['buscar']) ?  'medio' : ''?>">
        <?php include 'menu.php'; ?>
        <form action="<?=$_SERVER['PHP_SELF']?>" method="get" >
            <div class="tipo">
                <input type="radio" name="tipo"  id="movies" value="pelicula" checked/>
                <label for="movies" >Películas</label>
                <input type="radio" name="tipo" id="series" value="serie"/>
                <label for="series">Series</label>
            </div>
            <div class="buscador">
                <input type="text" name='buscar' required><button type="submit">Buscar</button>
            </div>
        </form>
        <div class="resultados">
        <?php if(isset($resultados)): ?>
            <h3><?=count($resultados) ?> Resultados</h3>
            <?php foreach($resultados as $resultado) :?>
                <div class="items">
                    <h3><a href="<?=$_GET['tipo']?>.php?id=<?=$resultado['id']?>"><?= $resultado['title'] ?></a></h3>
                    <?php if($_GET['tipo'] == 'pelicula'): ?>
                        <p><strong>Rating:</strong> <?= $resultado['rating'] ?> -<strong>Premios</strong> <?= $resultado['awards'] ?></p>
                    <?php endif; ?>
                    <?php if($_GET['tipo'] == 'serie'): ?>
                        <p><strong>Género:</strong> <?= $resultado['name'] ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach ?>
        <?php endif; ?>
        </div>
    </div>
</div>
    
</body>
</html>