<?php include "header.php";?>

<?php if(!isset($_SESSION["login"])) {header("Location: index.php"); exit(0);}?>

<center><h1>Změna hesla</h1></center>

  <center>
<?php 
    if(isset($_SESSION["cp_err"])) {
      echo $_SESSION["cp_err"];
      unset($_SESSION["cp_err"]);
    }
?>  
    <form method="POST" action="s_change_pass.php">                    
      Staré heslo <input type="password" name="pass_old" required></p>
      Nové heslo  <input type="password" name="pass_new" required></p>
      <input type="submit" name="SUBMIT">
    </form>
  </center>

<?php include "footer.php";?>		