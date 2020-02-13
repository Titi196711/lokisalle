<?PHP
require "../template/header.php";
//require "../lib/loader.php";
global $connexion;

$sql = 'SELECT * FROM `avis` 
join membre on membre_id = id_membre
join salle on salle_id = id_salle
';
$requete = $connexion->prepare($sql);
$requete->execute();
$content = "";
while ($donnees = $requete->fetch()) {
    $etoiles = '';
    for ($i=1;$i<=$donnees['note'];$i++){
        $etoiles .= '<i class="fas fa-star"></i>';
    }
    $content .= "<tr><td>" . $donnees['id_avis'] . '</td><td>'
            . $donnees['id_membre'] . ' - ' . $donnees['email'] . '</td><td>'
            . $donnees['id_salle']  . ' - ' .  $donnees['titre'] . '</td><td>'
//            . "<img class='' src='../images/" . $donnees['photo'] . "' alt='Image Salle' height='70'></td><td>"
            . $donnees['commentaire'] . '</td><td>'
            . $etoiles . '</td><td>'//$donnees['note'] . '</td><td>'
            . $donnees['date_enregistrement'] . '</td><td>';
    $content .= "<input type='submit' name='modifier' id='modifier' value='Modifier' formaction='gestion_avis_modif.php?a=" . $donnees['id_avis'] . "'>"
            . '</td><td>'
            . "<input type='submit' name='supprimer' id='supprimer' value='Supprimer' formaction='gestion_avis.php?a=" . $donnees['id_avis'] . "'> " . "</td></tr>";
}

?>  
<body>
    <form action="" method="POST">   
        <div class="jumbotron text-center">
            <div class="col-sm-12">
                <table class="table table-striped">
                    <thead>Le Commentaire</thead>
                    <tr>
                        <th>ID Avis</th>
                        <th>ID Membre</th>
                        <th>ID Salle</th>
                        <!--<th>Photo</th>-->
                        <th>Commentaire</th>
                        <th>Note</th>
                        <th>Date d'enregistrement</th>
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
                    <h3>Ajouter une Avis</h3>
                   <div class="form-group">
                        <label for="idmembre">ID Membre</label>
                        <?PHP
                        $admin = $_SESSION['membre']['statut'];
                        $membreavis = listemembreavis();
                        $user = $_SESSION['membre']['id_membre'] . ' - ' . $_SESSION['membre']['email'];
                        if ($admin == 0) {
                            echo "<input type='text' name='idmembre' class='form-control' id='membreavis' name='idmembre' value=>'. $user . '";
                        } else {
                            echo'<select class="custom-select" id="inputGroupSelect01" name="idmembre">';
                            for ($i = 0; $i < count($membreavis); $i++) {
                                $userid = $membreavis[$i]['id_membre'];
                                $useremail = $membreavis[$i]['email'];
                                echo '<option value=' . $userid . '>' . $userid.' - '.$useremail.' </option>';
                            }
                            echo'</select>';
                        }
                        ?>
                    </div> 
                    <div class="form-group">
                        <label for="idsalle">ID Salle</label>
                        <?PHP
                        $salleavis = listsalleavis();
                        echo'<select class="custom-select" id="inputGroupSelect01" name="idsalle">';
                        for ($i = 0; $i < count($salleavis); $i++) {
                            $userid = $salleavis[$i]['id_salle'];
                            $useremail = $salleavis[$i]['titre'];
                            echo '<option value=' . $userid . '>' . $userid . ' - ' . $useremail . ' </option>';
                        }
                        echo'</select>';
                        ?>
                    </div> 
                    <div class="form-group">
                        <label for="comment">Commentaires</label>
                        <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
                    </div>                     
                    <div class="form-group">
                        <label for="Note">Note</label>
                        <select class="form-control" id="note" name="note">
                            <option value="5">5 étoiles</option>
                            <option value="4">4 étoiles</option>
                            <option value="3">3 étoiles</option>
                            <option value="2">2 étoiles</option>
                            <option value="1">1 étoile</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date_enregistrement">Date Enregistrement</label>
                        <input type="date" class="form-control" id="date_enregistrement" name="date_enregistrement" value="<?PHP date("d-m-Y"); ?>">
                    </div>
                    <button type="submit" name="enregis" class="btn btn-primary">Enregistrer</button>
                </div>
            </div>
        </div>
    </form>
    <?PHP
    require_once "../template/footer.php";
    require "../lib/inscription.php";
    require "../lib/seconnecter.php";

    if (isset($_POST['modifier'])) {
        header("Location: gestion_avis.php?a=" . $donnees['id_avis']);
    }
    if (isset($_POST['supprimer'])) {
        $idavis = $_GET['a'];
        $querysupp = $connexion->exec("DELETE FROM avis WHERE id_avis =' $idavis  '");
        //Echo "La salle ayant pour id  = " . $idsalle . " a bien été supprimée";
        alert("L'avis ayant pour id  = " . $idavis . " a bien été supprimée");
        $querysupp->closeCursor();
    }
    if (isset($_POST['enregis'])) {
//        if ((isset($_POST['titre']) && isset($_POST['description']) && isset($_POST['photo']) && isset($_POST['pays']) && isset($_POST['ville']) && isset($_POST['adresse']) && isset($_POST['cp']) && isset($_POST['capacite']) && isset($_POST['categorie']))

       // $idavis = $_POST["idavis"];
        $idmembre = $_POST["idmembre"];
        $idsalle = $_POST["idsalle"];
        $commentaire = $_POST["comment"];
        $note = $_POST["note"];
        $date_enregistrement = $_POST["date_enregistrement"];
      //  echo $idmembre . ' - ' . $idsalle . ' - ' . $commentaire . ' - ' . $date_enregistrement;
//INSERT INTO `salle` (`id_salle`, `titre`, `description`, `photo`, `pays`, `ville`, `adresse`, `cp`, `capacite`, `categorie`) VALUES (NULL, 'Orange', 'Salle des DIW 2019', 'aucune', 'France', 'Paris', '14 rue gustave Eiffel', '78180', '25', 'Formation'); 
        //echo $titre.$description.$photo.$pays.$ville.$adresse.$cp.$capacite.$categorie;
        global $connexion;

        $query = $connexion->exec("INSERT INTO `avis` (`membre_id`, `salle_id`, `commentaire`, `note` ,`date_enregistrement`) "
                . "VALUES ('$idmembre', '$idsalle', '$commentaire', '$note', '$date_enregistrement')");

        //echo "nombre d'enregistrement affecté par l'insert : " . $query . "<br>";
        alert("nombre d'enregistrement affecté par l'insert : " . $query);
        $query->closeCursor();
        header('Refresh: 1; ');
        //echo "dernier id créé : " . $requete->lastInsertId();
        //header("Location: gestion_salle.php");
//            if(empty($titre) OR empty($desc) OR empty($photo) OR empty($pays))
//            {
//                echo '<font color="red">Attention, aucun champs ne peut rester vide !</font>';
//            }
    }
    ?>
