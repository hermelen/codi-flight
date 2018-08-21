<?php
$pdo = new PDO("mysql:host=".$hostName.";dbname=".$dbName, $user, $pass);

$flights = $pdo->prepare('SELECT * FROM flight');

$flights->execute();
