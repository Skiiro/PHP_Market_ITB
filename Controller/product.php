<?php

include 'header.php';
include './../Model/bdd.php';
include './../Model/ErrorCode.php';

//TWIG
require './../vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('./../view');
$twig = new Twig_Environment($loader);

$bdd = new bdd();
$Product = $bdd->getProducts();

if(isset($_POST['editButton']))
{
    echo $twig->render('form.html', array(
        'Type' => "Product",
        'Action' => "edit",
        'values' => $bdd->getProduct($_POST['editButton'])[0]
    ));
}
else if(isset($_POST['add']))
{
    echo $twig->render('form.html', array(
        'Type' => "Product",
        'Action' => "new",
    ));
}
else if(isset($_POST['deleteButton']))
{
    $bdd->deleteProduct($_POST['deleteButton']);
    $Product = $bdd->getProducts();
    echo $twig->render('admin.html', array(
        'Type' => "Product",
        'values' => $Product
    ));
}
else if(isset($_POST['boutonNew']))
{
    $bdd->createProduct($_POST['name'], $_POST['price'], "none", $_POST['description'], $_POST['category']);
    $Product = $bdd->getProducts();
    echo $twig->render('admin.html', array(
        'Type' => "Product",
        'values' => $Product
    ));
}
else if(isset($_POST['boutonEdit']))
{
    $editProduct = $bdd->getProduct($_POST['boutonEdit']);
    $bdd->updateProduct($_POST['boutonEdit'],$_POST['name'], $_POST['price'], $editProduct[0]['Image'], $_POST['description']);
    $Product = $bdd->getProducts();
    echo $twig->render('admin.html', array(
        'Type' => "Product",
        'values' => $Product
    ));
}
else
{
    echo $twig->render('admin.html', array(
        'Type' => "Product",
        'values' => $Product
    ));
}


include 'footer.php';