<?php
// On inclut le header commun à toutes les pages
include_once('../_partials/header.php');
?>

<a href="list.php" class="small"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retour à la liste</a>
<h1>Créer un type</h1>

<!-- Le formulaire sera envoyé en POST à la page handle/create.php -->
<form action="handle/create.php" method="post">
    <div class="form-group">
        <label for="typeName">Nom</label>

        <!-- Le paramètre "name" sera envoyé en POST, car il est renseigné dans le "name" du input -->
        <input id="typeName" type="text" class="form-control" name="name">
    </div>

    <!-- Le bouton doit bien se trouver DANS les balises <form></form> pour fonctionner -->
    <button class="btn btn-success pull-right">Créer le type</button>
</form>

<!-- On inclut le footer commun à toutes les pages -->
<?php include_once('../_partials/footer.php'); ?>