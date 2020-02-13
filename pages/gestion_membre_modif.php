<?PHP
require "../template/header.php";
//require "../lib/loader.php";
global $connexion;
$idmembre = $_GET['u'];
$sql = 'SELECT * FROM `membre` WHERE id_membre=' . $idmembre;
$requete = $connexion->prepare($sql);
$requete->execute();
$content = "";

while ($datas = $requete->fetch()) {
    $content .= "<tr><td>" . $datas['id_membre'] . '</td><td>'
            . $datas['pseudo'] . '</td><td>'
            . $datas['mdp'] . '</td><td>'
            . $datas['nom'] . '</td><td>'
            . $datas['prenom'] . '</td><td>'
            . $datas['email'] . '</td><td>'
            . $datas['civilite'] . '</td><td>'
            . $datas['statut'] . '</td><td>'
            . $datas['date_enregistrement'] . '</td><td>';
}
$requete->execute();
$donnees = $requete->fetchAll();
?>  
<body>
    <form action="" method="POST">   
        <div class="jumbotron text-center">
            <div class="col-sm-12">
                <table class="table table-striped">
                    <thead>Personne inscrite</thead>
                    <tr>
                        <th>ID Membre</th>
                        <th>Pseudo</th>
                        <th>Mot de Passe</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Civilité</th>
                        <th>Statut</th>
                        <th>Date d'enregistrement</th>
                    </tr>   
                    <?= $content ?>
                </table>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-6" id="grga">
                    <h3>Modifier le compte d'une Personne</h3>
                    <div class="modal-body">
                        <!--le pseudo-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"></span>
                            </div>
                            <input id="pseudo" name="pseudo" type="text" class="form-control" placeholder="Votre Pseudo" aria-label="pseudo" aria-describedby="basic-addon1" value="<?PHP echo $donnees[0]['pseudo'] ?>">
                        </div>
                        <!--le mot de passe--> 
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"></span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="Votre mot de passe" aria-label="Password" aria-describedby="basic-addon2"value="<?PHP echo $donnees[0]['mdp'] ?>">
                        </div>        
                        <!--le username-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"></span>
                            </div>
                            <input type="text" name="username" class="form-control" placeholder="Votre Nom" aria-label="Username" aria-describedby="basic-addon1" value="<?PHP echo $donnees[0]['nom'] ?>">
                        </div>
                        <!--le prename-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"></span>
                            </div>
                            <input type="text" name="secondname" class="form-control" placeholder="Votre Prénom" aria-label="secondname" aria-describedby="basic-addon1"value="<?PHP echo $donnees[0]['prenom'] ?>">
                        </div>
                        <!--l'email-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"></span>
                            </div>
                            <input type="email" name="email" class="form-control" placeholder="Votre Email" aria-label="email" aria-describedby="basic-addon1" value="<?PHP echo $donnees[0]['email'] ?>">
                        </div>
                        <!--Sexe-->
                        <div class="form-check form-check-inline">
                            <?PHP
                            if ($donnees[0]['civilite'] == "Madame") {
                                echo "<input checked class='form-check-input' type='radio' name='civilite' id='inlineRadio1' value='Madame'>";
                            } else {
                                echo "<input class='form-check-input' type='radio' name='civilite' id='inlineRadio1' value='Madame'>";
                            }
                            ?>
                            <label class='form-check-label' for='inlineRadio1'>Femme</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <?PHP
                            if ($donnees[0]['civilite'] == "Monsieur") {
                                echo "<input checked class='form-check-input' type='radio' name='civilite' id='inlineRadio2' value='Monsieur'>";
                            } else {
                                echo "<input class='form-check-input' type='radio' name='civilite' id='inlineRadio2' value='Monsieur'>";
                            }
                            ?>
                            <label class='form-check-label' for='inlineRadio2'>Homme</label>
                        </div>
                        <!--Statut-->
                        <div class="form-group">
                            <label for="statut">Statut</label>
                            <select class="form-control" id="statut" name="statut">
                                <?PHP
                                if ($donnees[0]['statut'] == 0) {
                                    echo "<option selected='selected' value='0'>Utilisateur</option>";
                                    echo "<option value='1'>Administrateur</option>";
                                } else {
                                    echo "<option value='0'>Utilisateur</option>";
                                    echo "<option selected='selected' value='1'>Administrateur</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cp">Date d'enregistrement</label>
                        <input type="text" class="form-control" id="cp" name="denregistr" value="<?PHP echo date("Y-m-d H:m:s"); ?>">
                    </div>
                    <button type="submit" name="mo" class="btn btn-primary">Modifier</button>
                </div>
            </div>
        </div>
    </form>
    <?PHP
    //UPDATE `salle` SET `description` = 'La salle parfaite pour vos formations en groupe' WHERE `salle`.`id_salle` = 43; 
if ($_POST){
    if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['username']) && isset($_POST['secondname']) && isset($_POST['email']) && isset($_POST['civilite']) && isset($_POST['statut'])) {
        echo $_POST['pseudo'] && $_POST['password'] && $_POST['username'] && $_POST['secondname'] && $_POST['email'] && $_POST['civilite'] && $_POST['statut'];
        //$requete->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //$sql = "UPDATE `membre` SET `pseudo` = \'toto le robot\', `statut` = \'1\' WHERE `membre`.`id_membre` = 22";
        $requete = $connexion->prepare("UPDATE membre SET "
                ." pseudo = :pseudo, "
                ." mdp = :mdp, "
                ." nom = :nom, "
                ." prenom = :prenom, "
                ." email = :email, "
                ." civilite = :civilite, " 
                ." statut = :statut "
                ." WHERE id_membre =" . $idmembre);
        $requete->execute(array(
            ':pseudo' => htmlentities($_POST['pseudo']),
            ':mdp' => htmlentities($_POST['password']),
            ':nom' => htmlentities($_POST['username']),
            ':prenom' => htmlentities($_POST['secondname']),
            ':email' => htmlentities($_POST['email']),
            ':civilite' => htmlentities($_POST['civilite']),
            ':statut' => htmlentities($_POST['statut'])
        ));

//    $requete = $connexion -> prepare("UPDATE membre SET pseudo = ?, mdp = ?, nom = ?, prenom = ?, email = ?, civilite = ?, statut = ?, WHERE membre.id_membre = " . $idmembre);
//    $requete->execute(array($_POST['pseudo'], $_POST['password'], $_POST['username'], $_POST['secondname'], $_POST['email'], $_POST['civilite'], $_POST['statut'] ));

        alert("Modification réussie !");
        header('Refresh: 1');
        //header("Location: gestion_salle.php");
    //}
//                if (isset($_POST['modifier'])) {
//                    echo $_GET['m'];
//                   
//                }
//                if (isset($_POST['supprimer'])) {
//                    echo  $_GET['s'];
//                    
    }  }
    require_once "../template/footer.php";
    require "../lib/inscription.php";
    require "../lib/seconnecter.php";
    ?>
