<?php include "header.php"; ?>

<?php
if(!isset($_SESSION["login"]) or $_SESSION["login"] != "admin") {header("Location: login.php"); exit(0);}
 
  if(isset($_GET["art"])) {
    //Pripojeni k databazi
    include "connect.php";
    $conn = new mysqli($db_server, $db_login, $db_password, $db_name);
    $conn->set_charset("utf8") or die ("koding");
     
    $sql = "SELECT * FROM articles WHERE id_art = " . $_GET["art"] . ";";
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $row = mysqli_fetch_array($res);
    
    $conn->close();
    
    $label = "Upravit";        
  }
  
  if(!isset($label)) {$label = "Vytvořit";} 
?>
                                         
  <h1>EDITOR</h1>
  <form action="s_edit.php<?php if(isset($_GET["art"])){echo "?art=" . $_GET["art"];}?>" method="post">
    Titulek: <input type="text" name="title" value="<?php if(isset($_GET["art"])) {echo $row["title"];}?>"><br>
    Obsah: <textarea rows="5" cols="60" name="content" maxlength="500" placeholder="Obsah" required><?php if(isset($_GET["art"])) {echo $row["content"];}?></textarea><br>
    <input type="submit" name="edit" value="<?php echo $label;?>">
  </form>   

<?php include "footer.php";?>