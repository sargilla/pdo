<?php 
$dsn = 'mysql:host=localhost;dbname=movies_db;port=3306';
$user = 'root';
$pass = 'root';

function abrirBaseDeDatos($dsn, $user, $pass) {
    try {
      return new PDO($dsn,$user,$pass,[PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
  } catch (PDOException $Exception){
      echo $Exception->getMessage();
      exit;
  } 
}

$db = abrirBaseDeDatos($dsn, $user, $pass);
?>
