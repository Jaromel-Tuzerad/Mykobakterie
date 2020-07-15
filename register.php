<?php include "header.php";?>

<?php if(isset($_SESSION["login"])) {header("Location: index.php"); exit;}?>   

<form action="s_register.php" class="box" method="post">
  <h1 class="logo">Registrace</h1> 
  
  <?php if(isset($_SESSION["nickname_err"])) {echo $_SESSION["nickname_err"]; unset($_SESSION["nickname_err"]);}?>
  <input type="text" name="nickname" placeholder="Uživatelské jméno" value="<?php if(isset($_SESSION["nickname"])) {echo $_SESSION["nickname"]; unset($_SESSION["nickname"]);}?>" required></p>
  <?php if(isset($_SESSION["password_err"])) {echo $_SESSION["password_err"]; unset($_SESSION["password_err"]);}?>
  <input type="password" name="password" placeholder="Heslo" required></p>  
  <input type="password" name="pass_again" placeholder="Heslo znovu" required></p>
  <?php if(isset($_SESSION["email_err"])) {echo $_SESSION["email_err"]; unset($_SESSION["email_err"]);}?> 
  <input type="email" name="email" placeholder="Email" value="<?php if(isset($_SESSION["email"])) {echo $_SESSION["email"]; unset($_SESSION["email"]);}?>" required></p> 
  <input type="submit" name="submit" value="Zaregistrovat se"> 
</form>
</center>

<?php include "footer.php";?>