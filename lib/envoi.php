<?php

require "loader.php";
//$fichier = fopen("sauvegarde.txt", "a");
//fwrite($fichier, $_POST['pseudo'] . "/");
//fwrite($fichier, $_POST['password'] . "\n");
//fwrite($fichier, $_POST['username'] . "\n");
//fwrite($fichier, $_POST['secondname'] . "\n");
//fwrite($fichier, $_POST['email'] . "\n");
//fwrite($fichier, $_POST['inlineRadioOptions'] . "\n");
////   fwrite($fichier, date());
//fclose($fichier);

$pseudo = $_POST['pseudo'];
$password = $_POST['password'];
$username = $_POST['username'];
$secondname = $_POST['secondname'];
$email = $_POST['email'];
$sexe = $_POST['inlineRadioOptions'];

if(empty($pseudo) OR empty($password) OR empty($username) OR empty($secondname) or empty($email) or empty($sexe))
{
echo '<font color="red">Attention, aucun champs ne peut rester vide !</font>';
}else{
//            if ($sexe == "femme"){
//                $sexe = "Madame";
//            }else{
//                $sexe = "Monsieur";
//            }

$req = "INSERT INTO membre(id_membre,pseudo,mdp,nom,prenom,email,civilite,statut) "
. "VALUES ('','$pseudo',md5('$password'),'$username','$secondname','$email','$sexe','0')";
$res = $connexion->exec($req);
echo "Ligne insérée = ".$res;
}
?>
