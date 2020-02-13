<!--Button trigger modal--> 
<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inscription">
    Launch demo modal
</button>-->
<form action="../pages/accueil.php" method="POST">
    <!-- Modal -->
    <div class="modal fade" id="inscription" tabindex="-1" role="dialog" aria-labelledby="inscriptionTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">S'inscrire</h5>
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
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Madame">
                        <label class="form-check-label" for="inlineRadio1">Femme</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Monsieur">
                        <label class="form-check-label" for="inlineRadio2">Homme</label>
                    </div>
                </div>
                <!--Footer-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary" value="inscrip">Envoyer</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
//require "loader.php";
//print_r($_POST);
if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['username']) && isset($_POST['secondname']) && isset($_POST['email']) && isset($_POST['inlineRadioOptions'])) {
    //($_POST && isset($pseudo) && isset($password) && isset($username) && isset($secondname) && isset($email) && isset($sexe)) {
    $pseudo = htmlentities($_POST['pseudo']);
    $password = htmlentities($_POST['password']);
    $username = htmlentities($_POST['username']);
    $secondname = htmlentities($_POST['secondname']);
    $email = htmlentities($_POST['email']);
    $sexe = htmlentities($_POST['inlineRadioOptions']);

    if (empty($pseudo) || empty($password) || empty($username) || empty($secondname) || empty($email) || empty($sexe)) {
        echo '<font color="red">Attention, aucun champs ne peut rester vide !</font>';
    } else {
        $req = "INSERT INTO `membre` (`pseudo`,`mdp`,`nom`,`prenom`,`email`,`civilite`) VALUES ('$pseudo',md5('$password'),'$username','$secondname','$email','$sexe')";
        echo $req;
        $res = $connexion->exec($req);
        //echo "Ligne insérée dans la base = " . $res;
        alert("Ligne insérée dans la base = " . $res);
        unset($_POST);
    }
    $req->closeCursor();
}

//tu vides la $_POST avec unset()
//t'affiche var_dump($_POST);
// var_dump($_POST);
?>
    <!--<script>
      $('#exampleModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var recipient = button.data('whatever') // Extract info from data-* attributes
      // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
      // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
      var modal = $(this);
      modal.find('.modal-title').text('New message to ' + recipient);
      modal.find('.modal-body input').val(recipient);
    })-->
<!--<script>
    $('#inscription').on('shown.bs.modal', function () {
        $('#pseudo').trigger('focus');
    });
</script>-->

<script src="../jquery/jquery.min.js"></script>
<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
