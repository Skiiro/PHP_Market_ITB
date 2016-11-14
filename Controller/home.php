<?php
include 'header.php';
include './../Model/bdd.php';

require './../vendor/autoload.php';
$loader = new Twig_Loader_Filesystem('./../view');
$twig = new Twig_Environment($loader);



echo $twig->render('home.html', array(
));

include 'footer.php';