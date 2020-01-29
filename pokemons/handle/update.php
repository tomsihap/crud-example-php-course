<?php
require_once('../../config/db.php');

$query = "  UPDATE pokemon
            SET name = :name, description = :description, size = :size,
                weight = :weight, evolution_id = :evolution_id,
                pokedex_id = :pokedex_id
            WHERE id = :id";

$response = $bdd->prepare($query);
$response->execute([
    'id'            => $_POST['id'],
    'name'          => $_POST['name'],
    'description'   => $_POST['description'],
    'size'          => $_POST['size'],
    'weight'        => $_POST['weight'],
    'evolution_id'  => $_POST['evolution_id'],
    'pokedex_id'    => $_POST['pokedex_id'],
]);

header('Location: ../show.php?id=' . $_POST['id']);