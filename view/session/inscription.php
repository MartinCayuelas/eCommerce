
<form method="post" action="index.php?action=created&controller=produit">
    <fieldset>
        <legend>Inscription</legend>
        <p>
            <label for="log_id">Login</label> :
            <input type="text" placeholder="login" name="login" id="log_id" required/>
        </p>
        <p>
            <label for="nom_id">Nom</label> :
            <input type=text" placeholder="nom" name="nom" id="nom_id" required/>
        </p>
        <p>
            <label for="prenom_id">Prenom</label> :
            <input type="text" name="prenom" id="prenom_id" required/>
        </p>
        <p>
            <label for="email_id">Adresse mail</label> :
            <input type="mail" name="email" id="email_id" required/>
        </p>
        <p>
            <label for="mdp_id">Mot de passe</label> :
            <input type="password" name="mdp" id="mdp_id" required/>
        </p>
        <p>
            <input type="submit" value="S'inscrire" />
        </p>
    </fieldset> 
