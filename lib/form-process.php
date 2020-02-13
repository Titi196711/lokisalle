<?php
require "../lib/loader.php";

    global $connexion;
    $cat = $_GET['cat'];
    $vil = $_GET['vil'];
    $cap = $_GET['cap'];
    $pri = $_GET['pri'];
    $daa = $_GET['daa'];
    $dad = $_GET['dad'];
    if (empty($daa)){
        $daa = "2020-01-01";
    }
     if (empty($dad)){
        $dad = "2020-12-01";
    }
    //echo $cat.$vil.$cap.$pri.$daa.$dad;
//    $sql = "SELECT * \n"
//            . "FROM salle \n"
//            . "JOIN produit ON produit.salle_id = salle.id_salle\n"
//            . " WHERE categorie = :cat\n"
//            . " AND ville = :vil\n"
//            . " AND capacite = :cap\n"
//            . " AND prix = :pri\n"
//            . " AND date_arrivee = :daa\n"
//            . " AND date_depart = :dad\n"
//            . " AND etat = libre";

$sql = "SELECT * FROM salle JOIN produit ON produit.salle_id = salle.id_salle WHERE categorie = :cat and ville = :vil and etat = 'libre'";
    $requete = $connexion -> prepare($sql);//, PDO::FETCH_ASSOC
    $requete -> bindParam(':cat', $cat, PDO::PARAM_STR);
    $requete -> bindParam(':vil', $vil, PDO::PARAM_STR);

//    $requete -> bindParam(':cap',$cap);
//    $requete -> bindParam(':pri',$pri);
//    $requete -> bindParam(':daa',$daa);
//    $requete -> bindParam(':dad',$dad);
    //execute la requete
    $requete->execute();

    $resultat = $requete->fetchAll();

    $r = []; //tableau vide
    foreach ($resultat as $row) {
        //Tableau Salle qui va être ajouté au tableau r[]
        $produit["id_salle"] = $row['id_salle'];
        $produit["titre"] = $row["titre"]; 
        $produit["description"] = $row["description"];
        $produit["photo"] = $row["photo"];
        $produit["capacite"] = $row["capacite"];
        $produit["categorie"] = $row["categorie"];
        $produit["etat"] = $row["etat"];
        $produit["prix"] = $row["prix"];
        $produit["date_arrivee"] = $row["date_arrivee"];
        $produit["date_depart"] = $row["date_depart"];
        $r[] = $produit;
    }
    header('Location: ../pages/fiche_produit.php?s1='.$resultat[0]["id_salle"].'&s2='.$resultat[1]["id_salle"].'&s3='.$resultat[2]["id_salle"].'&s4='.$resultat[3]["id_salle"].'&s5='.$resultat[4]["id_salle"]);    
    //renvoyer les résultats
    return $r;
    
?>
