<!DOCTYPE html>
<html lang="fr ">
    <head>
        <meta charset="UTF-8">
        <title>Gestion des salles</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="../inc/css/style.css">
    </head>
    <body>
        <?php
//        try {
            $connexion = new PDO('mysql:host=localhost;dbname=lokisalle;charset=utf8', 'root', '');
//        } catch (Exception $e) {
//            die("Erreur : " . $e->getMessage());
//        }

        function readSalleAll() {

            global $connexion;
            $sql = "SELECT * FROM salle";
            $requete = $connexion->query($sql, PDO::FETCH_ASSOC);
            $requete->execute();
            $result = $requete->fetchAll();
            $r = [];

            foreach ($result as $row) {
                $room["id_salle"] = $row["id_salle"];
                $room["titre"] = $row["titre"];
                $room["description"] = $row["description"];
                $room["photo"] = $row["photo"];
                $room["pays"] = $row["pays"];
                $room["ville"] = $row["ville"];
                $room["adresse"] = $row["adresse"];
                $room["cp"] = $row["cp"];
                $room["capacite"] = $row["capacite"];
                $room["categorie"] = $row["categorie"];
            }
            return $r;
        }

        $listeSalle = readSalleAll();
        ?>
        <main>
            <div class="main">
                <div class="col-sm-6 first">
                    <table class="table table-striped"> <!-- class bootstrap pour mise en forme-->
                        <thead>
                            <tr>
                                <th colspan="2">id_salle</th>
                                <th colspan="2">titre</th>
                                <th colspan="2">description</th>
                                <th colspan="2">photo</th>
                                <th colspan="2">pays</th>
                                <th colspan="2">ville</th>
                                <th colspan="2">adresse</th>
                                <th colspan="2">cp</th>
                                <th colspan="2">capacité</th>
                                <th colspan="2">catégorie</th>
                                <th colspan="2">actions</th>
                            </tr>
                        </thead>
                        <tbody>
                         <!--    //<?= $salles ?> -->
                        </tbody>         
                    </table>
                </div>
                <form method="POST" >
                    <div class="gestion1">
                        <div>
                            <label for="titre">Titre</label><br>
                            <input type="text" id="titre" name="titre" placeholder ="Titre de la salle">
                        </div>
                        <div>
                            <label for="description">Description</label><br>
                            <input type="text" id="description" name="description" placeholder ="Description de la salle">
                        </div>
                        <div>
                            <label for="photo">Photo</label><br>
                            <input type="text" id="photo" name="photo" >
                        </div>
                        <div>
                            <label for="capacity1">Capacité</label><br>
                            <select name="capacite" id="capacity1">
                                <option value="two">2</option>
                                <option value="five">5</option>
                                <option value="five">10</option>
                                <option value="twenty">20</option>
                                <option value="five">30</option>
                                <option value="fifty">50</option>
                                <option value="eighty">80</option>
                            </select>
                        </div>
                        <div>
                            <label for="category">Catégorie</label><br>
                            <select name="categorie" id="category">
                                <option value="bureau">Bureau</option>
                                <option value="reunion">Réunion</option>
                                <option value="formation">Formation</option>
                            </select>
                        </div>
                    </div>
                    <div class="gestion2">
                        <div>
                            <label for="country">Pays</label><br>
                            <select name="pays" id="country">
                                <option value="France">France</option>
                            </select>
                        </div>
                        <div>
                            <label for="city">Ville</label><br>
                            <select name="ville" id="city">
                                <option value="paris">Paris</option>
                                <option value="lyon">Lyon</option>
                                <option value="marseille">Marseille</option>
                            </select>
                        </div>
                        <div>
                            <label for="adress">Adresse</label><br>
                            <input type="text" id="adress" name="adresse" value="Adresse de la salle">
                        </div>
                        <div>
                            <label for="code">Code Postal</label><br>
                            <input type="text" id="code" name="cp" value="Code postal de la salle">
                        </div>
                        <div>
                            <button type="submit" class="enregistrer">Enregistrer</button>
                        </div>
                    </div>
                </form>
        </main>

             <!-- // $produits .= '<tr>
             // 				    <td colspan="2">'.$ligne['id_salle'].'</td>
             // 				    <td colspan="2">'.$ligne['titre'].'</td>
             // 				    <td colspan="2">'.$ligne['description'].'</td>
             // 				    <td colspan="2">'.'<img src="../photos/'.$ligne['photo'].'"></td>
             // 				    <td colspan="2">'.$ligne['pays'].'</td>
             // 				    <td colspan="2">'.$ligne['ville'].'</td>
             // 				    <td colspan="2">'.$ligne['adresse'].'</td>
             // 				    <td colspan="2">'.$ligne['cp'].'</td>
             // 				    <td colspan="2">'.$ligne['capacite'].'</td>
             // 				    <td colspan="2">'.$ligne['categorie'].'</td>
             // 				</tr>';
        -->

        <?php
        if ($_POST) {
            if (isset($_POST['titre'])) {
                $titre = $_POST['titre'];
            }
            if (isset($_POST['description'])) {
                $description = $_POST['description'];
            }
            if (isset($_POST['photo'])) {
                $photo = $_POST['photo'];
            }
            if (isset($_POST['capacite'])) {
                $capacite = $_POST['capacite'];
            }
            if (isset($_POST['categorie'])) {
                $categorie = $_POST['categorie'];
            }
            if (isset($_POST['pays'])) {
                $pays = $_POST['pays'];
            }
            if (isset($_POST['ville'])) {
                $ville = $_POST['ville'];
            }
            if (isset($_POST['adresse'])) {
                $adresse = $_POST['adresse'];
            }
            if (isset($_POST['cp'])) {
                $codepostal = $_POST['cp'];
            }
$capacite = 2;
            echo $titre.$description.$photo.$pays.$ville.$adresse.$capacite.$categorie.$codepostal;
            $requete = $connexion->exec("INSERT INTO `salle` (`titre`, `description`, `photo`, `pays`, `ville`, `adresse`, `capacite`, `categorie`, `cp`) "
                    . "VALUES ('$titre', '$description', '$photo', '$pays', '$ville','$adresse','$capacite', '$categorie', '$codepostal')");
        }
        ?>


    </body>
</html>