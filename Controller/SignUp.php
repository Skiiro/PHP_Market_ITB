<?php

include 'header.php';
include './../Model/bdd.php';
include './../Model/ErrorCode.php';

//TWIG
require './../vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('./../view');
$twig = new Twig_Environment($loader);

$bdd = new bdd();

if(isset($_POST['buttonSubmit'])) //Attempt to login
{
    if(!empty($_POST['nickname']) and !empty($_POST['password']) and !empty($_POST['email']) and !empty($_POST['firstname']) and !empty($_POST['lastname']) and !empty($_POST['address']) and !empty($_POST['country'])) //Check if all parameters is fill
    {

        if(isset($bdd->getUser($_POST['nickname'])[0])) //User already exist
        {

            echo $twig->render('SignUp.html', array(
                'Error' => BAD_NICKNAME
            ));
        }
        else
        {

            if($bdd->createUser($_POST['nickname'], $_POST['password'], $_POST['lastname'], $_POST['firstname'], $_POST['number']." ".$_POST['address']." ".$_POST['country'], $_POST['email'])) //Creation complete
            {
                echo $twig->render('SignUp.html', array(
                    'Error' => NO_BDD_ERROR
                ));
            }
            else
            {
                echo $twig->render('SignUp.html', array(
                    'Error' => BDD_ERROR
                ));
            }
        }

    }
    else
    {
        echo $twig->render('SignUp.html', array(
            'Error' => BAD_FIELD
        ));
    }
}
else
{
    echo $twig->render('SignUp.html', array(
        'Error' => NO_PROBLEM
    ));
}

include 'footer.php';