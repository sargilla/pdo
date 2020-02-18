<?php 
	function guardarPelicula($db,$datos){
		// echo "<pre>";
		// var_dump($datos); 

		$query = $db->prepare("INSERT INTO movies ('title','rating','awards','release_date','length','genre_id') values (:title,:rating:,:awards,:release_date,:length,:genre_id)");
		return $query->execute([
			'title' => $datos["title"],
			'rating' => $datos["rating"],
			'awards' => $datos["awards"],
			'release_date' => $datos["year"].'-'.$datos["month"].'-'.$datos["day"].' 00:00:00',
			'length' => $datos["length"],
			'genre_id' => isset($datos['genre_id']) ? $datos['genre_id'] : null 
		]);
	}

	if($_POST){
		require 'conection.php';
		
		$res = guardarPelicula($db,$_POST);
		var_dump($res);
		
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
