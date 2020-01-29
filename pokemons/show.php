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
<a href="../index.php" class="small"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retour à l'accueil</a>
<h1>Pokémon : <?= $pokemon['name'] ?></h1>
<a href="list.php" class="small"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retour à la liste</a>

<div class="card">
    <div class="card-header">
        <i id="spinner" class="fa fa-spinner fa-spin"></i>
        <img id="pokemonImage" src="" style="display:none">
        <?= $pokemon['id'] ?>: <?= $pokemon['name'] ?><br>
        <small>Pokédex # : <?= $pokemon['pokedex_id'] ?></small>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-4">
                <ul>
                    <li><strong>Taille :</strong> <?= $pokemon['size'] ?></li>
                    <li><strong>Poids :</strong> <?= $pokemon['weight'] ?></li>
                    <li><strong>Évolution :</strong> <?= $pokemon['evolution_id'] ?></li>
                    <li><strong>Types :</strong>TODO</li>
                </ul>
            </div>
            <div class="col-8">
                <strong>Description :</strong> <?= $pokemon['description'] ?>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <a href="handle/delete.php?id=<?= $pokemon['id'] ?>" class="btn btn-danger pull-right ml-2">Supprimer</a>
        <a href="edit.php?id=<?= $pokemon['id'] ?>" class="btn btn-warning pull-right">Éditer</a>
    </div>
</div>


<?php include_once('../_partials/footer.php'); ?>

<script>
    $(function() {
        $.ajax('https://pokeapi.co/api/v2/pokemon/<?= $pokemon['pokedex_id'] ?>')
        .done(function(data) {
            document.getElementById('pokemonImage').src = data.sprites.front_default;
            $('#pokemonImage').show();
            $('#spinner').hide();
        });
    });
</script>