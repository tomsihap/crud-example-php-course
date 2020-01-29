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