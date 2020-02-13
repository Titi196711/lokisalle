<?PHP
require "../template/header.php";
//require "../lib/loader.php";
global $connexion;
$idavis = $_GET['a'];
$sql = 'SELECT * FROM `avis` 
join membre on membre_id = id_membre
join salle on salle_id = id_salle
where id_avis ='.$idavis;
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
$idmembre = $donnees['id_membre'];
$idsalle = $donnees['id_salle'];
$comment = $donnees['commentaire'];
$dateenreg = $donnees['date_enregistrement'];
}

?>  
<body>
    <form action="" method="POST">   
        <div class="jumbotron text-center">
            <div class="col-sm-12">
                <table class="table table-striped">
                    <thead>Liste des 3 derniers Commentaires</thead>
                    <tr>
                        <th>ID Avis</th>
                        <th>ID Membre</th>
                        <th>ID Salle</th>
                        <!--<th>Photo</th>-->
                        <th>Commentaire</th>
                        <th>Note</th>
                        <th>Date d'enregistrement</th>
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
                            echo "<input type='text' name='idmembre' class='form-control' id='membreavis' name='idmembre' value=>'. $idmembre . '";
                        } else {
                            echo'<select class="custom-select" id="inputGroupSelect01" name="idmembre">';
                            for ($i = 0; $i < count($membreavis); $i++) {
                                $userid = $membreavis[$i]['id_membre'];
                                $useremail = $membreavis[$i]['email'];
                                if ($userid == $idmembre){
                                echo '<option selected="selected" value=' . $userid . '>' . $userid.' - '.$useremail.' </option>';    
                                }else{
                                echo '<option value=' . $userid . '>' . $userid.' - '.$useremail.' </option>';
                                }
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
                            if ($userid == $idsalle){
                            echo '<option selected="selected" value=' . $userid . '>' . $userid . ' - ' . $useremail . ' </option>';    
                            }else{
                            echo '<option value=' . $userid . '>' . $userid . ' - ' . $useremail . ' </option>';
                            }
                        }
                        echo'</select>';
                        ?>
                    </div> 
                    <div class="form-group">
                        <label for="comment">Commentaires</label>
                        <textarea class="form-control" rows="5" id="comment" name="comment"><?PHP echo $comment?></textarea>
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
                        <input type="date" class="form-control" id="date_enregistrement" name="date_enregistrement" value="<?PHP echo $dateenreg;?>">
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

    if (isset($_POST['enregis'])) {
//        if ((isset($_POST['titre']) && isset($_POST['description']) && isset($_POST['photo']) && isset($_POST['pays']) && isset($_POST['ville']) && isset($_POST['adresse']) && isset($_POST['cp']) && isset($_POST['capacite']) && isset($_POST['categorie']))

       // $idavis = $_POST["idavis"];
        $idmembre = $_POST["idmembre"];
        $idsalle = $_POST["idsalle"];
        $commentaire = $_POST["comment"];
        $note = $_POST["note"];
        $date_enregistrement = $_POST["date_enregistrement"];
      //  echo $idmembre . ' - ' . $idsalle . ' - ' . $commentaire . ' - ' . $date_enregistrement;
        global $connexion;

        $requete = $connexion->prepare("UPDATE avis SET membre_id = :membre_id, salle_id = :salle_id, commentaire = :commentaire, date_enregistrement = :date_enregistrement WHERE id_avis = " . $idavis);
        $requete->execute(array(
            //'id_produit' => $idproduit,
            ':membre_id' => htmlentities($_POST['idmembre']),
            ':salle_id' => htmlentities($_POST['idsalle']),
            ':commentaire' => htmlentities($_POST['comment']),
            ':date_enregistrement' => htmlentities($_POST['date_enregistrement'])
        ));
        //echo "nombre d'enregistrement affecté par l'insert : " . $query . "<br>";
        alert('Modification réussie !');
        $requete->closeCursor();
        //header('Refresh: 1; ');
        //echo "dernier id créé : " . $requete->lastInsertId();
        //header("Location: gestion_salle.php");
//            if(empty($titre) OR empty($desc) OR empty($photo) OR empty($pays))
//            {
//                echo '<font color="red">Attention, aucun champs ne peut rester vide !</font>';
//            }
    }
    ?>
