<?php
include './../Model/basket.php';
include 'header.php';
include './../Model/bdd.php';
include './../Model/ErrorCode.php';


require './../vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('./../view');
$twig = new Twig_Environment($loader);

$bdd = new bdd();

if(isset($_POST['monBouton'])) //Atempt to login
{
    if(!empty($_POST['nickname']) and !empty($_POST['password'])) //Check if all parameters is fill
    {
        if($bdd->checkLogin($_POST['nickname'], $_POST['password']))
        {
            $_SESSION['nickname'] = $_POST['nickname'];
            if(isset($_SESSION['basket']))
            {
                $basket = $_SESSION['basket'];
                $basket->sendToBDD($_SESSION['nickname']);
                unset($_SESSION['basket']);
            }
            header("Location: ./home.php");
        }
        else
        {
            echo $twig->render('login.html', array(
                'Error' => INCORECT_LOGIN
            ));
        }
    }
    else
    {
        echo $twig->render('login.html', array(
            'Error' => BAD_FIELD
        ));
    }
}
else
{
    echo $twig->render('login.html', array(
        'Error' => NO_PROBLEM
    ));
}




include 'footer.php';