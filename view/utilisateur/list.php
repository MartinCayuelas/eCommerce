
<?php

foreach($tab_i as $i){
    echo '<p>  Utilisateur :  ';
    echo '<a HREF = "index.php?action=read&login=' . $i->getLogin() .
    '&controller=utilisateur">'.$i->getLogin().'</a>';
    echo' <a class="delete" HREF = "index.php?action=delete&login='. $i->getLogin(). '&controller=utilisateur"> supprimer</a>';
    
}
echo '<br>';
echo '<br>';
echo ' <a class="create" HREF = index.php?action=inscription&controller=utilisateur> Créer un Utilisateur </a>';



