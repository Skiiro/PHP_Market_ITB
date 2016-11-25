<?php

include './../Model/basket.php';
include 'header.php';
include './../Model/bdd.php';
include './../Model/ErrorCode.php';


session_start();

//TWIG
require './../vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('./../view');
$twig = new Twig_Environment($loader);

$bdd = new bdd();
$products = "";
$productsBasket = null;

if(isset($_SESSION['nickname']))
{
    $products = $bdd->getBasket($_SESSION['nickname']);
}
else{
    if(isset($_SESSION['basket']))
    {
        $products = $_SESSION['basket']->getProducts();
    }
}

$i = 0;
foreach($products as $id => $quantity)
{
    $produit = $bdd->getProduct($id);
    $produit[0]['quantity'] = $quantity;
    $productsBasket[$i] = $produit[0];
    $i+=1;
}
echo $twig->render('basket.html', array(
        'product' => $productsBasket,
        'Error' => NO_PROBLEM
    ));

include 'footer.php';