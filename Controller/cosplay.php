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
$productWeapons = $bdd->getProductByCategory($bdd->getCategoryProductByName("Cosplay")[0]["Id"]);

$BDDError = false;

if(isset($_POST['basket'])) //add product to the basket
{
    if($_POST['quantity'] == "")
        $_POST['quantity'] = 1;
    if(isset($_SESSION['nickname']))
    {
        for($i=0; $i<$_POST['quantity']; $i++)
        {
            if(!$bdd->insertBasket($_SESSION['nickname'], $_POST['basket']))
            {
                $BDDError = true;
            }
        }
        if($BDDError == false)
        {
            echo $twig->render('Product.html', array(
                'type' => "Cosplay",
                'product' => $productWeapons,
                'Error' => NO_BDD_ERROR
            ));
        }
        else
        {
            echo $twig->render('Product.html', array(
                'type' => "Cosplay",
                'product' => $productWeapons,
                'Error' => BDD_ERROR
            ));
        }
    }
    else
    {
        $return;

        if(isset($_SESSION['basket'])) //User already have a basket
        {
            $basket = $_SESSION['basket'];
            $return = $basket->addProduct($_POST['basket'], $_POST['quantity']);

        }
        else
        {
            $basket = new basket();
            $return = $basket->addProduct($_POST['basket'], $_POST['quantity']);
            $_SESSION['basket'] = $basket;
        }
        if($return == NO_PROBLEM)
            $return = NO_BDD_ERROR; //To display a message about the successfull of the add to the basket
        echo $twig->render('Product.html', array(
            'type' => "Cosplay",
            'product' => $productWeapons,
            'Error' => $return
        ));
    }
}
else
{
    echo $twig->render('Product.html', array(
        'type' => "Cosplay",
        'product' => $productWeapons,
        'Error' => NO_PROBLEM
    ));
}

include 'footer.php';