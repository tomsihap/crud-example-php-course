<?php
include_once('../_partials/header.php');
require_once('../config/db.php');

$query = "SELECT * FROM type WHERE id = :id";
$response = $bdd->prepare($query);
$response->execute(['id' => $_GET['id']]);

$type = $response->fetch(PDO::FETCH_ASSOC);

?>


<a href="list.php" class="small"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retour à la liste</a>
<h1>Type : <?= $type['name'] ?></h1>

<a href="handle/delete.php?id=<?= $type['id'] ?>" class="btn btn-sm btn-danger pull-right ml-2">Supprimer</a>
<a href="edit.php?id=<?= $type['id'] ?>" class="btn btn-sm btn-warning pull-right">Éditer</a>


<?php include_once('../_partials/footer.php'); ?>