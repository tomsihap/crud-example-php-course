<?php
include_once('../_partials/header.php');
require_once('../config/db.php');

$query = "SELECT * FROM type";
$response = $bdd->prepare($query);
$response->execute(['id' => $_GET['id']]);

$type = $response->fetch(PDO::FETCH_ASSOC);

?>

<a href="list.php" class="small"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retour à la liste</a>
<h1>Éditer un type</h1>
<form action="handle/update.php" method="post">
    <input type="hidden" name="id" value="<?= $type['id']?>">
    <div class="form-group">
        <label for="typeName">Nom</label>
        <input id="typeName" type="text" class="form-control" name="name" value="<?= $type['name']?>">
    </div>

    <button class="btn btn-warning pull-right">Éditer le type</button>
</form>

<?php include_once('../_partials/footer.php'); ?>