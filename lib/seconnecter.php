<form action="../pages/accueil.php" method="POST">
    <!-- Modal -->
    <div class="modal fade" id="seconnecter" tabindex="-1" role="dialog" aria-labelledby="seconnecterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Se connecter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!--le pseudo-->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"></span>
                        </div>
                        <input id="pseudo1" name='pseudo1' type="text" class="form-control" placeholder="Votre Pseudo" aria-label="pseudo1" aria-describedby="basic-addon1">
                    </div>
                    <!--le mot de passe--> 
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"></span>
                        </div>
                        <input type="password" name="password1" class="form-control" placeholder="Votre mot de passe" aria-label="Password" aria-describedby="basic-addon2">
                    </div>
                </div>
                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary" name="connex">Envoyer</button>
                    <?PHP
                    if (isset($_POST['connex'])) {
                        $content = '';
                        $pseudo = "";
                        $password = "";
                        if (isset($_POST['pseudo1']) && isset($_POST['password1'])) {

                            $pseudo = htmlentities($_POST['pseudo1']);
                            $password = htmlentities(md5($_POST['password1']));

//                            if (empty($pseudo) OR empty($password)) {
//                                alert('Attention, aucun champs ne peut rester vide !');
//                            } else {
                            session_start();
                            $sql = "SELECT * FROM membre where pseudo = :u AND mdp = :p";
                            $requete = $connexion->prepare($sql); //, PDO::FETCH_ASSOC
                            $requete->bindParam(':u', $pseudo);
                            $requete->bindParam(':p', $password);
                            //execute la requete
                            $requete->execute();

                            $res = $requete->fetch();

                            foreach ($res as $key => $value) {
                                if ($key != "mdp") {
                                    $_SESSION['membre'][$key] = $value;
                                }
                            }
                            session_gc();
                            if (isset($_SESSION['membre']['pseudo'])) {
                                alert('Bienvenue sur votre session ' . $pseudo);
                            } else {
                                alert('Le pseudo et mot de passe sont inconnus, merci de controler votre saisie !');
                            }
                            //unset($_POST);
                            header('Refresh: 5; url=../pages/accueil.php');
                            $requete->closeCursor();
                        }
                    }
                   
                    //var_dump($_POST);
                    ?>
                </div>
            </div>
        </div>
    </div>
</form>
<!--<script>
    $('#seconnecter').on('shown.bs.modal', function () {
        $('#pseudo').trigger('focus');
    });
</script>-->

<script src="../jquery/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>

