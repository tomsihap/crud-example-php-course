<?php
include_once('../_partials/header.php');
require_once('../config/db.php');

$query = "SELECT * FROM pokemon WHERE id = :id";
$response = $bdd->prepare($query);
$response->execute([
    'id' => $_GET['id']
]);

$pokemon = $response->fetch(PDO::FETCH_ASSOC);

?>


<a href="show.php?id=<?= $pokemon['id'] ?>" class="small"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retour au Pokémon</a>

<h1>Créer un Pokémon</h1>
<form action="handle/update.php" method="post">
    <input type="hidden" name="id" value="<?= $pokemon['id'] ?>">
    <div class="form-group">
        <label for="">Nom du Pokémon</label>
        <input type="text" class="form-control" name="name" value="<?= $pokemon['name'] ?>">
    </div>
    <div class="form-group">
        <label for="">Description</label>
        <input type="text" class="form-control" name="description" value="<?= $pokemon['description'] ?>">
    </div>
    <div class="form-group">
        <label for="">Taille</label>
        <input type="text" class="form-control" name="size" value="<?= $pokemon['size'] ?>">
    </div>
    <div class="form-group">
        <label for="">Poids</label>
        <input type="text" class="form-control" name="weight" value="<?= $pokemon['weight'] ?>">
    </div>
    <div class="form-group">
        <label for="">Évolution (evolution_id)</label>
        <input type="text" class="form-control" name="evolution_id" value="<?= $pokemon['evolution_id'] ?>">
    </div>
    <div class="form-group">
        <label for="">Pokédex #</label>
        <input type="text" class="form-control" name="pokedex_id" value="<?= $pokemon['pokedex_id'] ?>">
    </div>
    <div class="form-group">
        <label for="">Type</label>
        <input type="text" class="form-control" name="type">
    </div>

    <button class="btn btn-warning pull-right">Éditer le Pokémon</button>
</form>

<?php include_once('../_partials/footer.php'); ?>