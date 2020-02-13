<?PHP
require "../template/header.php";
//require "../lib/loader.php";
?>
<div class="container">
    <div class="row">
        <div class="col-5">
            <main  id='contact'>
                <h1>Contactez-nous !</h1>
                <form method="post" action="envoipage.php">
                    <fieldset>
                        <legend>Vos coordonnées</legend>
                        <h2>Identité</h2>
                        <p>
                            <label class="control-label" for="cnom">Votre Nom</label> : 
                            <input class="form-control" type="text" name="navom" id="cnom" placeholder="Entrez votre Nom ici ..." size=50 maxlength="50" required/>
                            <br/>
                            <label class="control-label" for="cprenom">Votre Prénom</label> : 
                            <input class="form-control" type="text" name="pravenavom" id="cprenom" placeholder="... et ici votre prénom" size=50 maxlength="50" required />
                            <br/>
                            <label class="control-label" for="centrep">Votre Entreprise</label> : 
                            <input class="form-control" type="text" name="centrep" id="entrep" placeholder="... et ici votre entreprise" size=50 maxlength="50"/>
                        </p>
                        <h2>Coordonnées</h2>
                        <p>
                            <label class="control-label" for="ctelephone">Téléphone</label> : 
                            <input class="form-control" type="tel" name="tel" id="ctelephone" placeholder="Entrez votre numéro de téléphone" size=20 maxlength="20"/>
                            <br/>
                            <label class="control-label" for="cmail">Votre E-mail</label> : 
                            <input class="form-control" type="email" name="mavail" id="cmail" placeholder="... et ici votre E-mail" size=50 maxlength="50" required/>
                        <h2>Pays</h2>
                        <label class="control-label" for="cpays">Quel est votre pays ? </label>
                        <select name="pays" id="cpays">	
                            <optgroup label="Pays/Europe">
                                <option value="Allemagne">Allemagne</option>
                                <option value="Andorre">Andorre</option>
                                <option value="Belgique">Belgique</option>
                                <option value="Espagne">Espagne</option>
                                <option value="France" selected="selected">France</option>
                                <option value="Italie">Italie</option>
                                <option value="Luxembourg">Luxembourg</option>
                                <option value="Monaco">Monaco</option>
                                <option value="Pays-Bas">Pays-Bas</option>
                                <option value="Portugal">Portugal</option>
                                <option value="Royaume-Unis">Royaume-Unis</option>
                                <option value="Suisse">Suisse</option>
                            </optgroup>
                        </select>
                        </div>
                    </fieldset>
                    <div class="row">
                    <div class="col-sm-2">
                        </div>
                    </div>
                    <div class="col-5">
                        <fieldset>
                            <legend>Nous vous écoutons...</legend>
                            <h2>Vos commentaires</h2>
                            <p>
                                <label class="control-label float-right" for="csujet">sujet</label>
                                <input class="form-control float-right" type="text" name="sujet" id="csujet" placeholder="Entrez votre sujet ici ..." size=60 maxlength="60"/>
                                <br/>
                                <label class="control-label float-right" for="cta">Indiquez ici toutes vos remarques </label> 
                                <br/>
                                <textarea name="textar" id="cta" placeholder="Tapez ici votre méssage" rows="10" cols="60"> </textarea>
                            </p>
                        </fieldset>
                        <fieldset>
                            <legend class="float-right">Envoi</legend>
                            <label class="control-label center">Validez votre formulaire ?</label>
                            <input class="btn btn-primary center" type="submit" value="Envoyer"/>
                            <br><br><br><br>
                            <label class="control-label center">Effacez tout le formulaire</label>
                            <input class="btn btn-warning center" type="reset" value="Reset"/>
                        </fieldset>   
                        </main>    
                    </div>
                    </div>
                    </div>
                    </body>
                    </html>
                    <?PHP
                    require "../template/footer.php";
                    require "../lib/inscription.php";
                    require "../lib/seconnecter.php";
                    ?>
