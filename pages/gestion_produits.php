<?PHP
//session_start();
//$session = $_SESSION['membre']['pseudo'];
//echo $session;
require "../template/header.php";
global $connexion;
$listedessalles = listedesSalles();
$sql = 'SELECT `id_produit`,`date_arrivee`,`date_depart`,`prix`,`etat`,`salle_id`, `titre`, `photo`  FROM `produit` join salle on salle_id = id_salle order by id_produit desc limit 3';
$requete = $connexion->prepare($sql);
$requete->execute();
$content = "";
while ($donnees = $requete->fetch()) {
    $content .= "<tr><td>" . $donnees['id_produit'] . '</td><td>'
            . date_format(date_create($donnees['date_arrivee']), 'd-m-Y H:i:s') . '</td><td>'
            . date_format(date_create($donnees['date_depart']), 'd-m-Y H:i:s') . '</td><td>'
            . $donnees['salle_id'] . "-"
            . $donnees['titre'] . "<br>"
            . "<img class='' src='../images/" . $donnees['photo'] . "' alt='Image Salle' height='70'></td><td>"
            . $donnees['prix'] . ' €</td><td>'
            . $donnees['etat'] . '</td><td>';
    $content .= "<input type='submit' name='modif' id='modif' value='Modifier' formaction='gestion_produit_modif.php?p=" . $donnees['id_produit'] . "'>"
            . '</td><td>'
            . "<input type='submit' name='suppr' id='suppr' value='Supprimer' formaction='gestion_produits.php?p=" . $donnees['id_produit'] . "'> " . "</td></tr>";
}
//card-img-top
?>  


<body>
    <form action="" method="POST"> 
        <div class="jumbotron text-center">
            <div class="col-sm-12">
                <table class="table table-striped">
                    <thead>Liste des 3 derniers Produits</thead>
                    <tr>
                        <th>ID Produit</th>
                        <th>Date Arrivée</th>
                        <th>Date Départ</th>
                        <th>ID Salle</th>
                        <th>Prix</th>
                        <th>Etat</th>
                        <th>Action1</th>
                        <th>Action2</th>
                    </tr>   
                    <?= $content ?>
                </table>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-6" id="grga">
                    <div class="form-group">

                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="button">Date ?</button>
                        </div>
                        <input name="date_arrivee" id="date3" type="date" class="form-control" placeholder="Date d'arrivée" aria-label="datearrivee" aria-describedby="basic-addon1">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="button">Date ?</button>
                        </div>
                        <input name="date_depart" id="date4" type="date" class="form-control" placeholder="Date de départ" aria-label="datedepart" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6" id="grdr">
                    <div class="form-group">
                        <label for="lisalle">ID Salle</label>  
                        <select class="custom-select" id="lisalle" name="lisalle">
                            <?PHP
                            $liste = listedesSalles();
                            foreach ($liste as $key => $row) {
                                echo "<option>" . $liste[$key]['id_salle'] . '-' . $liste[$key]['titre'] . '-' . $liste[$key]['adresse'] . '-' . $liste[$key]['cp'] . '-' . $liste[$key]['ville'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="text" name="prix" class="form-control" id="prix">
                    </div> 
                    <button type="submit" name="enreg" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </div>
    </form>
    <?PHP
    if (isset($_POST['modif'])) {
        header("Location: gestion_produit_modif.php?p=" . $donnees['id_produit']);
    }
    if (isset($_POST['suppr'])) {
        $idproduit = $_GET['p'];
        $querysupp = $connexion->exec("DELETE FROM produit WHERE id_produit =' $idproduit  '");
        //Echo "Le produit ayant pour id  = " . $idproduit . " a bien été supprimé";
        alert("Le produit ayant pour id  = " . $idproduit . " a bien été supprimé");
    }
    if (isset($_POST['enreg'])) {
//        if ((isset($_POST['titre']) && isset($_POST['description']) && isset($_POST['photo']) && isset($_POST['pays']) && isset($_POST['ville']) && isset($_POST['adresse']) && isset($_POST['cp']) && isset($_POST['capacite']) && isset($_POST['categorie']))
        //$daa = date_format(date_create($_POST["date_arrivee"]), 'Y-m-d H:i:s');
        //$dad = date_format(date_create($_POST["date_depart"]), 'Y-m-d H:i:s');
        $daa = $_POST['date_arrivee'];
        $dad = $_POST['date_depart'];
        $sep = explode("-",$_POST["lisalle"],2);
        $salle = $sep[0];
        $prix = $_POST["prix"];

//INSERT INTO `salle` (`id_salle`, `titre`, `description`, `photo`, `pays`, `ville`, `adresse`, `cp`, `capacite`, `categorie`) VALUES (NULL, 'Orange', 'Salle des DIW 2019', 'aucune', 'France', 'Paris', '14 rue gustave Eiffel', '78180', '25', 'Formation'); 
        //echo $titre.$description.$photo.$pays.$ville.$adresse.$cp.$capacite.$categorie;
        global $connexion;

        $query = $connexion->exec("INSERT INTO `produit` (`date_arrivee`, `date_depart`, `salle_id`, `prix`) "
                . "VALUES ('$daa', '$dad', '$salle', '$prix')");

        //echo "nombre d'enregistrement affecté par l'insert : " . $query . "<br>";
        alert("nombre d'enregistrement affecté par l'insert : " . $query);
        header('Refresh: 1');
        //echo "dernier id créé : " . $requete->lastInsertId();
        //header("Location: gestion_salle.php");
//            if(empty($titre) OR empty($desc) OR empty($photo) OR empty($pays))
//            {
//                echo '<font color="red">Attention, aucun champs ne peut rester vide !</font>';
//            }
    }
    ?>
    <script type="text/javascript">
   $(function () {
  $("#datepicker").datepicker({ 
        autoclose: true, 
        todayHighlight: true
  }).datepicker('update', new Date());
});

    </script>
    <?PHP
//    $url = $_SERVER['PHP_SELF'] ;
//    echo($url) ; 
    require_once("../template/footer.php");
    require "../lib/inscription.php";
    require "../lib/seconnecter.php";
    ?>