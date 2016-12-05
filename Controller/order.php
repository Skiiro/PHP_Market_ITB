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
    $products = $bdd->getDetailsBill($_POST['OK']);
    $i=0;
    foreach($products as $product)
    {
        $product["Id_Produit"] = $bdd->getProduct($product["Id_Produit"])[0]['Nom'];
        $products[$i] = $product;
        $i+=1;
    }

    echo $twig->render('orderDetails.html', array(
        'order' => $products
    ));

}
else
{
    $bills = $bdd->getBills($_SESSION['nickname']);
    $i=0;
    foreach($bills as $bill)
    {
        $products = $bdd->getDetailsBill($bill['Id']);
        $total = 0;
        foreach($products as $product)
        {
            $total += $bdd->getProduct($product["Id_Produit"])[0]['Prix'] * $product['Quantity'];
        }
        $bill['Price'] = $total;
        $bills[$i] = $bill;
        $i+=1;
    }
    echo $twig->render('order.html', array(
        'order' => $bills
    ));
}


include 'footer.php';