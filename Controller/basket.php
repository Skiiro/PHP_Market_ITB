<?php

include './../Model/basket.php';
include 'header.php';
include './../Model/bdd.php';
include './../Model/ErrorCode.php';

//TWIG
require './../vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('./../view');
$twig = new Twig_Environment($loader);

$bdd = new bdd();
$products = null;
$productsBasket = null;
$total = 0;

if(isset($_POST['deleteButton']))
{

    if($_SESSION['nickname'])
    {
        echo $_POST['deleteButton'];
        $bdd->deleteBasketProduct($_POST['deleteButton'], $_SESSION['nickname'], 1);
    }
    else
    {
        $_SESSION['basket']->deleteProduct($_POST['deleteButton'], 1);
    }
}
else if(isset($_POST['deleteAllButton']))
{
    if($_SESSION['nickname'])
    {
        $bdd->deleteBasketProduct($_POST['deleteAllButton'], $_SESSION['nickname'], 8000);
    }
    else
    {
        $_SESSION['basket']->deleteAllQuantityOfProduct($_POST['deleteAllButton']);
    }
}

if(isset($_SESSION['nickname']))
{
    $bddBasket = $bdd->getBasket($_SESSION['nickname']);
    foreach ($bddBasket as $product)
    {
        $products[$product['Id_Produit']] = $product['Quantity'];
    }
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
    $total = $total + $produit[0]["Prix"]*$quantity;
    $i+=1;
}

if(isset($_POST['buy']))
{
    if(isset($_SESSION['nickname']))
    {
        $produits = null;
        $i=0;
        $y=0;
        foreach($productsBasket as $prod)
        {
            echo $prod['quantity'].PHP_EOL;
            for($i=0; $i<$prod['quantity']; $i++)
            {
                echo $i.PHP_EOL;
                $produits[$i+$y] = $prod["Id"];
            }
            $y += $i;
        }
        $bdd->createBill($_SESSION['nickname'], $produits);
        $bdd->deleteBasket($_SESSION['nickname']);
        echo $twig->render('confirmation.html', array(
        ));
    }
    else
    {
        echo $twig->render('basket.html', array(
            'product' => $productsBasket,
            'total' => $total,
            'Error' => BAD_LOGIN
        ));
    }
}
else
{
    echo $twig->render('basket.html', array(
        'product' => $productsBasket,
        'total' => $total,
        'Error' => NO_PROBLEM
    ));
}


include 'footer.php';