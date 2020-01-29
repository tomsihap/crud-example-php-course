<?php
include_once('../_partials/header.php');
require_once('../config/db.php');

$query = "SELECT * FROM pokemon";
$response = $bdd->prepare($query);
$response->execute();

$pokemons = $response->fetchAll(PDO::FETCH_ASSOC);

?>
<a href="../index.php" class="small"><i class="fa fa-arrow-left" aria-hidden="true"></i> Retour à l'accueil</a>
<h1>Liste des Pokémons</h1>
<a href="new.php" class="btn btn-sm btn-primary">Ajouter un Pokémon</a>


<table class="table table-striped">
    <thead>
        <th>#</th>
        <th>Image</th>
        <th>name</th>
        <th>description</th>
        <th>size</th>
        <th>weight</th>
        <th>evolution_id</th>
        <th>pokedex_id</th>
    </thead>

    <?php foreach ($pokemons as $pokemon) : ?>
        <tr>
            <td><?= $pokemon['id'] ?></td>
            <td>
                <i class="fa fa-spinner fa-spin"></i>
                <img id="pokemonImage-<?= $pokemon['id'] ?>" src="test" alt="" data-pokedex="<?= $pokemon['pokedex_id'] ?>">
            </td>
            <td><a href="show.php?id=<?= $pokemon['id'] ?>"><?= $pokemon['name'] ?></a></td>
            <td><?= $pokemon['description'] ?></td>
            <td><?= $pokemon['size'] ?></td>
            <td><?= $pokemon['weight'] ?></td>
            <td><?= $pokemon['evolution_id'] ?></td>
            <td><?= $pokemon['pokedex_id'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include_once('../_partials/footer.php'); ?>


<script>
    $(function() {

        $('[id^=pokemonImage-]').each(function() {

            let pokedexId = $(this).data('pokedex');
            let self = $(this);

            $.ajax('https://pokeapi.co/api/v2/pokemon/' + pokedexId)
                .done(function(data) {
                    self.attr('src', data.sprites.front_default);
                    self.show();
                    $('.sfa-spinner').each(function(){
                        $(this).hide();
                    });
                });

        })

    });
</script>