<?PHP
require "../template/header.php";

global $connexion;
$id = $_GET['m'];
$donnees = readSalle($id);
$content = "";
foreach ($donnees as $row) {
    $content .= "<tr><td>" . $row['id_salle'] . '</td><td>'
            . $row['titre'] . '</td><td>'
            . $row['description'] . '</td><td>'
            . "<img class='' src='../images/" . $row['photo'] . "' alt='Image Salle' height='70'></td><td>"
            . $row['pays'] . '</td><td>'
            . $row['ville'] . '</td><td>'
            . $row['adresse'] . '</td><td>'
            . $row['cp'] . '</td><td>'
            . $row['capacite'] . '</td><td>'
            . $row['categorie'] . '</td><td></tr>';
}
?>  
<body>
    <form action="" method="POST">   
        <div class="jumbotron text-center">
            <div class="col-sm-12">
                <table class="table table-striped">
                    <thead>Modification de la Salle</thead>
                    <tr>
                        <th>ID Salle</th>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Photo</th>
                        <th>Pays</th>
                        <th>Ville</th>
                        <th>Adresse</th>
                        <th>Code Postal</th>
                        <th>Capacité</th>
                        <th>Catégorie</th>
                    </tr>   
                    <?= $content ?>
                </table>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-6" id="grga">
                    <!--                <h3>Column 1</h3>-->
                    <div class="form-group">
                        <label for="titre">Titre:</label>
                        <input type="text" class="form-control mr-sm-1" id="titre" name="titre" value="<?PHP echo($donnees[0]['titre']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="descrip">Description:</label>
                        <textarea class="form-control mr-sm-1" rows="5" id="descrip" name="description" ><?PHP echo($donnees[0]['description']); ?></textarea>
                    </div> 
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="text" class="form-control" id="photo" name="photo" value="<?PHP echo($donnees[0]['photo']); ?>">
                    </div> 
                    <div class="form-group">
                        <label for="capa">Capacité:</label>
                        <select class="form-control" id="capa" name="capacite">
                         <?PHP
                            for ($i = 1; $i <= 50; $i++) {
                                if ($donnees[0]['capacite'] == $i) {
                                    echo "'<option selected='selected'>".$i."</option>";
                                } else {
                                    echo '<option>'.$i.'</option>';
                            }}
                                ?>
                        </select>
                        </div>
                        <div class="form-group">
                            <label for="categ">Catégorie:</label>
                            <select class="form-control" id="categ" name="categorie">
                            <?PHP
                            if ($donnees[0]['categorie']=="Réunion"){
                                echo "<option selected='selected'>Réunion</option>";
                            }else{
                                echo "<option>Réunion</option>";
                            }
                            if ($donnees[0]['categorie']=="Bureau"){
                                echo "<option selected='selected'>Bureau</option>";
                            }else{
                                echo "<option>Bureau</option>";
                            }
                            if ($donnees[0]['categorie']=="Formation"){
                                echo "<option selected='selected'>Formation</option>";
                            }else{
                                echo "<option>Formation</option>";
                            }
                                
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6" id="grdr">
                        <!--<h3>Column 2</h3>-->
                        <div class="form-group">
                            <label for="pays">Pays:</label>
                            <select class="form-control" id="pays" name="pays" value="<?PHP echo($donnees[0]['pays']); ?>">
                                <option selected='selected'>France</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ville">Ville:</label>
                            <select class="form-control" id="ville" name="ville">
                                <?PHP
                                if ($donnees[0]['ville'] == "Paris") {
                                    echo "<option selected='selected'>Paris</option>";
                                } else {
                                    echo "<option>Paris</option>";
                                }
                                if ($donnees[0]['ville'] == "Lyon") {
                                    echo "<option selected='selected'>Lyon</option>";
                                } else {
                                    echo "<option>Lyon</option>";
                                }
                                if ($donnees[0]['ville'] == "Marseille") {
                                    echo "<option selected='selected'>Marseille</option>";
                                } else {
                                    echo "<option>Marseille</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="adresse">Adresse:</label>
                            <textarea class="form-control" rows="5" id="adresse" name="adresse"><?PHP echo($donnees[0]['adresse']); ?></textarea>
                        </div> 
                        <div class="form-group">
                            <label for="cp">Code Postal:</label>
                            <input type="text" class="form-control" name="cp" id="cp" value="<?PHP echo($donnees[0]['cp']); ?>">
                        </div>
                        <button type="submit" name="modifier" class="btn btn-primary">Modifier</button>
                    </div>
                    </form>
                    <?PHP
                    //UPDATE `salle` SET `description` = 'La salle parfaite pour vos formations en groupe' WHERE `salle`.`id_salle` = 43; 
                    if ($_POST) {
                        $requete = $connexion->prepare("UPDATE `salle` SET "
                                . "`titre` = :titre, "
                                . "`description` = :description, "
                                . "`photo` = :photo, "
                                . "`capacite` = :capacite, "
                                . "`categorie` = :categorie, "
                                . "`pays` = :pays, "
                                . "`ville` = :ville, "
                                . "`adresse` = :adresse, "
                                . "`cp` = :cp "
                                . "WHERE `id_salle` =" .$id);
                        //echo $_POST['titre'].$_POST['description'].$_POST['photo'].$_POST['capacite'].$_POST['categorie'].$_POST['pays'].$_POST['ville'].$_POST['adresse'].$_POST['cp'];
                        $requete -> execute(array(
                            'titre' => htmlentities($_POST['titre']),
                            'description' => htmlentities($_POST['description']),
                            'photo' => htmlentities($_POST['photo']),
                            'capacite' => htmlentities($_POST['capacite']),
                            'categorie' => htmlentities($_POST['categorie']),
                            'pays' => htmlentities($_POST['pays']),
                            'ville' => htmlentities($_POST['ville']),
                            'adresse' => htmlentities($_POST['adresse']),
                            'cp' => htmlentities($_POST['cp'])
                                ));
                       
                        //echo "<p style='color:green;font-style:bold;'>Modification réussi !</p>";
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
