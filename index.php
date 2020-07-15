<?php include "header.php";?>

<!-- Introduction -->
<div class="intro">
	<div class="container">
		<div class="units-row">
		    <div class="unit-10">
		    	<img class="img-intro" src="./images/bacteria.png">
		    </div>
		    <div class="unit-90">
		    	<p class="p-intro">Jsme tu proto, abychom pomáhali.</p>
		    </div>
		</div>
	</div>
</div>
<?php

include "connect.php";
$conn = new mysqli($db_server, $db_login, $db_password, $db_name);
$conn->set_charset("utf8") or die ("koding"); 

//Number of articles per page
$art_num = 3;

$articles = mysqli_query($conn, "SELECT * FROM articles ORDER BY timestamp DESC") or die(mysqli_error($conn));

if(isset($_GET["page"])) {
    $ind = $_GET["page"] * $art_num;
}       
else {
  $ind = 0;
  $_GET["page"] = 0;
}

$i = 0;
while($articles->data_seek($ind) and $i<$art_num) {
  $row = $articles->fetch_array();
?>
  
  <!-- Content -->
  <div class="content">
    <div class="container">
    <!-- Post -->
    <div class="post">
      <!-- Heading -->
      <h1><?php echo $row["title"];?></h1>
      <hr>
      <div class="in-content">
        <p><?php echo $row["content"];?></p>
      </div>
      
<?php 
  if(isset($_SESSION["login"]) and $_SESSION["login"] == "admin") {   
    echo "<a class='btn btn-black' href='editor.php?art=" . $row["id_art"] . "'><i>Upravit</i></a>";
    echo "<a class='btn btn-black' href='delete_art.php?art=" . $row["id_art"] . "'><i>Smazat</i></a>";
  } 
?>
    
      <!-- /post -->
    </div>
    </div>
  </div>
<?php
  $ind++;
  $i++;
}
    
    ?>
    <footer>
    <?php
    
    if(($_GET["page"]+1)*$art_num < $articles->num_rows) {
        ?>
            <div class="container">
			      <div class="units-row">
			      <div class="unit-50">
            <?php
             echo "<a class=\"btn btn-black\" href='?page=". ($_GET['page']+1). "'><i class=\"fa fa-arrow-right\"></i>Next</a>";
            ?>
            </div>
		      	</div>
		        </div>
            <?php
    }
    if($_GET["page"] != 0) { 
             ?>
            <div class="container">
			      <div class="units-row">
			      <div class="unit-50">
            <?php
             echo "<a class=\"btn btn-black\" href='?page=". ($_GET['page']-1). "'><i class=\"fa fa-arrow-left\"></i>Previous</a>";
            ?>
            </div>
		      	</div>
		        </div>
            <?php
    } 

$conn->close();    
ob_end_flush();

?>

	</footer>

<?php include "footer.php";?>