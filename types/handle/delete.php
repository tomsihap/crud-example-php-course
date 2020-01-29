<?php
require_once('../../config/db.php');

$query = "DELETE FROM type WHERE id = :id";
$response = $bdd->prepare($query);
$response->execute([
    'id'    => $_GET['id'],
]);

header('Location: ../list.php');