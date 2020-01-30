<?php

// On importe la bdd
require_once('../../config/db.php');

// On rédige la requête avec des pseudo-variables
$query = "UPDATE type SET name = :name WHERE id = :id";
$response = $bdd->prepare($query);

// On exécute la requête en indiquant à quoi correspondent les pseudo-variables
$response->execute([
    'id'    => $_POST['id'],
    'name'  => $_POST['name'],
]);

// On redirige vers la page de l'élément modifié
header('Location: ../show.php?id='.$_POST['id']);