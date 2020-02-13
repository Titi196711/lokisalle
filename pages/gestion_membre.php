<?PHP
require "../template/header.php";
//require "../lib/loader.php";
global $connexion;

$sql = 'SELECT * FROM `membre` WHERE 1 order by id_membre desc limit 5';
$requete = $connexion->prepare($sql);
$requete->execute();
$content = "";
while ($donnees = $requete->fetch()) {
    $content .= "<tr><td>" . $donnees['id_membre'] . '</td><td>'
            . $donnees['pseudo'] . '</td><td>'
            . $donnees['mdp'] . '</td><td>'
            . $donnees['nom'] . '</td><td>'
            . $donnees['prenom'] . '</td><td>'
            . $donnees['email'] . '</td><td>'
            . $donnees['civilite'] . '</td><td>'
            . $donnees['statut'] . '</td><td>'
            . $donnees['date_enregistrement'] . '</td><td>';
    $content .= "<input type='submit' name='mod' id='mod' value='Modifier' formaction='gestion_membre_modif.php?u=" . $donnees['id_membre'] . "'>"
            . '</td><td>'
            . "<input type='submit' name='sup' id='sup' value='Supprimer' formaction='gestion_membre.php?u=" . $donnees['id_membre'] . "'> " . "</td></tr>";
}
//card-img-top
?>  
<body>
    <form action="" method="POST">   
        <div class="jumbotron text-center">
            <div class="col-sm-12">
                <table class="table table-striped">
                    <thead>Liste des 5 derniers Membres</thead>
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
                    <h3>Ajouter un Membre</h3>
                    <div class="modal-body">
                        <!--le pseudo-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"></span>
                            </div>
                            <input id="pseudo" name="pseudo" type="text" class="form-control" placeholder="Votre Pseudo" aria-label="pseudo" aria-describedby="basic-addon1">
                        </div>
                        <!--le mot de passe--> 
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"></span>
                            </div>
                            <input type="password" name="password" class="form-control" placeholder="Votre mot de passe" aria-label="Password" aria-describedby="basic-addon2">
                        </div>
                        <!--le username-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"></span>
                            </div>
                            <input type="text" name="username" class="form-control" placeholder="Votre Nom" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <!--le prename-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"></span>
                            </div>
                            <input type="text" name="secondname" class="form-control" placeholder="Votre Prénom" aria-label="secondname" aria-describedby="basic-addon1">
                        </div>
                        <!--l'email-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"></span>
                            </div>
                            <input type="email" name="email" class="form-control" placeholder="Votre Email" aria-label="email" aria-describedby="basic-addon1">
                        </div>
                        <!--Sexe-->
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="civilite" id="inlineRadio1" value="Madame">
                            <label class="form-check-label" for="inlineRadio1">Femme</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="civilite" id="inlineRadio2" value="Monsieur">
                            <label class="form-check-label" for="inlineRadio2">Homme</label>
                        </div>
                        <!--Statut-->
                        <div class="form-group">
                            <label for="statut">Statut</label>
                            <select class="form-control" id="statut" name="statut">
                                <option value="0">Utilisateur</option>
                                <option value="1">Administrateur</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="cp">Date d'enregistrement</label>
                        <input type="text" class="form-control" id="cp" name="denregistr" value="<?PHP echo date("Y-m-d H:m:s"); ?>">
                    </div>
                    <button type="submit" name="enr" class="btn btn-primary">Enregistrer</button>
                </div>
                </form>
                <?PHP
                require_once "../template/footer.php";
                require "../lib/inscription.php";
                require "../lib/seconnecter.php";

                if (isset($_POST['mod'])) {
                    header("Location: gestion_membre_modif.php?u=" . $donnees['id_membre']);
                }
                if (isset($_POST['sup'])) {
                    $idmembre = $_GET['u'];
                    $querysupp = $connexion->exec("DELETE FROM membre WHERE id_membre = ' $idmembre '");
                    Echo "La personne ayant pour id  = " . $idmembre . " a bien été supprimée";
                    //alert("Ligne supprimée dans la base = " . $querysupp);
                }
                if (isset($_POST['enr'])) {

                    $pseudo = htmlentities($_POST["pseudo"]);
                    $password = htmlentities($_POST["password"]);
                    $username = htmlentities($_POST["username"]);
                    $secondname = htmlentities($_POST["secondname"]);
                    $email = htmlentities($_POST["email"]);
                    $civilite = htmlentities($_POST["civilite"]);
                    $statut = htmlentities($_POST["statut"]);

                    global $connexion;

                    $req = "INSERT INTO `membre` (`pseudo`,`mdp`,`nom`,`prenom`,`email`,`civilite`,`statut`) VALUES ('$pseudo',md5('$password'),'$username','$secondname','$email','$civilite',$statut)";
                    $res = $connexion->exec($req);
                    //echo "nombre d'enregistrement affecté par l'insert : " . $res . "<br>";
                    alert("Ligne insérée dans la base = " . $res);
                    header('Refresh: 2, url=gestion_membre.php');
                    //echo "dernier id créé : " . $requete->lastInsertId();
                    //header("Location: gestion_salle.php");
//            if(empty($titre) OR empty($desc) OR empty($photo) OR empty($pays))
//            {
//                echo '<font color="red">Attention, aucun champs ne peut rester vide !</font>';
//            }
                }
                ?>
