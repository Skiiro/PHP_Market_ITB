<?php

include 'header.php';
include './../Model/bdd.php';
include './../Model/ErrorCode.php';

//TWIG
require './../vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('./../view');
$twig = new Twig_Environment($loader);

$bdd = new bdd();
$Users = $bdd->getUsers();

if(isset($_POST['editButton']))
{
    var_dump($bdd->getUser($_POST['editButton'])[0]);
    echo $twig->render('form.html', array(
        'Type' => "Utilisateur",
        'Action' => "edit",
        'values' => $bdd->getUser($_POST['editButton'])[0]
    ));
}
else if(isset($_POST['add']))
{
    echo $twig->render('form.html', array(
        'Type' => "Utilisateur",
        'Action' => "new",
    ));
}
else if(isset($_POST['deleteButton']))
{
    $bdd->deleteUser($_POST['deleteButton']);
    $Users = $bdd->getUsers();
    echo $twig->render('admin.html', array(
        'Type' => "Utilisateur",
        'values' => $Users
    ));
}
else if(isset($_POST['boutonNew']))
{
    $bdd->createUser($_POST['nickname'], $_POST['password'], $_POST['lastname'], $_POST['firstname'], $_POST['number'].$_POST['address'], $_POST['email']);
    $Users = $bdd->getUsers();
    echo $twig->render('admin.html', array(
        'Type' => "Utilisateur",
        'values' => $Users
    ));
}
else if(isset($_POST['boutonEdit']))
{
    $bdd->updateUser($_POST['firstname'], $_POST['lastname'], $_POST['number'].$_POST['address'], $_POST['email'], $_POST['boutonEdit']);
    if($_POST['password'] != "")
    {
        $bdd->setPassword($_POST['boutonEdit'], $_POST['password']);
    }
    $Users = $bdd->getUsers();
    echo $twig->render('admin.html', array(
        'Type' => "Utilisateur",
        'values' => $Users
    ));
}
else
{
    echo $twig->render('admin.html', array(
        'Type' => "Utilisateur",
        'values' => $Users
    ));
}




include 'footer.php';