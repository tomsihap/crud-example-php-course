<?php include_once('../_partials/header.php'); ?>

<a href="list.php" class="small"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retour à la liste</a>

<h1>Créer un Pokémon</h1>
<form action="handle/create.php" method="post">
    <div class="form-group">
        <label for="">Nom du Pokémon</label>
        <input type="text" class="form-control" name="name">
    </div>
    <div class="form-group">
        <label for="">Description</label>
        <input type="text" class="form-control" name="description">
    </div>
    <div class="form-group">
        <label for="">Taille</label>
        <input type="text" class="form-control" name="size">
    </div>
    <div class="form-group">
        <label for="">Poids</label>
        <input type="text" class="form-control" name="weight">
    </div>
    <div class="form-group">
        <label for="">Évolution (evolution_id)</label>
        <input type="text" class="form-control" name="evolution_id">
    </div>
    <div class="form-group">
        <label for="">Pokédex #</label>
        <input type="text" class="form-control" name="pokedex_id">
    </div>
    <div class="form-group">
        <label for="">Type</label>
        <input type="text" class="form-control" name="type">
    </div>

    <button class="btn btn-success pull-right">Créer le Pokémon</button>
</form>

<?php include_once('../_partials/footer.php'); ?>