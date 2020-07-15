<!DOCTYPE HTML>
<html lang="cs">
  <head>
    <title>MykoTesting</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="css/kube.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/custom.min.css" />
    <link rel="shortcut icon" href="img/favicon.png" />
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <!--<link rel="stylesheet" type="text/css" href="css/css2.css">-->
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
    <!-- NAVIGATION -->
    <div class="main-nav">
      <div class="container">
        <header class="group top-nav">
          <nav class="navbar logo-w navbar-left" >
              <a class="logo" href="index.php">Mykobakterie <sup>testing<sup></a>
          </nav>
          <div class="navigation-toggle" data-tools="navigation-toggle" data-target="#navbar-1">
              <span class="logo">Menu</span>
          </div>
          <nav id="navbar-1" class="navbar item-nav navbar-right">
             
<?php
            session_start();
            ob_start();
            
            if(isset($_SESSION["login"])) {
            
              //Login as admin
              if($_SESSION["login"]=="admin") {
?>
                <ul>
                  <li><a href="order.php">Objednávky</a></li>
                  <li><a href="editor.php">Editor</a></li>
                  <li><a href="account.php">Účet</a></li>
                  <li><a href="add_record.php">Přidat záznam</a></li>
                  
                  <ul>
                      <li>Přihlášen jako: <strong><?php echo $_SESSION["login"] ?></strong></li>
                  </ul>
                  
                  <li><a href="s_logout.php">Odhlášení</a></li>
                </ul>
<?php
              }
              
              //Login as non-admin
              else {
?>        
                <ul>
                  <li><a href="order.php">Objednávky</a></li>
                  <li><a href="account.php">Účet</a></li>
                  
                  <ul>
                      <li class="li"> Přihlášen jako: <strong><?php echo $_SESSION["login"] ?></strong></li>
                  </ul>
                  
                  <li><a href="s_logout.php">Odhlášení</a></li>
                </ul>
<?php
              }
            }
              
            else {
            
              //No login
?>            <ul>
                <li><a href="order.php">Objednávky</a></li>
                <li><a href="login.php">Přihlášení</a></li>
                <li><a href="register.php">Registrace</a></li>
              </ul>
<?php
            }
?>
               
          </nav>
        </header>
      </div>
    </div>
    
<!-- CONTENT -->
