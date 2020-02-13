<?PHP
require "../template/header.php";

global $connexion;
$idproduit = $_GET['p'];
$listedessalles = listedesSalles();
$sql = 'SELECT `id_produit`,`date_arrivee`,`date_depart`,`prix`,`etat`,`salle_id`, `titre`, `photo`  FROM `produit` join salle on salle_id = id_salle WHERE id_produit=' . $idproduit;
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
    $daa = $donnees['date_arrivee'];
    $dad = $donnees['date_depart'];
    $id_sal = $donnees['salle_id'];
    $pr = $donnees['prix'];
    $etat = $donnees['etat'];
}
?>  
<body>
    <form method="POST"> 
        <div class="jumbotron text-center">
            <div class="col-sm-12">
                <table class="table table-striped">
                    <thead>Modification du Produit</thead>
                    <tr>
                        <th>ID Produit</th>
                        <th>Date D'arrivée</th>
                        <th>Date Départ</th>
                        <th>Salle</th>
                        <th>Prix</th>
                        <th>Etat</th>
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
                        <input name="date_arrivee" id="date5" type="date" class="form-control" placeholder="Date d'arrivée" aria-label="datearrivee" aria-describedby="basic-addon1" value="<?PHP echo $daa;?>">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-secondary" type="button">Date ?</button>
                        </div>
                        <input name="date_depart" id="date6" type="date" class="form-control" placeholder="Date de départ" aria-label="datedepart" aria-describedby="basic-addon1" value="<?PHP echo $dad;?>">
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
                                if ($id_sal == $liste[$key]['id_salle']) {
                                    echo "<option selected='selected'>" . $liste[$key]['id_salle'] . '-' . $liste[$key]['titre'] . '-' . $liste[$key]['adresse'] . '-' . $liste[$key]['cp'] . '-' . $liste[$key]['ville'] . "</option>";
                                } else {
                                    echo "<option>" . $liste[$key]['id_salle'] . '-' . $liste[$key]['titre'] . '-' . $liste[$key]['adresse'] . '-' . $liste[$key]['cp'] . '-' . $liste[$key]['ville'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="text" name="prix" class="form-control" id="prix"  value=" <?PHP echo $pr; ?>">
                    </div> 
                    <div class="form-group">
                        <label for="etat">Etat</label>
                        <select class="form-control" id="etat" name="etat">
                            <?PHP
                            if ($etat == 'Libre') {
                                echo "<option selected='selected' value='Libre'>Libre</option>";
                                echo "<option value='Reservation'>Réservation</option>";
                            } else {
                                echo "<option value='Libre'>Libre</option>";
                                echo "<option value='Reservation' selected='selected'>Réservation</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <button type="submit" name="modif" class="btn btn-primary">Modifier</button>
                </div>
            </div>
        </div>
    </form>
    <?PHP
    if ($_POST){
        $sep = explode("-", $_POST["lisalle"], 2);
        $salle = $sep[0];
        //alert($_POST['etat']);
        $requete = $connexion->prepare("UPDATE produit SET date_arrivee = :date_arrivee, date_depart = :date_depart, prix = :prix, etat = :etat, salle_id = :salle_id WHERE id_produit = " . $idproduit);
        $requete->execute(array(
            //'id_produit' => $idproduit,
            ':date_arrivee' => htmlentities($_POST['date_arrivee']),
            ':date_depart' => htmlentities($_POST['date_depart']),
            ':prix' => htmlentities($_POST['prix']),
            ':etat' => htmlentities($_POST['etat']),
            ':salle_id' => $salle
        ));

        //echo "<p style='color:green;font-style:bold;'>Modification réussie !</p>";
        alert('Modification réussie !');
        $requete->closeCursor();
        header('Refresh: 1');
        //header("Location: gestion_salle.php");
    }
//                if (isset($_POST['modifier'])) {
//                    echo $_GET['m'];
//                   
//                }
//                if (isset($_POST['supprimer'])) {
//                    echo  $_GET['s'];
//                    
//                }
    require_once "../template/footer.php";
    require "../lib/inscription.php";
    require "../lib/seconnecter.php";
    ?>
