<?PHP
require "../template/header.php";
require "../lib/loader.php";
global $connexion;

$sql = 'SELECT * FROM `salle` WHERE 1 order by id_salle desc limit 3';
$requete = $connexion->prepare($sql);
$requete->execute();
$content = "";
while ($donnees = $requete->fetch()) {
    $content .= "<tr><td>" . $donnees['id_salle'] . '</td><td>'
            . $donnees['titre'] . '</td><td>'
            . $donnees['description'] . '</td><td>'
            . "<img class='' src='../images/" . $donnees['photo'] . "' alt='Image Salle' height='70'></td><td>"
            . $donnees['pays'] . '</td><td>'
            . $donnees['ville'] . '</td><td>'
            . $donnees['adresse'] . '</td><td>'
            . $donnees['cp'] . '</td><td>'
            . $donnees['capacite'] . '</td><td>'
            . $donnees['categorie'] . '</td><td>';
    $content .= "<input type='submit' name='modifier' id='modifier' value='Modifier' formaction='gestion_salle_modif.php?m=" . $donnees['id_salle'] . "'>"
            . '</td><td>'
            . "<input type='submit' name='supprimer' id='supprimer' value='Supprimer' formaction='gestion_salles.php?s=" . $donnees['id_salle'] . "'> " . "</td></tr>";
}
//card-img-top
?>  
<body>
    <form action="" method="POST">   
        <div class="jumbotron text-center">
            <div class="col-sm-12">
                <table class="table table-striped">
                    <thead>Liste des 3 dernières Salles</thead>
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
                    <h3>Ajouter une Salle</h3>
                    <div class="form-group">
                        <label for="titre">Titre:</label>
                        <input type="text" name="titre" class="form-control mr-sm-1" id="titre">
                    </div>
                    <div class="form-group">
                        <label for="descrip">Description:</label>
                        <textarea name="description" class="form-control mr-sm-1" rows="5" id="descrip"></textarea>
                    </div> 
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="text" name="photo" class="form-control" id="photo">
                    </div> 
                    <div class="form-group">
                        <label for="capa">Capacité:</label>
                        <select class="form-control" id="capa" name="capacite">
                            <?PHP
                            for ($i = 1; $i <= 50; $i++) {
                                echo '<option>' . $i . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="categ">Catégorie:</label>
                        <select class="form-control" id="categ" name="categorie">
                            <option>Réunion</option>
                            <option>Bureau</option>
                            <option>Formation</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6" id="grdr">
                    <!--<h3>Column 2</h3>-->
                    <div class="form-group">
                        <label for="pays">Pays:</label>
                        <select class="form-control" id="pays" name="pays">
                            <option>France</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ville">Ville:</label>
                        <select class="form-control" id="ville" name="ville">
                            <option>Paris</option>
                            <option>Lyon</option>
                            <option>Marseille</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse:</label>
                        <textarea class="form-control" rows="5" id="adresse" name="adresse"></textarea>
                    </div> 
                    <div class="form-group">
                        <label for="cp">Code Postal:</label>
                        <input type="text" class="form-control" id="cp" name="cp">
                    </div>
                    <button type="submit" name="enregistrer" class="btn btn-primary">Enregistrer</button>
                </div>
                </form>
                <?PHP
                require_once "../template/footer.php";
                require "../lib/inscription.php";
                require "../lib/seconnecter.php";

                if (isset($_POST['modifier'])) {
                    header("Location: gestion_salle_modif.php?m=" . $donnees['id_salle']);
                }
                if (isset($_POST['supprimer'])) {
                   // echo $_GET['s'];
                }
                if (isset($_POST['enregistrer'])) {
//        if ((isset($_POST['titre']) && isset($_POST['description']) && isset($_POST['photo']) && isset($_POST['pays']) && isset($_POST['ville']) && isset($_POST['adresse']) && isset($_POST['cp']) && isset($_POST['capacite']) && isset($_POST['categorie']))
                    
                        $titre = $_POST["titre"];
                        $description = $_POST["description"];
                        $photo = $_POST["photo"];
                        $pays = $_POST["pays"];
                        $ville = $_POST["ville"];
                        $adresse = $_POST["adresse"];
                        $cp = $_POST["cp"];
                        $capacite = $_POST["capacite"];
                        $categorie = $_POST["categorie"];
//INSERT INTO `salle` (`id_salle`, `titre`, `description`, `photo`, `pays`, `ville`, `adresse`, `cp`, `capacite`, `categorie`) VALUES (NULL, 'Orange', 'Salle des DIW 2019', 'aucune', 'France', 'Paris', '14 rue gustave Eiffel', '78180', '25', 'Formation'); 
                        echo $titre.$description.$photo.$
                        $requete = $connexion->exec("INSERT INTO salle (id_salle, titre, description, photo, pays, ville, adresse, cp, capacite, categorie) VALUES ('NULL', $titre', '$description', '$photo', '$pays', '$ville', '$adresse', '$cp', '$capacite', '$categorie')");

                        echo "nombre d'enregistrement affecté par l'insert : " . $requete . "<br>";

                        //echo "dernier id créé : " . $requete->lastInsertId();
                        //header("Location: gestion_salle.php");
//            if(empty($titre) OR empty($desc) OR empty($photo) OR empty($pays))
//            {
//                echo '<font color="red">Attention, aucun champs ne peut rester vide !</font>';
//            }
                    }
                    ?>
