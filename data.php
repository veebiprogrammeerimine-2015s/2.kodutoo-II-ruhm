<?php
	require_once("functions.php");
	require_once("header.php");
	if(!isset($_SESSION["id_from_db"])){
		header("Location: login.php");
	}
	
	if(isset($_GET["logout"])){
		session_destroy();
		
		header("Location: login.php");
	}
	
?>

<p>
	Tere, <?=$_SESSION["user_email"];?>  <li><a href="?logout=1"> Logi välja</a></li> 
</p>

<p>
	Minu tabelid <a href="tables.txt"> siin</a>
</p>

<?php require_once("menu.php"); ?>


