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
	Tere, <?=$_SESSION["user_email"];?>  <li><a href="?logout=1"> Logi v�lja</a></li> 
</p>

<p>
	Minu tabelid <a href="tables.txt"> siin</a>
</p>



<!DOCTYPE html>
<html>
<h1>Vot, oled sisselogitud</h1>
<p>hello, noh.</p>

</body>
</html>

<?php require_once("menu.php"); ?>