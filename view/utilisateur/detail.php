 
<?php

$loginHTML = htmlspecialchars($v->getLogin());
$nomHTML = htmlspecialchars($v->getNom());
$prenomHTML = htmlspecialchars($v->getPrenom());
$mailHTML = htmlspecialchars($v->getMail());



echo <<<EOF

 <p class="infoUtilisateur"> 
  Informations personnelles :  
 </p>
<div class="info">
 <p>    
    <span class="titreinfo">Login :</span>   $loginHTML
 </p>
 <p> 
    <span class="titreinfo">Nom: </span>  $nomHTML
        
        
        
        
 <p>  
   <span class="titreinfo">Prénom:  </span> $prenomHTML
 </p>
 <p>
    <span class="titreinfo">e-mail : </span> $mailHTML
 </p>
   </div>
        <form action = "index.php?action=update&controller=utilisateur" method = "POST">
        <input type="hidden" name="login" value=$loginHTML />
        <input type="hidden" name="nom" value=$nomHTML />
        <input type="hidden" name="prenom" value=$prenomHTML />
        <input type="hidden" name="mail" value=$mailHTML />
        
    <div class = "Option">
       <a class ="create" href="index.php?action=readAllCommandes&controller=commande"> Mes commandes</a>
    <button type = "submit">Mettre à jour</button>
    </div>
        
      

EOF;

