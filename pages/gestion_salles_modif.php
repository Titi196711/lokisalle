<!DOCTYPE html>
<?PHP
require "../template/header.php";
global $connexion;
$id = $_GET['m'];
$sql = "SELECT * FROM `salle` WHERE id_salle=`" . $id . "`";
$requete = $connexion -> prepare($sql);
$requete -> execute();
$datas = $requete->fetch();
print_r($datas);
//echo $datas['id_salle'];
//echo $datas['titre'];
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Modification d'une salle</title>
    </head>
    <body>
           <form action="" method="POST">   
        <div class="jumbotron text-center">
            <div class="col-sm-12">
                <table class="table table-striped">
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
                   
                </table>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-6" id="grga">
                    <!--                <h3>Column 1</h3>-->
                    <div class="form-group">
                        <label for="titre">Titre:</label>
                        <input type="text" class="form-control mr-sm-1" id="titre" value="<?PHP echo $datas['titre'];?>">
                    </div>
                    <div class="form-group">
                        <label for="descrip">Description:</label>
                        <textarea class="form-control mr-sm-1" rows="5" id="descrip"></textarea>
                    </div> 
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="text" class="form-control" id="photo">
                    </div> 
                    <div class="form-group">
                        <label for="capa">Capacité:</label>
                        <select class="form-control" id="capa">
                        <?PHP
                        for ($i = 1; $i <= 50 ; $i++) {
                            echo '<option value='. $i .' name="capacite">' . $i . " </option>";
                        }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="categ">Catégorie:</label>
                        <select class="form-control" id="categ">
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
                        <select class="form-control" id="pays">
                            <option>France</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ville">Ville:</label>
                        <select class="form-control" id="ville">
                            <option>Paris</option>
                            <option>Lyon</option>
                            <option>Marseille</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse:</label>
                        <textarea class="form-control" rows="5" id="adresse"></textarea>
                    </div> 
                    <div class="form-group">
                        <label for="cp">Code Postal:</label>
                        <input type="text" class="form-control" id="cp">
                    </div>
                    <button type="button" name="modifier" class="btn btn-primary">Modifier</button>
                </div>
                </form>
    </body>
</html>
