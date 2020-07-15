<?php include "header.php";?>

<center><h1>Změna emailu</h1></center>
<?php
if(!isset($_SESSION["login"])) {header("Location: index.php"); exit(0);}   
?>
<center>
<?php 
  if(isset($_SESSION["cm_err"])) {
  echo $_SESSION["cm_err"];
  unset($_SESSION["cm_err"]);
  }
?>  
  <form method="POST" action="s_change_mail.php">                    
    Novy email  <input type="email" name="email_new" required></p>
    <input type="submit" name="SUBMIT">
  </form>
</center>

<?php include "footer.php";?>
