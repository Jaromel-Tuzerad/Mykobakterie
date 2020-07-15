<?php include "header.php";?> 

<?php if(isset($_SESSION["login"])) {header("Location: index.php"); exit;}?> 
   
<div class="logbody">
  <div class="container">
    <div class="units-row">    
    <form class="box" method="POST" action="s_login.php">
      <h1 class="logo">Přihlášení</h1>
<?php
        if(isset($_SESSION["login_err"])) {
            echo $_SESSION["login_err"];
            unset($_SESSION["login_err"]);
        }
?>
      <input type="text" name="nickname" placeholder="Uživatelské jméno" required>
      <input type="password" name="password" placeholder="Heslo" required>
      <input type="submit" name="submit" value="Přihlásit">
    </form>
    
    </div>
  </div>
</div>

<?php include "footer.php";?>				