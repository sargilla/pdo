<?php 

	require 'conection.php';

	function guardarPelicula($db,$datos){
		$query = $db->prepare("INSERT INTO movies (title,rating,awards,release_date,length,genre_id) values (:title,:rating,:awards,:release_date,:length,:genre_id)");
		$res = $query->execute([
			'title' => $datos["title"],
			'rating' => $datos["rating"],
			'awards' => $datos["awards"],
			'release_date' => $datos["release_date"],
			'length' => $datos["length"]? $datos["length"] : '0',
			'genre_id' => isset($datos['genre_id']) ? $datos['genre_id'] : null 
		]);

		return $res ? $res : $query->errorInfo();
		
	}

	function traerGeneros(PDO $db) {
		$query = $db->prepare("SELECT * FROM genres");
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}

   	$generos = traerGeneros($db);

	if($_POST){
		
		$errores = [];
		$datos = $_POST;
		if(!$datos['title']){
			$errores['title'] = 'Debe completar un título';
		}
		$datos["rating"] = $datos["rating"] ? $datos["rating"] : '0.0';
		$datos["awards"] = $datos["awards"] ? $datos["awards"] : '0';
		$datos['release_date'] = $datos["year"].'-'.$datos["month"].'-'.$datos["day"].' 00:00:00';
		
		if(!count($errores)){
			$res = guardarPelicula($db,$datos);
			if($res){
				header("Location:peliculas.php?exito=true");
			};
		}
	}




?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Agregar Pelicula</title>
	
</head>
<body>
	<form method="post" action="<?=$_SERVER['PHP_SELF']?>">
		<div>
			<label>Titulo</label>
			<input type="text" name="title" >
			<?php if(isset($errores['title'])) : ?>
				<span><?=$errores['title'] ?></span>
			<?php endif; ?>
		</div>
		<div>
			<label>Género</label>
			<select name="genero">
				<?php foreach($generos as $genero): ?>
					<option value="<?php echo $genero['name'];?>"><?php echo $genero['name'];?></option>
				<?php endforeach;?>
			</select>
		</div>
		<div>
			<label>Rating</label>
			<input type="text" name="rating" >
		</div>
		<div>
			<label>Premios</label>
			<input type="text" name="awards" >
		</div>
		<div>
			<label>Duracion</label>
			<input type="text" name="length" >
		</div>
		<div>
			<label>Fecha de Estreno</label> <br>
			<i>Año: </i>
			<select name="year">
				<?php for ($i=2018; $i >= 1920; $i--) { ?>
					<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php } ?>
			</select>
			<i>Mes: </i>
			<select name="month">
				<?php for ($i=1; $i < 13; $i++) { ?>
					<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php } ?>
			</select>
			<i>Día: </i>
			<select name="day">
				<?php for ($i=1; $i < 32; $i++) { ?>
					<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
				<?php } ?>
			</select>
		</div>
		<button type="submit">Guardar película</button>
	</form>
</body>

</html>
