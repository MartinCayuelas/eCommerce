<?php

if(isset($_SESSION['login'])){
    $log = $_SESSION['login'];
    echo'<span class="msgAc">Bienvenue '.$log.'!</span>';
}
echo <<<EOF

    <img alt="logoP" class="logo" src="./images/logo_1.png">
 <h3 class= "titreform">Laissez-vous surprendre par cette innovation :La  <span class="nom_produit">3D FoodPrinter</span></h3>
    <video id="presentation-video" src="./images/Video1.mp4"  autoplay loop ></video>
EOF;
