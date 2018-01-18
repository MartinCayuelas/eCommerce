<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="./css/styles.css" />

        <title><?php echo $pagetitle; ?></title>
    </head>
    <body>
        <header class="header">
             <a  href="index.php?controller=produit"><img alt="logoP" class="logo-bandeau" src="./images/logo.png" onmouseover="this.src = './images/logo2.png';" onmouseout="this.src = './images/logo.png';"/></a>
    </header>

        <?php
        
        if (isset($_SESSION['admin']) == false){
            $_SESSION['admin'] = NULL;
        }
        if ($_SESSION != NULL and $_SESSION['admin'] != NULL /*&& $_SESSION['admin'] == '0'*/) {            

            if($_SESSION['admin'] == '0'){
            
                $login = $_SESSION['login'];
                echo <<<EOF
                <div class = "menu">

                    <a class="text" href="index.php?action=readAllImprimantes&controller=imprimante">Imprimantes</a>
                    <a class="text" href="index.php?action=readAll&controller=produit">Produits</a>
                    <a class="text"  href="index.php?action=readAll&controller=panier">Panier</a>       
                    <a class="text"  href="index.php?action=read&login=$login&controller=utilisateur">Profil</a>
                    <a class="text"  href="index.php?action=deconnect&controller=utilisateur">Deconnexion</a>

                </div>
            
        
EOF;
            
            } else if (/*$_SESSION != NULL && $_SESSION['admin'] != NULL &&*/ $_SESSION['admin'] == '1') {

                $login = $_SESSION['login'];
                echo <<<EOF

                <div class = "menu">

                    <a class="text" href="index.php?action=readAllImprimantes&controller=imprimante">Imprimantes</a>
                    <a class="text" href="index.php?action=readAll&controller=produit">Produits</a>
                    <a class="text" href="index.php?action=readAllUtilisateurs&controller=utilisateur">Utilisateurs</a>
                    <a class="text" href="index.php?action=readAll&controller=panier">Panier</a>
                    <a class="text" href="index.php?action=deconnect&controller=utilisateur">Deconnexion</a>

                </div>
            
             
EOF;
            
            }
        } else {
            echo <<<EOF
            <div class = "menu">
            <a class="text" href="index.php?action=readAllImprimantes&controller=imprimante">Imprimantes</a>
            <a class="text" href="index.php?action=readAll&controller=produit">Produits</a>   
            <a class="text"  href="index.php?action=readAll&controller=panier">Panier</a> 
            <a class="text"  href="index.php?action=connect&controller=utilisateur">Connexion</a>
            <a class="text"  href="index.php?action=inscription&controller=utilisateur">S'inscrire</a>
              </div>
EOF;
        }
        ?>

        <header> 


        </header>


<?php
$filepath = File::build_path(array("view", $controller, "$view.php"));
require $filepath;
?>





        <footer class="footer">
            <a href="https://fr-fr.facebook.com/"> <img class="TWFB" src="./images/facebook1.png" onmouseover="this.src = './images/facebook2.png';" onmouseout="this.src = './images/facebook1.png';" alt="Facebook"/></a>
            <p> FoodPrinter corporation </p>
        </footer>
    </body>
</html>


