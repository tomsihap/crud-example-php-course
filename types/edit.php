<?php
// On inclut le header commun à toutes les pages
include_once('../_partials/header.php');

// On inclut le fichier contenant la connexion à la base de données et la variable $bdd
require_once('../config/db.php');

// On rédige notre requête qui nous retournera les informations du type
$query = "SELECT * FROM type WHERE id = :id";
// On demande à la base de données de se préparer à executer une requête
$response = $bdd->prepare($query);
// On exécute la requête en remplissant les pseudo-variables par leurs données
$response->execute(['id' => $_GET['id']]);
// Un seul élément, donc on utilise fetch() plutôt que fetchAll()
$type = $response->fetch(PDO::FETCH_ASSOC);

?>

<a href="list.php" class="small"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retour à la liste</a>
<h1>Éditer un type</h1>
<form action="handle/update.php" method="post">

    <!-- J'ai besoin d'envoyer à update.php l'id de l'élément à modifier : je le met dans un input hidden, qui existera dans $_POST mais qui sera caché à l'utilisateur sur la page du formulaire -->
    <input type="hidden" name="id" value="<?= $type['id']?>">
    <div class="form-group">
        <label for="typeName">Nom</label>
        <!-- On préremplit les champs (en remplissant "value") avec les données actuelles de l'élément à modifier-->
        <input id="typeName" type="text" class="form-control" name="name" value="<?= $type['name']?>">
    </div>

    <button class="btn btn-warning pull-right">Éditer le type</button>
</form>

<?php include_once('../_partials/footer.php'); ?>