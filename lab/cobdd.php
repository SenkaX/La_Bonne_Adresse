<!-- cette page permet de se connecter à la base de donnée -->
<?php
$engine = "mysql";
$host = "localhost";
$port = 3306;
$dbName = "lba";
$username = "root";
$password = "root";
$pdo = new PDO("$engine:host=$host:$port;dbname=$dbName", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>