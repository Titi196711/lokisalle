ls<?PHP require "../template/header.php"; ?>
<?PHP
$listeSalle = readSalle($_GET['s1']);
if (isset($_GET['s2'])) {
    $salle2 = readSalle($_GET['s2']);
}
if (isset($_GET['s3'])) {
    $salle3 = readSalle($_GET['s3']);
}
if (isset($_GET['s4'])) {
    $salle4 = readSalle($_GET['s4']);
}
if (isset($_GET['s5'])) {
    $salle5 = readSalle($_GET['s5']);
}

//echo '<pre>';
//print_r($salle2);
//echo '</pre>';
?>
<body>
    <form action="" method="POST"> 
        <div class="container">
            <!-- Portfolio Item Heading -->
            <h1 class="my-4"><?PHP echo($listeSalle[0]['titre']) ?>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>

                <!--        
                <div class="input-group margin-bottom-sm">
                  <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i></span>
                  <input class="form-control" type="text" placeholder="Email address">
                </div>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-key fa-fw" aria-hidden="true"></i></span>
                  <input class="form-control" type="password" placeholder="Password">
                </div>
                

            </h1>

            <!-- Portfolio Item Row -->
            <div class="row">

                <div class="col-md-8">
                    <img class="img-fluid" src="../images/<?PHP echo($listeSalle[0]['photo']) ?>" alt="Image Produit" height="500" width="750">
                    <h3 class="my-3" style="text-decoration: underline;">Informations complémentaires:</h3>
                    <div class="global" style="display:flex; justify-content: space-around;">
                        <div class="global1">
                            <ul class="test" style="font-size: 20px;">
                                <li>Rue : <?PHP echo($listeSalle[0]['adresse']) ?></li>
                                <li>Code Postal : <?PHP echo($listeSalle[0]['cp']) ?></li>
                                <li>Ville : <?PHP echo($listeSalle[0]['ville']) ?></li>
                                <li>Pays : <?PHP echo($listeSalle[0]['pays']) ?></li>
                                <li>Capacité : <?PHP echo($listeSalle[0]['capacite']) ?> personnes</li>
                            </ul>
                        </div>
                        <div class="global2">
                            <ul class="test" style="font-size: 20px;">
                                <li>Catégorie : <?PHP echo($listeSalle[0]['categorie']) ?></li>
                                <li>Du : <?PHP echo(date_format(date_create($listeSalle[0]['date_arrivee']), 'd-m-Y')) ?></li>
                                <li>Au : <?PHP echo(date_format(date_create($listeSalle[0]['date_depart']), 'd-m-Y')) ?></li>
                                <li>Prix : <?PHP echo($listeSalle[0]['prix']) ?> €</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <h3 class="my-3" style="text-decoration: underline;">Description:</h3>
                    <p class="test" style="font-size: 20px;"><?PHP echo($listeSalle[0]['description']) ?></p>
                    <h3 style="text-decoration: underline;">Localisation:</h3>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2628.8041379944975!2d2.0420021157857193!3d48.78562937928034!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e686d43b884fc1%3A0x669ef97f265d1ea4!2s14%20Avenue%20Gustave%20Eiffel%2C%2078180%20Montigny-le-Bretonneux!5e0!3m2!1sfr!2sfr!4v1577800595297!5m2!1sfr!2sfr" width="300" height="225" style="border:0;" allowfullscreen=""></iframe>
<!--                    <ul>

                    </ul>-->
                </div>
                <?php if (isset($_SESSION['membre']['pseudo'])) { ?> 
                    <button type="submit" name="reserver" class="btn btn-success">Réserver</button>
                <?php } else { ?> 
                    <button type="submit" name="reserver" class="btn btn-success" disabled="disabled" title="Vous devez être connecté pour commander">Réserver</button>
                    <p> Vous devez être connecté pour commander</p>
                <?php } ?>
            </div>
            <!-- /.row -->

            <!-- Les autres produits -->
            <?PHP if (isset($_GET['s2']) && isset($_GET['s3']) && isset($_GET['s4']) && isset($_GET['s5'])) { ?>
                <h3 class="my-4" style="text-decoration: underline;">Autres Produits correspondants à vos critères:</h3>
            <?PHP } ?>
            <div class="row">
                <?PHP if (isset($_GET['s2'])) { ?>
                    <div class="col-md-3 col-sm-3 mb-4">
                        <a a href="fiche_produit.php?s1=<?PHP echo($salle2[0]['id_salle']) ?>">
                            <img class="img-fluid" src="../images/<?PHP echo($salle2[0]['photo']) ?>" alt="" height="150" width="250">
                        </a>
                    </div>
                <?PHP } ?>
                <?PHP if (isset($_GET['s3'])) { ?>
                    <div class="col-md-3 col-sm-3 mb-4">
                        <a href="fiche_produit.php?s1=<?PHP echo($salle3[0]['id_salle']) ?>">
                            <img class="img-fluid" src="../images/<?PHP echo($salle3[0]['photo']) ?>" alt="" height="150" width="250">
                        </a>
                    </div>
                <?PHP } ?>
                <?PHP if (isset($_GET['s4'])) { ?>
                    <div class="col-md-3 col-sm-3 mb-4">
                        <a href="fiche_produit.php?s1=<?PHP echo($salle4[0]['id_salle']) ?>">
                            <img class="img-fluid" src="../images/<?PHP echo($salle4[0]['photo']) ?>" alt="" height="150" width="250">
                        </a>
                    </div>
                <?PHP } ?>
                <?PHP if (isset($_GET['s5'])) { ?>
                    <div class="col-md-3 col-sm-3 mb-4">
                        <a href="fiche_produit.php?s1=<?PHP echo($salle5[0]['id_salle']) ?>">
                            <img class="img-fluid" src="../images/<?PHP echo($salle5[0]['photo']) ?>" alt="" height="150" width="250">
                        </a>
                    </div>
                <?PHP } ?>
            </div>
            <?PHP
            if ($_POST) {
                $requete = $connexion->prepare("UPDATE produit SET etat = :etat WHERE id_produit = " . $listeSalle[0]['id_produit']);
                $requete->execute(array(
                    ':etat' => 'Reservation',
                ));

                //echo "<p style='color:green;font-style:bold;'>Modification réussie !</p>";
                alert('Réservation Effectuée !');
                //$requete->closeCursor();

                global $connexion;
                if (isset($_SESSION['membre']['id_membre'])) {
                    $membreid = ($_SESSION['membre']['id_membre']);
                    $idproduit = $listeSalle[0]['id_produit'];
                    $query = $connexion->exec("INSERT INTO `commande` (membre_id, produit_id) VALUES ('$membreid', '$idproduit')");
                }
                header('Refresh: 1');
            }
            ?>
        </div>
    </form>
    <?PHP
    require "../template/footer.php";
    require "../lib/inscription.php";
    require "../lib/seconnecter.php";
    ?>
