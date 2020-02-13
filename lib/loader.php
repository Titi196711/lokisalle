<?php
try {
//    $connexion = new PDO("mysql:host=localhost;dbname=lokisalle", "root", "");
    $connexion = new PDO("mysql:host=188.130.25.25;dbname=ejr67041;port=3306","ejr67041","RqXMkf5vyTDm");
    $connexion->exec('SET NAMES utf8'); //facultatif pour mettre les caractères en UTF8
} catch (Exception $ex) {
    die("Erreur : " . $ex->getMessage());
}
require "../lib/libr.php";
//SESSION
session_start();

//VARIABLES
$content = "";

//CHEMIN
//define("RACINE_SITE", "/pages/");
?>
