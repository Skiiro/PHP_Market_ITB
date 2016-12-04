<?php
include './../Model/basket.php';
include 'header.php';
include './../Model/bdd.php';
include './../Model/ErrorCode.php';


require './../vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('./../view');
$twig = new Twig_Environment($loader);

$bdd = new bdd();

if(isset($_POST['OK']))
{
    if($bdd->checkLogin($_SESSION['nickname'], $_POST['oldPassword']))
    {
        if($bdd->setPassword($_SESSION['nickname'], $_POST['password']))
        {
            echo $twig->render('myAccount.html', array(
                'Error' => NO_BDD_ERROR
            ));
        }
        else
        {
            echo $twig->render('myAccount.html', array(
                'Error' => BDD_ERROR
            ));
        }
    }
    else
    {
        echo $twig->render('myAccount.html', array(
            'Error' => BAD_LOGIN
        ));
    }
}
else
{
    echo $twig->render('myAccount.html', array(
        'Error' => NO_PROBLEM
    ));
}

