<?php
$content='';
require "loader.php";
//$fichier = fopen("sauvegarde.txt", "a");
//fwrite($fichier, $_POST['pseudo'] . "/");
//fwrite($fichier, $_POST['password'] . "\n");
////   fwrite($fichier, date());
//fclose($fichier);

$pseudo = $_POST['pseudo'];
$password = md5($_POST['password']);

if (empty($pseudo) OR empty($password)) {
    $content = '<font color="red">Attention, aucun champs ne peut rester vide !</font>';
}
$sql = "SELECT id_membre, pseudo, mdp FROM membre where pseudo = :u";
$requete = $connexion->prepare($sql); //, PDO::FETCH_ASSOC
$requete->bindParam(':u', $pseudo);
//execute la requete
$requete->execute();

$res = $requete->fetchAll();
if (empty($res)) {
    $content = '<font color="red">Le pseudo est inconnu, merci de controler votre saisie !</font>';
}
//print_r($res);
//foreach ($res as $key => $value) {
//    foreach ($value as $key1 => $value1) {
//        $key1 . " > " . $value1;
//    }
//}

//if ($password == $res[0][2]) {
//    $content =  "Bienvenue sur votre session";
//    
//}
?>