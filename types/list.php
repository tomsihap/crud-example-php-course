<?php
include_once('../_partials/header.php');
require_once('../config/db.php');

$query = "SELECT * FROM type";
$response = $bdd->prepare($query);
$response->execute([]);

$types = $response->fetchAll(PDO::FETCH_ASSOC);

?>


<a href="../index.php" class="small"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retour à l'accueil</a>
<h1>Liste des types</h1>
<a href="new.php" class="btn btn-sm btn-primary">Ajouter un type</a>

<table class="table table-striped">
    <thead>
        <th>id</th>
        <th>name</th>
    </thead>
    <?php foreach ($types as $type) : ?>
        <tr>
            <td><?= $type['id'] ?></td>
            <td><a href="show.php?id=<?= $type['id'] ?>"><?= $type['name'] ?></a></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include_once('../_partials/footer.php'); ?>