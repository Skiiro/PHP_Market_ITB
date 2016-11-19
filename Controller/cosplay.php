<?php

include 'header.php';
include './../Model/bdd.php';

//TWIG
require './../vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('./../view');
$twig = new Twig_Environment($loader);

$bdd = new bdd();
$productWeapons = $bdd->getProductByCategory($bdd->getCategoryProductByName("Cosplay")[0]["Id"]);

echo $twig->render('Product.html', array(
    'type' => "Cosplay",
    'product' => $productWeapons
));

include 'footer.php';