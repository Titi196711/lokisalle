<?PHP

require "../template/header.php";
//require "../lib/loader.php";
$listePrixSalle = produitSalle();
//print_r($listePrixSalle);
$capacite = capacite();
$prix = prix();
$cat = "";
echo $content;
//phpinfo();
?>
<link rel="stylesheet" href="../js/foopicker.css" type="text/css">
<script src="../js/foopicker.js" type="text/javascript">
    let CheminComplet = document.location.href;
    console.log(CheminComplet);</script>
<body>
    <!--<form action="../pages/fiche_produit.php" method="POST">-->
    <!--<form action="../lib/form-process.php" method="POST" id="rechform" role="form">-->
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <h2 class="my-4">Catégorie</h2>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action" id="list-bureau-list" data-toggle="list" role="tab" aria-controls="bureau">Bureau</a>
                    <a href="#" class="list-group-item list-group-item-action" id="list-formation-list" data-toggle="list" role="tab" aria-controls="fomation">Formation</a>
                    <a href="#" class="list-group-item list-group-item-action" id="list-reunion-list" data-toggle="list" role="tab" aria-controls="reunion">Réunion</a>
                </div>
                <h2 class="my-4">Ville</h2>
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action" id="list-paris-list" data-toggle="list" role="tab" aria-controls="paris">Paris</a>
                    <a href="#" class="list-group-item list-group-item-action" id="list-lyon-list" data-toggle="list" role="tab" aria-controls="lyon">Lyon</a>
                    <a href="#" class="list-group-item list-group-item-action" id="list-marseille-list" data-toggle="list" role="tab" aria-controls="marseille">Marseille</a>
                </div>
                <h2 class="my-4">Capacité</h2>
                <select class="custom-select" id="inputGroupSelect01">
                    <option selected>Capacité</option>
                    <?PHP
                    for ($i = 0; $i < count($capacite); $i++) {
                        echo '<option value=' . $capacite[$i]['capacite'] . ' name="capacite">' . $capacite[$i]['capacite'] . " </option>";
                    }
                    ?>
                </select>
                <h2 class="my-4">Prix</h2>
                <label for="customRange2" name="prix">Prix 0 à 1500€</label>
                <input type="range" class="custom-range" value="1500" min="0" max="1500" step="50" id="customRange2">
                <h2 class="my-4">Période</h2>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary" type="button">Date ?</button>
                    </div>
                    <input name="date_arrivee" id="date1" type="date" class="form-control" placeholder="Date d'arrivée" aria-label="datearrivee" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-secondary" type="button">Date ?</button>
                    </div>
                    <input name="date_depart" id="date2" type="date" class="form-control" placeholder="Date de départ" aria-label="datedepart" aria-describedby="basic-addon1">
                </div>
                <button type="submit" id="form-submit" class="btn btn-success" value="rechercher">Rechercher</button>
            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-9">
                <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="d-block img-fluid" src="../images/<?PHP echo($listePrixSalle[6]['photo']) ?>" alt="First slide" width="900" height="350">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="../images/<?PHP echo($listePrixSalle[7]['photo']) ?>" alt="Second slide" width="900" height="350">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-fluid" src="../images/<?PHP echo($listePrixSalle[8]['photo']) ?>" alt="Third slide" width="900" height="350">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <?PHP $un = rand(0, 40); ?>
                            <a href="fiche_produit.php?s1=<?= $listePrixSalle[$un]['id_salle'] ?>"><img class="card-img-top" src="../images/<?PHP echo($listePrixSalle[$un]['photo']); ?>" alt="" width="500" height="120"></a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="#"><?PHP echo($listePrixSalle[$un]['titre']); ?></a>
                                </h4>
                                <h5><?PHP echo($listePrixSalle[$un]['prix']); ?>€</h5>
                                <p class="card-text"><?PHP echo($listePrixSalle[$un]['description']); ?></p>
                                <p class="card-text"><?PHP echo('Du ' . date_format(date_create($listePrixSalle[$un]['date_arrivee']), 'd-m-Y') . ' au ' . date_format(date_create($listePrixSalle[$un]['date_depart']), 'd-m-Y')) ?></p>
                                <p class="card-text"><?PHP echo('Ville : ' . $listePrixSalle[$un]['ville']); ?></p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <?PHP $deux = rand(0, 40) ?>
                            <a href="fiche_produit.php?s1=<?= $listePrixSalle[$deux]['id_salle'] ?>"><img class="card-img-top" src="../images/<?PHP echo($listePrixSalle[$deux]['photo']) ?>" alt="" width="500" height="120"></a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="#"><?PHP echo($listePrixSalle[$deux]['titre']) ?></a>
                                </h4>
                                <h5><?PHP echo($listePrixSalle[$deux]['prix']) ?>€</h5>
                                <p class="card-text"><?PHP echo($listePrixSalle[$deux]['description']) ?></p>
                                <p class="card-text"><?PHP echo('Du ' . date_format(date_create($listePrixSalle[$deux]['date_arrivee']), 'd-m-Y') . ' au ' . date_format(date_create($listePrixSalle[$deux]['date_depart']), 'd-m-Y')) ?></p>
                                <p class="card-text"><?PHP echo('Ville : ' . $listePrixSalle[$deux]['ville']); ?></p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <?PHP $trois = rand(0, 40) ?>
                            <a href="fiche_produit.php?s1=<?= $listePrixSalle[$trois]['id_salle'] ?>"><img class="card-img-top" src="../images/<?PHP echo($listePrixSalle[$trois]['photo']) ?>" alt="" width="500" height="120"></a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="#"><?PHP echo($listePrixSalle[$trois]['titre']) ?></a>
                                </h4>
                                <h5><?PHP echo($listePrixSalle[$trois]['prix']) ?>€</h5>
                                <p class="card-text"><?PHP echo($listePrixSalle[$trois]['description']) ?></p>
                                <p class="card-text"><?PHP echo('Du ' . date_format(date_create($listePrixSalle[$trois]['date_arrivee']), 'd-m-Y') . ' au ' . date_format(date_create($listePrixSalle[$trois]['date_depart']), 'd-m-Y')) ?></p>
                                <p class="card-text"><?PHP echo('Ville : ' . $listePrixSalle[$trois]['ville']); ?></p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <?PHP $quatre = rand(0, 40) ?>
                            <a href="fiche_produit.php?s1=<?= $listePrixSalle[$quatre]['id_salle'] ?>"><img class="card-img-top" src="../images/<?PHP echo($listePrixSalle[$quatre]['photo']) ?>" alt="" width="500" height="120"></a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="#"><?PHP echo($listePrixSalle[$quatre]['titre']) ?></a>
                                </h4>
                                <h5><?PHP echo($listePrixSalle[$quatre]['prix']) ?>€</h5>
                                <p class="card-text"><?PHP echo($listePrixSalle[$quatre]['description']) ?></p>
                                <p class="card-text"><?PHP echo('Du ' . date_format(date_create($listePrixSalle[$quatre]['date_arrivee']), 'd-m-Y') . ' au ' . date_format(date_create($listePrixSalle[$quatre]['date_depart']), 'd-m-Y')) ?></p>
                                <p class="card-text"><?PHP echo('Ville : ' . $listePrixSalle[$quatre]['ville']); ?></p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <?PHP $cinq = rand(0, 40) ?>
                            <a href="fiche_produit.php?s1=<?= $listePrixSalle[$cinq]['id_salle'] ?>"><img class="card-img-top" src="../images/<?PHP echo($listePrixSalle[$cinq]['photo']) ?>" alt="" width="500" height="120"></a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="#"><?PHP echo($listePrixSalle[$cinq]['titre']) ?></a>
                                </h4>
                                <h5><?PHP echo($listePrixSalle[$cinq]['prix']) ?>€</h5>
                                <p class="card-text"><?PHP echo($listePrixSalle[$cinq]['description']) ?></p>
                                <p class="card-text"><?PHP echo('Du ' . date_format(date_create($listePrixSalle[$cinq]['date_arrivee']), 'd-m-Y') . ' au ' . date_format(date_create($listePrixSalle[$cinq]['date_depart']), 'd-m-Y')) ?></p>
                                <p class="card-text"><?PHP echo('Ville : ' . $listePrixSalle[$cinq]['ville']); ?></p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <?PHP $six = rand(0, 40) ?>
                            <a href="fiche_produit.php?s1=<?= $listePrixSalle[$six]['id_salle'] ?>"><img class="card-img-top" src="../images/<?PHP echo($listePrixSalle[$six]['photo']) ?>" alt="" width="500" height="120"></a>
                            <div class="card-body">
                                <h4 class="card-title">
                                    <a href="#"><?PHP echo($listePrixSalle[$six]['titre']) ?></a>
                                </h4>
                                <h5><?PHP echo($listePrixSalle[$six]['prix']) ?>€</h5>
                                <p class="card-text"><?PHP echo($listePrixSalle[$six]['description']) ?></p>
                                <p class="card-text"><?PHP echo('Du ' . date_format(date_create($listePrixSalle[$six]['date_arrivee']), 'd-m-Y') . ' au ' . date_format(date_create($listePrixSalle[$six]['date_depart']), 'd-m-Y')) ?></p>
                                <p class="card-text"><?PHP echo('Ville : ' . $listePrixSalle[$six]['ville']); ?></p>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.col-lg-9 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
    <!--</form>-->
    <script type="text/javascript">
        let foopicker = new FooPicker({
            id: 'datepicker',
            dateFormat: 'dd/MMM/yyyy',
            disable: ['25/12/2019', '31/12/2019', '01/01/2020', '01/04/2020']
        });
        let foopicker2 = new FooPicker({
            id: 'datepicker2',
            dateFormat: 'dd/MMM/yyyy',
            disable: ['25/12/2019', '31/12/2019', '01/01/2020', '01/04/2020']
        });
        //pour récupérer les infos des boutons
//        let cc, vv;
//        function barread(prime, second) {
//
//            //let ca = cat;
//            var ad;
//            ad = window.location;
//            if (prime == "cat" && cc != "") {
//                ad += "?cat=" + second;
//                cc = second;
//            }
//            if (prime == "vil" && vv != "") {
//                ad += "?cat=" + cc + "&vil=" + second;
//                vv = second;
//            }
//            let x = document.getElementById("inputGroupSelect01");
//            let i = x.selectedIndex;
//
//            ad += "?cat=" + cc + "&vil=" + second + "&cap=".i;
////        window.location.replace(ad);
//            alert(ad);
//        }

        var categorie;
        $("#list-bureau-list").click(function () {
            categorie = 'bureau';
        });
        $("#list-formation-list").click(function () {
            categorie = 'formation';
        });
        $("#list-reunion-list").click(function () {
            categorie = 'reunion';
        });
        var ville;
        $("#list-paris-list").click(function () {
            ville = 'paris';
        });
        $("#list-lyon-list").click(function () {
            ville = 'lyon';
        });
        $("#list-marseille-list").click(function () {
            ville = 'marseille';
        });

        $("#form-submit").click(function () {
            // Initiate Variables With Form Content
            let capacite = $("#inputGroupSelect01").val();
            let prix = $("#customRange2").val();
            let daa = $("#datepicker").val();
            let dad = $("#datepicker2").val();
//        alert(categorie + ' ' + ville + ' ' + capacite + ' ' + prix + ' ' + daa + ' ' + dad);
//        $.ajax({
//                type: 'POST',
//                url: '../lib/form-process.php?',
//                data: 'cat=' + categorie + '&vil=' + ville + '&cap=' + capacite + '&pri=' + prix + '&daa=' + daa + '&dad=' + dad,
//              });
            data = 'cat=' + categorie + '&vil=' + ville + '&cap=' + capacite + '&pri=' + prix + '&daa=' + daa + '&dad=' + dad;
            //alert('Hello : '+data);
            $(location).attr('href', '../lib/form-process.php?' + data);
        });

    </script>
    <?PHP
//    $url = $_SERVER['PHP_SELF'] ;
//    echo($url) ; 
    echo $cat;
    require_once("../template/footer.php");
    require "../lib/seconnecter.php";
    require "../lib/inscription.php";
    ?>
