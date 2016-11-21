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
    <link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

    <div id="haut" class="ui top fixed wide menu my-navbar">
        <a class="item" onclick=document.location.href='http://localhost/market' ">
            Home
        </a>
        <a class="item" onclick=document.location.href='http://localhost/market/Controller/Weapons.php'>
            Weapons
        </a>
        <a class="item" onclick=document.location.href='http://localhost/market/Controller/cosplay.php'>
            Cosplay
        </a>
        <?php
            session_start();
            if(empty($_SESSION['nickname']))
            {
                echo "<div class=\"right menu\">
                 <div class=\"ui pointing dropdown link item\">
                       <span class=\"text\">Login</span>
                      <i class=\"dropdown icon\"></i>
                      <div class=\"menu\">
                          <div class=\"item\" onclick=document.location.href='http://localhost/market/Controller/Login.php'>Sign in</div> <!--Se connecter-->
                         <div class=\"item\">Sign up</div> <!--S'enregistrer-->
                     </div>
                    </div>
                </div>";
            }
            else
            {
                echo "<div class=\"right menu\">
                    <a class=\"item\">";
                echo $_SESSION['nickname'];
                echo "</a>";
            }
        ?>
    </div>
