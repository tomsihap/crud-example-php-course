<?php
// On inclut le header commun à toutes les pages
include_once('../_partials/header.php');

// On inclut le fichier contenant la base de données et la variable $bdd
require_once('../config/db.php');

// Notre requête pour récupérer UN type.
// Elle contient une variable : l'ID (il vient de la page list.php en paramètre GET)
$query = "SELECT * FROM type WHERE id = :id";

// On demande à la bdd de se préparer à avoir la requête
$response = $bdd->prepare($query);

// On exécute la requête en passant en paramètres de execute() un tableau contenant :
// les pseudo-variables (:id) => la valeur correspondante (l'id passé en GET depuis list.php)
$response->execute([
    'id' => $_GET['id']
]);

// On récupère le résultat. Comme il s'agit que d'UNE ligne, on utilise fetch, qui retourne le tableau de la ligne uniquement, et pas un tableau de résultats contenant le tableau de la ligne.
$type = $response->fetch(PDO::FETCH_ASSOC);

?>


<a href="list.php" class="small"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retour à la liste</a>

<!-- Comme on a accès à $type, qui est rempli des données de la bdd, on l'utilise dans notre page : -->
<h1>Type : <?= $type['name'] ?></h1>

<!-- Pour les pages edit.php et delete.php, on envoie en paramètres GET l'id de l'élément à modifier -->
<a href="handle/delete.php?id=<?= $type['id'] ?>" class="btn btn-sm btn-danger pull-right ml-2">Supprimer</a>
<a href="edit.php?id=<?= $type['id'] ?>" class="btn btn-sm btn-warning pull-right">Éditer</a>


<?php include_once('../_partials/footer.php'); ?>