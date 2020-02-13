<?php

function readSalle($i) {
    //connexion
    //$connexion = new PDO("mysql:host=localhost;dbname=jour2", "root", "");
    global $connexion;
    //faire une requete
    
    $sql = "select id_salle, titre, capacite, photo, ville, pays, adresse, cp, categorie, description, id_produit, etat, prix, date_arrivee, date_depart FROM salle JOIN produit ON salle.id_salle = produit.salle_id where id_salle = :i order by id_salle";
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
        $client["id_produit"] = $row["id_produit"];
        $client["date_arrivee"] = $row["date_arrivee"];
        $client["date_depart"] = $row["date_depart"];
        $client["prix"] = $row["prix"];
        $r[] = $client;
    }
    //renvoyer les résultats
    return $r;
}

function listedesSalles() {
    //connexion
    //$connexion = new PDO("mysql:host=localhost;dbname=jour2", "root", "");
    global $connexion;
    //faire une requete
    
    $sql = "SELECT * FROM salle";
    $requete = $connexion -> prepare($sql);//, PDO::FETCH_ASSOC
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
function listeProduit(){
$sql = 'SELECT `id_produit`,`date_arrivee`,`date_depart`,`prix`,`etat`,`salle_id`, `titre`, `photo`  FROM `produit` join salle on salle_id = id_salle order by id_produit desc limit 3';
$requete = $connexion->prepare($sql);
$requete->execute();
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

function produitSalle(){
    //connexion
    //$connexion = new PDO("mysql:host=localhost;dbname=jour2", "root", "");
    global $connexion;
    //faire une requete
    
//    $sql = "select id_salle, titre, capacite, photo, ville, categorie, description, id_produit, etat, prix, date_arrivee, date_depart\n"
//    . "FROM salle\n"
//    . "JOIN produit\n"
//    . "ON salle.id_salle = produit.salle_id"
//    . "WHERE etat=`Libre` "
//    . "order by id_salle" ;
    $sql = "select id_salle, titre, capacite, photo, ville, categorie, description, id_produit, etat, prix, date_arrivee, date_depart FROM salle JOIN produit ON salle.id_salle = produit.salle_id WHERE etat='Libre' order by id_salle";
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
        $produit["ville"] = $row["ville"];
        $produit["capacite"] = $row["capacite"];
        $produit["categorie"] = $row["categorie"];
        $produit["etat"] = $row["etat"];
        $produit["prix"] = $row["prix"];
        $produit["date_arrivee"] = $row["date_arrivee"];
        $produit["date_depart"] = $row["date_depart"];
        $produit["id_protuit"] = $row["id_produit"];
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

function listemembreavis(){
    global $connexion;
    //faire une requete
    
    $sql = "select id_membre, nom, prenom, email from membre order by nom";
    $requete = $connexion -> prepare($sql);//, PDO::FETCH_ASSOC
    //execute la requete
    $requete->execute();

    $resultat = $requete->fetchAll();

    $r = []; //tableau vide
    foreach ($resultat as $row) {
        //Tableau Membre qui va être ajouté au tableau r[]
        $produit["id_membre"] = $row["id_membre"];
        $produit["nom"] = $row["nom"];
        $produit["prenom"] = $row["prenom"];
        $produit["email"] = $row["email"];
        $r[] = $produit;
    }
    //renvoyer les résultats
    return $r;
}

function listsalleavis(){
    global $connexion;
    //faire une requete
    
    $sql = "select id_salle, titre from salle order by titre";
    $requete = $connexion -> prepare($sql);//, PDO::FETCH_ASSOC
    //execute la requete
    $requete->execute();

    $resultat = $requete->fetchAll();

    $r = []; //tableau vide
    foreach ($resultat as $row) {
        //Tableau Membre qui va être ajouté au tableau r[]
        $produit["id_salle"] = $row["id_salle"];
        $produit["titre"] = $row["titre"];
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

function internauteEstConnecte()
{
        if(!isset($_SESSION['membre']))
            {return false;}
        else 
            {return true;}
}

function internauteEstConnecteEtEstAdmin()
{
if(internauteEstConnecte() && $_SESSION['membre']['statut'] == 1) 
            {return true;}
        else 
            {return false;}
}

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

?>