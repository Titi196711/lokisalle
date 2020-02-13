<?php

function readSalle($i) {
    //connexion
    //$connexion = new PDO("mysql:host=localhost;dbname=jour2", "root", "");
    global $connexion;
    //faire une requete
    
    $sql = "SELECT * FROM salle where id_salle = :i";
    $requete = $connexion -> prepare($sql);//, PDO::FETCH_ASSOC
    $requete -> bindParam(':i',$i);
    //execute la requete
    $requete->execute();

    $resultat = $requete->fetchAll();

    $r = []; //tableau vide
    foreach ($resultat as $row) {
        //Tableau Salle qui va être ajouté au tableau r[]
        $client["id_salle"] = $row["id_salle"];
        $client["titre"] = $row["titre"]; //Pour élise $row["nom"]
        $client["description"] = $row["description"];
        $client["photo"] = $row["photo"];
        $client["pays"] = $row["pays"];
        $client["ville"] = $row["ville"];
        $client["adresse"] = $row["adresse"];
        $client["cp"] = $row["cp"];
        $client["capacite"] = $row["capacite"];
        $client["categorie"] = $row["categorie"];
        $r[] = $client;
    }
    //renvoyer les résultats
    return $r;
}

function ecritSalle(){
     if (isset($_POST['titre']) AND isset($_POST['description']) AND isset($_POST['photo']) AND isset($_POST['pays']))
        {
            $titre=$_POST['titre'];
            $desc=$_POST['description'];
            $photo=$_POST['photo'];
            $pays=$_POST['pays'];
         
            if(empty($titre) OR empty($desc) OR empty($photo) OR empty($pays))
            {
                echo '<font color="red">Attention, aucun champs ne peut rester vide !</font>';
            }
         
            $conn = mysqli_connect('localhost', 'root', '', 'lokisalle');
            $req = "INSERT INTO salle(id,titre,description,photo,pays) VALUES ('','$titre','$desc','$photo','$pays')";
            $res = $conn->query($req);
            mysqli_close($conn);
            //header('Location: commande-reussie.php');
        }
        else
        {
            echo '<font color="red">Attention, aucun champs ne peut rester vide !</font>';
        }
}

function prixSalle(){
    //connexion
    //$connexion = new PDO("mysql:host=localhost;dbname=jour2", "root", "");
    global $connexion;
    //faire une requete
    
    $sql = "select id_salle, titre, capacite, photo, categorie, description, etat, prix, date_arrivee, date_depart\n"
    . "FROM salle\n"
    . "JOIN produit\n"
    . "ON salle.id_salle = produit.salle_id order by id_salle";
    $requete = $connexion -> prepare($sql);//, PDO::FETCH_ASSOC
    //execute la requete
    $requete->execute();

    $resultat = $requete->fetchAll();

    $r = []; //tableau vide
    foreach ($resultat as $row) {
        //Tableau Salle qui va être ajouté au tableau r[]
        $produit["id_salle"] = $row["id_salle"];
        $produit["titre"] = $row["titre"]; 
        $produit["description"] = $row["description"];
        $produit["photo"] = $row["photo"];
        $produit["id_salle"] = $row["id_salle"];
        $produit["capacite"] = $row["capacite"];
        $produit["categorie"] = $row["categorie"];
        $produit["etat"] = $row["etat"];
        $produit["prix"] = $row["prix"];
        $produit["date_arrivee"] = $row["date_arrivee"];
        $produit["date_depart"] = $row["date_depart"];
        $r[] = $produit;
    }
    //renvoyer les résultats
    return $r;
}

function capacite(){
    //connexion
    //$connexion = new PDO("mysql:host=localhost;dbname=jour2", "root", "");
    global $connexion;
    //faire une requete
    
    $sql = "select distinct capacite from salle order by capacite";
    $requete = $connexion -> prepare($sql);//, PDO::FETCH_ASSOC
    //execute la requete
    $requete->execute();

    $resultat = $requete->fetchAll();

    $r = []; //tableau vide
    foreach ($resultat as $row) {
        //Tableau Salle qui va être ajouté au tableau r[]
        $produit["capacite"] = $row["capacite"];
        $r[] = $produit;
    }
    //renvoyer les résultats
    return $r;
}

function prix(){
    //connexion
    //$connexion = new PDO("mysql:host=localhost;dbname=jour2", "root", "");
    global $connexion;
    //faire une requete
    
    $sql = "select distinct prix from produit order by prix";
    $requete = $connexion -> prepare($sql);//, PDO::FETCH_ASSOC
    //execute la requete
    $requete->execute();

    $resultat = $requete->fetchAll();

    $r = []; //tableau vide
    foreach ($resultat as $row) {
        //Tableau Salle qui va être ajouté au tableau r[]
        $produit["prix"] = $row["prix"];
        $r[] = $produit;
    }
    //renvoyer les résultats
    return $r;
}

function seeksalle($cat,$vil,$cap,$pri,$daa,$dad){
    global $connexion;
    $sql = "SELECT * "
            . "FROM salle "
            . "JOIN produit ON produit.salle_id = salle.id_salle "
            . "WHERE categorie = :cat "
            . "AND ville = :vil"
            . "AND capacite = :cap"
            . "AND prix = :pri"
            . "AND date_arrivee = :daa"
            . "AND date_depart = :dad"
            . "AND etat = 'Libre'";
    $requete = $connexion -> prepare($sql);//, PDO::FETCH_ASSOC
    $requete -> bindParam(':cat',$cat);
    $requete -> bindParam(':vil',$vil);
    $requete -> bindParam(':cap',$cap);
    $requete -> bindParam(':pri',$pri);
    $requete -> bindParam(':daa',$daa);
    $requete -> bindParam(':dad',$dad);
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
    //renvoyer les résultats
    return $r;
}


?>