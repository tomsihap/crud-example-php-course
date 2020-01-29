<?php
require_once('../../config/db.php');

$query = "UPDATE type SET name = :name WHERE id = :id";
$response = $bdd->prepare($query);
$response->execute([
    'id'    => $_POST['id'],
    'name'  => $_POST['name'],
]);

header('Location: ../show.php?id='.$_POST['id']);