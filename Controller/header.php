<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Market</title>

    <link rel="stylesheet" type="text/css" href="../semantic/dist/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="./../Style/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <div id="haut" class="ui top fixed large wide menu my-navbar">
        <a class="item" onclick=document.location.href='http://localhost/market' ">
            Home
        </a>
        <a class="item" onclick=document.location.href='http://localhost/market/Controller/Weapons.php'>
            Weapons
        </a>
        <a class="item" onclick=document.location.href='http://localhost/market/Controller/cosplay.php'>
            Cosplay
        </a>
        <div class="right menu">
            <a class="item" onclick=document.location.href='http://localhost/market/Controller/basket.php'>
                Basket
            </a>
            <div class="ui pointing dropdown link item">
                <span class="text">
        <?php
            session_start();
            if(empty($_SESSION['nickname']))
            {
                echo "Login </span>
                      <i class=\"dropdown icon\"></i>
                      <div class=\"menu\">
                          <div class=\"item\" onclick=document.location.href='http://localhost/market/Controller/Login.php'>Sign in</div> <!--Se connecter-->
                         <div class=\"item\" onclick=document.location.href='http://localhost/market/Controller/SignUp.php'>Sign up</div> <!--S'enregistrer-->
                     </div>
                    ";
            }
            else
            {
                echo $_SESSION['nickname'];
                echo "</span>
                      <i class=\"dropdown icon\"></i>
                      <div class=\"menu\">";
                echo "<div class=\"item\" onclick=document.location.href='http://localhost/market/Controller/myAccount.php'>Change password</div>
                      <div class=\"item\" onclick=document.location.href='http://localhost/market/Controller/order.php'>Orders</div>
                      <div class=\"item\" onclick=document.location.href='http://localhost/market/Controller/logout.php'>Logout</div>
                      </div></div>";
                if($_SESSION['nickname'] == "admin")
                {
                    echo '<div class="ui pointing dropdown link item">
                          <span class="text">Administration</span>
                      <i class="dropdown icon"></i>
                      <div class="menu">
                          <div class="item" onclick=document.location.href=\'http://localhost/market/Controller/users.php\'>User</div>
                          <div class="item" onclick=document.location.href=\'http://localhost/market/Controller/product.php\'>Product</div> 
                     </div></div>';
                }
            }
        ?>
            </div>
        </div>
    </div>
