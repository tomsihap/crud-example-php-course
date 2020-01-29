<?php
require_once('../../config/db.php');

$query = "INSERT INTO pokemon(name, description, size, weight, evolution_id, pokedex_id)
            VALUES (:name, :description, :size, :weight, :evolution_id, :pokedex_id)";

$response = $bdd->prepare($query);
$response->execute([
    'name'          => $_POST['name'],
    'description'   => $_POST['description'],
    'size'          => $_POST['size'],
    'weight'        => $_POST['weight'],
    'evolution_id'  => $_POST['evolution_id'],
    'pokedex_id'    => $_POST['pokedex_id'],
]);