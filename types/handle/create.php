<?php
require_once('../../config/db.php');

$query = "INSERT INTO type(name) VALUES (:name)";
$response = $bdd->prepare($query);
$response->execute([
    'name' => $_POST['name'],
]);