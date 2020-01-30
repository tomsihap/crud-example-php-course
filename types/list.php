<?php
// On inclut le header commun à toutes les pages
include_once('../_partials/header.php');

// On inclut le fichier contenant la base de données et la variable $bdd
require_once('../config/db.php');

// Requête pour récupérer tous les types
$query = "SELECT * FROM type";

// On "prépare" la requête, c'est à dire qu'on dit à PDO de se préparer à exécuter une requête
$response = $bdd->prepare($query);

// On exécute la requête (sans paramètres ici car nous n'avons pas de variables à donner à la requête)
$response->execute([]);

// On récupère le résultat de la requête. Comme il y a plusieurs éléments, on utilise fetchAll, qui nous retourne un tableau de plusieurs éléments
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
            <!-- Comme on a accès à $type, on l'utilise dans notre page -->
            <td><?= $type['id'] ?></td>

            <!-- On envoie à la page show.php le paramètre "id", contenant l'id de notre élément à afficher dans show.php -->
            <td><a href="show.php?id=<?= $type['id'] ?>"><?= $type['name'] ?></a></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include_once('../_partials/footer.php'); ?>