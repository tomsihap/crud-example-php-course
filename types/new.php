<?php include_once('../_partials/header.php'); ?>

<a href="list.php" class="small"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retour à la liste</a>
<h1>Créer un type</h1>
<form action="handle/create.php" method="post">
    <div class="form-group">
        <label for="typeName">Nom</label>
        <input id="typeName" type="text" class="form-control" name="name">
    </div>

    <button class="btn btn-success pull-right">Créer le type</button>
</form>

<?php include_once('../_partials/footer.php'); ?>