<!DOCTYPE html>
<div class="form-style-5">
    <form method="post" action="index.php?action=<?php echo $z; ?>&controller=utilisateur">
        <fieldset>
            <span class ="titreform"><legend><?php echo $b; ?></legend></span>
            <p>
                <label for="login">Login</label> 
                <input type="text" name="login" id="login_id" value = "<?php echo $l; ?>" required/>
            </p>
            <p>
                <label for="login">Nom</label> 
                <input type="text" name="nom" id="nom_id" value = "<?php echo $n; ?>" required/>
            </p>
            <p>
                <label for="login">Prenom</label> 
                <input type="text" name="prenom" id="prenom_id" value = "<?php echo $p; ?>" required/>
            </p>
            <p>
                <label for="login">E-mail</label> 
                <input type="email" name="email" id="mail_id "value = "<?php echo $m; ?>" required/>
            </p>
            <p>
                <label for="login">Mot de Passe</label> 
                <input type="password" name="password" id="password_id" required/>
            </p>
            <p>
                <label for="login">Confirmer mot de passe</label> 
                <input type="password" name="confirmpass" id="pass_id" required/>
            </p>
            <input type="hidden" name = "exlogin" value =<?php echo $l; ?> /> 
            <?php
            if ($z == 'updated') {

                if ($_SESSION['admin'] == '1') {
                    echo'<input type="radio" name="admin" value="1" id="admin" required/> <label for="admin">Admin</label><br />
                         <input type="radio" name="admin" value="0" id="admin2" required/> <label for="admin2">Utilisateur</label><br />';

                }
            }
            ?>


            <p>
                <input type="submit" value="Envoyer" />
            </p>
        </fieldset> 
    </form>
</div>
