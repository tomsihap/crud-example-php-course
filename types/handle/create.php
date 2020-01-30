<?php
// On importe la bdd
require_once('../../config/db.php');

// On rédige la requête qui contient des pseudo-variables (ici, "name")
$query = "INSERT INTO type(name) VALUES (:name)";
$response = $bdd->prepare($query);

// On exécute en indiquant à quoi correspondent les pseudo-variables
$response->execute([
    'name' => $_POST['name'],
]);