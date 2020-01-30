- [CRUD Pokémon](#crud-pok%c3%a9mon)
  - [Table Pokemon](#table-pokemon)
  - [Table Type](#table-type)
  - [Table POKEMON_TYPE](#table-pokemontype)
- [Créer un CRUD avec PDO et PHP procédural](#cr%c3%a9er-un-crud-avec-pdo-et-php-proc%c3%a9dural)
  - [Connexion à la base de données](#connexion-%c3%a0-la-base-de-donn%c3%a9es)
  - [Définitions](#d%c3%a9finitions)
  - [Utilisation de PDO](#utilisation-de-pdo)
    - [1. Rédiger votre requête](#1-r%c3%a9diger-votre-requ%c3%aate)
  - [2. Demander à PDO de préparer votre requête](#2-demander-%c3%a0-pdo-de-pr%c3%a9parer-votre-requ%c3%aate)
  - [3. Exécuter votre requête](#3-ex%c3%a9cuter-votre-requ%c3%aate)
    - [4. Récupérer les résultats](#4-r%c3%a9cup%c3%a9rer-les-r%c3%a9sultats)
    - [Requête complète avec un SELECT et plusieurs éléments](#requ%c3%aate-compl%c3%a8te-avec-un-select-et-plusieurs-%c3%a9l%c3%a9ments)
    - [Requête complète avec un SELECT et un seul élément et une variable](#requ%c3%aate-compl%c3%a8te-avec-un-select-et-un-seul-%c3%a9l%c3%a9ment-et-une-variable)
    - [Requête complète avec un INSERT](#requ%c3%aate-compl%c3%a8te-avec-un-insert)
  - [CAS BROWSE](#cas-browse)
  - [CAS READ](#cas-read)
  - [CAS ADD](#cas-add)
    - [`new.php`](#newphp)
    - [`create.php`](#createphp)
  - [CAS EDIT](#cas-edit)
  - [CAS DELETE](#cas-delete)

# CRUD Pokémon

> Les commentaires explicatifs se trouvent dans le CRUD de Type uniquement !

## Table Pokemon
- id            INT AI PK
- name          VARCHAR(30)
- description   TEXT
- size          INT
- weight        INT
- evolution_id  FK
- pokedex_id    INT
- 
## Table Type
- id            INT AI PK
- name          VARCHAR(30)

## Table POKEMON_TYPE
- id_pokemon    PK FK
- id_type       PK FK

---
# Créer un CRUD avec PDO et PHP procédural

## Connexion à la base de données
Créez un fichier, par exemple `db.php` qui contiendra la connexion à la base de données :

```php
<?php

const DB_HOST = 'localhost';
const DB_PORT = 8889;
const DB_NAME = 'hbpokemon';
const DB_USER = 'root';
const DB_PSWD = 'root';

try {
    $bdd = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8;port='.DB_PORT, DB_USER, DB_PSWD);
} catch(Exception $e) {
    var_dump($e);
    die;
}
```
> **IMPORTANT**: Vous importerez ce fichier à chaque fois que vous aurez besoin d'utiliser la base de données, grâce à `require_once('chemin/vers/db.php');`.


## Définitions
Un CRUD (Create, Read, Update, Delete) ou pour être plus précis BREAD (Browse, Read, Edit, Add, Delete) se compose des pages suivantes :

BREAD | CRUD     | Fichier(s) | Description
---------|---------|------------|---------
 BROWSE  | READ   | `list.php` | Affiche la liste des éléments
 READ    | READ   | `show.php` | Affiche 1 élément
 EDIT    | UPDATE | `edit.php` et `update.php` | Met à jour 1 élément
 ADD     | CREATE | `new.php` et `create.php`| Ajoute 1 élément
 DELETE  | DELETE | `delete.php` | Supprime 1 élément

À chaque fois que vous travaillerez avec une table  d'une base de données, vous utiliserez très certainement une ou plusieurs méthodes de cette liste !

## Utilisation de PDO

Pour toutes vos requêtes avec PDO, il faut : 
1. Rédiger votre requête, avec des pseudo-variables éventuellement
2. Demander à PDO de se préparer à votre requête
3. Exécuter la requête en indiquant les valeurs des pseudo-variables s'il y en a
4. Récupérer les résultats de la requête s'il y en a

### 1. Rédiger votre requête
Il s'agit d'une requête SQL classique **que vous aurez auparavant testée sur PHPMyAdmin ou MySQL Workbench**.
```php
$query = "SELECT * FROM dogs";
```

Vous pouvez spécifier des *pseudo-variables* à vos requêtes, c'est à dire indiquer à votre requête qu'elle va recevoir des variables, plutôt que de concaténer des valeurs directement dedans :

```php
$query = "INSERT INTO dogs(name, race) VALUES (:name, :race)
```

## 2. Demander à PDO de préparer votre requête
Simplement : 
```php
$response = $bdd->prepare($query);
```

## 3. Exécuter votre requête
Simplement :
```php
$response->execute();
```

Si éventuellement vous aviez des *pseudo-variables*, c'est le moment de leur donner une valeur :

```php
$response->execute([
    'name' => 'John',
    'race' => 'Shiba Inu,
]);
```

On peut évidemment passer une variable en valeur :

```php
$response->execute([
    'name' => $dogName,
    'race' => $dogRace,
]);
```
Ou encore :
```php
$response->execute([
    'name' => $_POST['name'],
    'race' => $_POST['race'],
]);
```

### 4. Récupérer les résultats
Pour récupérer les résultats **seulement s'il y en a de retournés**, c'est à dire pour les SELECT uniquement, pas pour les INSERT/UPDATE/DELETE, on fait comme suit :

```php
// Cas où il y a UNE SEULE ligne
$dog = $response->fetch(PDO::FETCH_ASSOC);

// Cas où il y a PLUSIEURS lignes
$dog = $response->fetchAll(PDO::FETCH_ASSOC);
```

**ATTENTION** aux nommages de variables ! Pensez bien à les nommer au singuler/pluriel en fonction de s'il y a un ou plusieurs éléments attendus et d'un nom que l'on reconnaît.


### Requête complète avec un SELECT et plusieurs éléments
```php
$query = "SELECT * FROM pokemon";   // La requête SQL
$response = $bdd->prepare($query);  // On demande à la bdd de se préparer  à une requête
$response->execute();   // On exécute la requête

$pokemons = $response->fetchAll(PDO::FETCH_ASSOC); // On récupère tous les éléments
```

### Requête complète avec un SELECT et un seul élément et une variable
```php
$query = "SELECT * FROM pokemon WHERE id = :id";   // La requête SQL
$response = $bdd->prepare($query);  // On demande à la bdd de se préparer  à une requête
$response->execute([
    'id' => $_GET['id']
]);   // On exécute la requête

$pokemon = $response->fetch(PDO::FETCH_ASSOC); // On récupère tous les éléments
```

### Requête complète avec un INSERT
```php
$query = "INSERT INTO type(name) VALUES(:name)";   // La requête SQL
$response = $bdd->prepare($query);  // On demande à la bdd de se préparer  à une requête
$response->execute([
    'name' => $_POST['name']
]);   // On exécute la requête

// Enfin : on ne retourne rien, donc pas de fetch/fetchAll !!
```

## CAS BROWSE
On cherche à afficher TOUS les éléments d'une table. Pour cela, on n'a besoin que d'un fichier, `list.php`, qui contiendra à la fois la requête et l'affichage :

> **Astuce** : vous pouvez ouvrir du PHP avec `<?= $var ?>` si vous comptiez faire un `<?php echo $var ?>` : en effet, le `=` comptera comme un `echo`.

```php
<?php
require_once('../config/db.php');   // Import du fichier de DB

$query = "SELECT * FROM pokemon";   // La requête SQL
$response = $bdd->prepare($query);  // On demande à la bdd de se préparer  à une requête
$response->execute();   // On exécute  la requête

$pokemons = $response->fetchAll(PDO::FETCH_ASSOC); // On récupère TOUS les éléments dans un array, que je pourrai passer dans un foreach dans le HTML :
?>

<html>
    <body>

        <ul>
        <?php foreach($pokemons as $pokemon) : ?>
            <li><?= $pokemon['name'] ?></li>
        <?php endforeach; ?>
        </ul>
    </body>
</html>
```

On peut aussi par exemple ajouter un lien vers le cas READ, c'est à dire l'affichage d'un élément, en passant un paramètre `GET`, par exemple nommé `id` :

```html
<li><a href="show.php?id=<?= $pokemon['name'] ?>">Voir plus d'informations</a></li>
```

## CAS READ
En général, on vient sur cette page depuis un lien, qui nous a fourni en paramètre `GET` l'`id` de l'élément à consulter. Pour le reste, c'est exactement comme pour le cas BROWSE, on a la requête et le HTML dans un même fichier `show.php`.

Attention à la requête qui prend cette fois une variable (l'id) !

```php
<?php
require_once('../config/db.php');   // Import du fichier de DB

$query = "SELECT * FROM pokemon WHERE id = :id";   // La requête SQL
$response = $bdd->prepare($query);  // On demande à la bdd de se préparer  à une requête
$response->execute([
    'id' => $_GET['id']
]);   // On exécute  la requête

// On a UN seul élément ! Donc variable au SINGULILER et fetch plutôt que fetchAll :
$pokemon = $response->fetch(PDO::FETCH_ASSOC);
?>

<html>
    <body>
        <ul>
        // PAS besoin de foreach ! Je n'ai qu'UN seul élément !
            <li><?= $pokemon['name'] ?></li>
        </ul>
    </body>
</html>
```

## CAS ADD
Cette fois on aura deux pages : par exemple `new.php` qui contiendra le formulaire, et `create.php` qui contiendra le traitement du formulaire (l'INSERT en base de données).

### `new.php`

Il s'agit d'un simple formulaire auquel on fait attention à la balise `form` qui doit prendre une `action` et une `method`, et aux `inputs`/`selects`/`textarea` qui doivent prendre un attribut `name` :

`new.php`
```html
<form action="create.php" method="post">
    <input id="formSize" name="size">
</form>
```

### `create.php`
Cela nous permettra de récupérer dans `create.php` une superglobale `$_POST` qui contiendra les champs nommés par les `name` du formulaire de `new.php` :

`create.php`
```php
<?php
require_once('../../config/db.php');

// Ma requête avec des pseudovariables
$query = "INSERT INTO pokemon(name, description, size, weight, evolution_id, pokedex_id)
            VALUES (:name, :description, :size, :weight, :evolution_id, :pokedex_id)";

// Préparée...
$response = $bdd->prepare($query);

// Et exécutée en lui donnant les valeurs qui correspondent
$response->execute([
    'name'          => $_POST['name'],
    'description'   => $_POST['description'],
    'size'          => $_POST['size'],
    'weight'        => $_POST['weight'],
    'evolution_id'  => $_POST['evolution_id'],
    'pokedex_id'    => $_POST['pokedex_id'],
]);

// PAS de fetch/fetchAll ! Puisqu'un INSERT ne retourne pas de données ! Une redirection éventuellement vers la page de tous les éléments :

header('Location: list.php');
```

## CAS EDIT
Très similaire à ADD, on a besoin d'un formulaire `edit.php` et d'une page de traitement `update.php`.

La seule différence étant que nous avons besoin des données d'origine dans `edit.php` de sorte à pouvoir pré-compléter le formulaire des données actuelles !

Il suffit de reprendre la requête d'un READ et de l'ajouter dans `edit.php`.

Bien sûr, le lien nous envoyant sur `edit.php` nous a sans doute passé un paramètre `GET` type : `edit.php?id=12` pour savoir de quel élément nous parlons.


`add.php`
```php
<?php
require_once('../config/db.php');   // Import du fichier de DB

$query = "SELECT * FROM dogs WHERE id = :id";   // La requête SQL
$response = $bdd->prepare($query);  // On demande à la bdd de se préparer  à une requête
$response->execute([
    'id' => $_GET['id']
]);   // On exécute  la requête

// On a UN seul élément ! Donc variable au SINGULILER et fetch plutôt que fetchAll :
$pokemon = $response->fetch(PDO::FETCH_ASSOC);
?>

<form action="edit.php" method="post">

    // On passe en input:hidden l'ID de l'élément à modifier
    // pour que la page de traitement puisse savoir de quel élément
    // on parle !
    <input type="hidden" name="id" value="<?= $dog['id'] ?>">
    <input id="formSize" name="size" value="<?= $dog['size'] ?>">
</form>
```

`edit.php`
```php
<?php
// On importe la bdd
require_once('../../config/db.php');

// On rédige la requête avec des pseudo-variables
$query = "UPDATE dogs SET size = :size WHERE id = :id";
$response = $bdd->prepare($query);

// On exécute la requête en indiquant à quoi correspondent les pseudo-variables
$response->execute([
    'id'    => $_POST['id'],
    'size'    => $_POST['size'],
]);

// UPDATE ne retourne rien : pas de fetch/fetchAll ! Une redirection éventuellement vers la page de l'élément modifié :

header('Location: show.php?id=' . $_POST['id']);
```

## CAS DELETE
Pour ce cas, nous n'avons qu'une page de traitement : `delete.php`. En effet, en général, on va simplement cliquer sur un lien qui passera en `GET` l'ID à supprimer : `delete.php?id=12`.

`delete.php`

```php
<?php
// On importe la base de données
require_once('../../config/db.php');

// On prépare la requête avec des pseudo-variables
$query = "DELETE FROM type WHERE id = :id";
$response = $bdd->prepare($query);

// On indique à quoi correspondent les pseudo-variables
$response->execute([
    'id'    => $_GET['id'],
]);

// On redirige vers la liste des éléments
header('Location: list.php');
```