<?PHP require "../template/header.php"; ?>
<?php
global $connexion;
$membreid = $_SESSION['membre']['id_membre'];
$pseudo = $_SESSION['membre']['pseudo'];
$nom = $_SESSION['membre']['nom'];
$prenom = $_SESSION['membre']['prenom'];
$email = $_SESSION['membre']['email'];
$civilite = $_SESSION['membre']['civilite'];
$statut = $_SESSION['membre']['statut'];

if ($_SESSION['membre']['statut'] == 1) {
    $sql = 'SELECT * FROM `commande` 
join membre on membre_id = id_membre
join produit on produit_id = id_produit
join salle on salle_id = id_salle';
} else {
    $sql = 'SELECT * FROM `commande` 
join membre on membre_id = id_membre
join produit on produit_id = id_produit
join salle on salle_id = id_salle
where membre_id = :membreid;';
}
$requete = $connexion->prepare($sql);
$requete->bindParam(':membreid', $membreid);
$requete->execute();
$content = "";
while ($donnees = $requete->fetch()) {
    $content .= "<tr><td>" . $donnees['id_commande'] . '</td><td>'
            . $donnees['pseudo'] . '</td><td>'
            . $donnees['civilite'] . '</td><td>'
            . $donnees['nom'] . '</td><td>'
            . $donnees['prenom'] . '</td><td>'
            . $donnees['email'] . '</td><td>'
            . $donnees['titre'] . '</td><td>'
            . date_format(date_create($donnees['date_arrivee']), 'd-m-Y H:i:s') . '</td><td>'
            . date_format(date_create($donnees['date_depart']), 'd-m-Y H:i:s') . '</td><td>'
            . $donnees['prix'] . ' €</td><td>';
    $content .= "<input type='submit' name='sup' id='sup' value='Supprimer' formaction='commandes.php?c=".$donnees['id_commande']." & s= ".$donnees['id_produit']. "'> " . "</td></tr>";
}
?>
<body>
    <form action="" method="POST">   
        <div class="jumbotron text-center">
            <div class="col-sm-12">
                <table class="table table-striped">
                    <thead>Liste des commandes</thead>
                    <tr>
                        <th>ID Commande</th>
                        <th>Pseudo</th>
                        <th>Civilité</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Titre</th>
                        <th>Date Arrivée</th>
                        <th>Date Départ</th>
                        <th>Prix</th>
                        <th>Action1</th>
                    </tr>   
                    <?= $content ?>
                </table>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-6" id="grga">
                    <h3>Compte de l'utilisateur</h3>
                    <div class="modal-body">
                        <!--le pseudo-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"></span>
                            </div>
                            <input id="pseudo" name="pseudo" type="text" class="form-control" placeholder="Votre Pseudo" aria-label="pseudo" aria-describedby="basic-addon1" value="<?PHP echo $pseudo ?>">
                        </div>
                        <!--Sexe-->
                        <!--                        <div class="form-check form-check-inline">
                        <?PHP
                        if ($civilite == "Madame") {
                            echo "<input checked class='form-check-input' type='radio' name='civilite' id='inlineRadio1' value='Madame'>";
                        } else {
                            echo "<input class='form-check-input' type='radio' name='civilite' id='inlineRadio1' value='Madame'>";
                        }
                        ?>
  
                        <?PHP
                        if ($civilite == "Monsieur") {
                            echo "<input checked class='form-check-input' type='radio' name='civilite' id='inlineRadio2' value='Monsieur'>";
                        } else {
                            echo "<input class='form-check-input' type='radio' name='civilite' id='inlineRadio2' value='Monsieur'>";
                        }
                        ?>

                        <!--Statut-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"></span>
                            </div>
                            <input type="input" name="civilite" class="form-control"  aria-label="text" aria-describedby="basic-addon1" value="<?PHP echo $civilite ?>">
                        </div>

                        <!--le username-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"></span>
                            </div>
                            <input type="text" name="username" class="form-control" placeholder="Votre Nom" aria-label="Username" aria-describedby="basic-addon1" value="<?PHP echo $nom ?>">
                        </div>
                        <!--le prename-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"></span>
                            </div>
                            <input type="text" name="secondname" class="form-control" placeholder="Votre Prénom" aria-label="secondname" aria-describedby="basic-addon1"value="<?PHP echo $prenom ?>">
                        </div>
                        <!--l'email-->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"></span>
                            </div>
                            <input type="email" name="email" class="form-control" placeholder="Votre Email" aria-label="email" aria-describedby="basic-addon1" value="<?PHP echo $email ?>">
                        </div>
                        <div class="form-group">
                            <label for="cp">Date d'enregistrement</label>
                            <input type="text" class="form-control" id="cp" name="denregistr" value="<?PHP echo date("Y-m-d H:m:s"); ?>">
                        </div>
                        <!--<button type="submit" name="mo" class="btn btn-primary">Modifier</button>-->
                    </div>
                </div>
            </div>
        </div>

        <?PHP
        require '../template/footer.php';
        if (isset($_POST['sup'])) {
            $idcommande = $_GET['c'];
            $querysupp = $connexion->exec("DELETE FROM commande WHERE id_commande ='$idcommande'");
            //Echo "Le produit ayant pour id  = " . $idproduit . " a bien été supprimé";
           $requete = $connexion->exec("UPDATE produit SET etat = 'Libre' WHERE id_produit = " . $_GET['s']);
            alert("Le produit ayant pour id  = " . $idcommande . " a bien été supprimé");
        }
        ?>
