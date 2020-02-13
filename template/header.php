<?PHP
require "../lib/loader.php";
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>LokiSalle</title>
        <!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">-->
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--<link rel="stylesheet" href="../loki.css">-->
        <link rel="stylesheet" href="../shop.css">
        <script src="https://use.fontawesome.com/releases/v5.12.0/js/all.js" data-auto-replace-svg="nest"></script>
        <!--<META HTTP-EQUIV="Refresh" CONTENT="30; URL=http://localhost/Lokisalles/pages/accueil.php">-->
    </head>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="../pages/accueil.php">LokiSalles</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../pages/accueil.php">Accueil
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <?php if (!isset($_SESSION['membre']['pseudo'])) { ?>    
                        <li class="nav-item">
                            <a class="nav-link" href="#inscription" data-toggle="modal" data-target="#inscription">Inscription</a>
                        </li>
                    <?php } ?>
                    <!--$('#inscription').modal('show')-->
                    <?php if (isset($_SESSION['membre']['pseudo'])) { ?>    
                        <li class="nav-item">
                            <a class="nav-link" href="../lib/deconnexion.php">Déconnexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="commandes.php">Commandes</a>
                        </li>
                    <?php } else { ?>    
                        <li class="nav-item">
                            <a class="nav-link" href="#seconnecter" data-toggle="modal" data-target="#seconnecter">Connexion</a>
                        </li>
                    <?php } ?>
                    <!--$('#seconnecter').modal('show')-->
                    <!--                    //<button type="button" data-toggle="modal" data-target="#myModal">Launch modal</button>-->
                    <li class="nav-item">
                        <a class="nav-link" href="../pages/quisommesnous.php">Contacts</a>
                    </li>
                    <?php if (internauteEstConnecteEtEstAdmin()) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="../pages/gestion_salles.php">Gestion des Salles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../pages/gestion_produits.php">Gestion des Produits</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../pages/gestion_membre.php">Gestion des Membres</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../pages/gestion_avis.php">Gestion des Avis</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../pages/dashboard.php">Dashboard</a>
                        </li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </nav>
