<?php
$s = $model->getModele();
unlink ("/images/upload/$s"); 
echo 'La suppression a été executé avec succès';