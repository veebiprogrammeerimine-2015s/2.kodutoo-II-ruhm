<?php
	require_once("functions.php");
	
	//kontrollin, kas kasutaja ei ole sisseloginud
	if(!isset($_SESSION["id_from_db"])){
		// suunan login lehele
		header("Location: login.php");
	}
	
	//login välja, aadressireal on ?logout=1
	if(isset($_GET["logout"])){
		//kustutab kõik sessiooni muutujad
		session_destroy();
		
		header("Location: login.php");
		
	}
?>

<H1>
	Tere, <?=$_SESSION["user_email"];?>
	<a href="?logout=1"> Logi välja</a> <br>
</H1>
<H2>
	Sinu ID on <?=$_SESSION["id_from_db"];?> <br>
	Parool hash on 	<?=$_SESSION["password"];?>
</H2>

