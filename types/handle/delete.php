<?php
// On importe la base de données
require_once('../../config/db.php');

// On prépare la requête avec des pseudo-variables
$query = "DELETE FROM type WHERE id = :id";
$response = $bdd->prepare($query);

// On indique à quoi correspondent les pseudo-variables
$response->execute([
    'id'    => $_GET['id'],
]);

// On redirige vers la liste
header('Location: ../list.php');