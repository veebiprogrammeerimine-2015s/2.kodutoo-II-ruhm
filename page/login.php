<?php

	$email_error = "";
	$password_error = "";
	$password_fail = "";
	$password_right = "";
	$mail_error = "";
	$pass_error = "";
	$passc_error = "";
	
	
	
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
		//LOGIN NUPP
		//Mis nuppu vajutati
		if(isset($_POST["login"])){
				if ( empty($_POST["email"])) {
			
					$email_error = "See väli on kohustuslik";
			
			
		}
				if ( empty($_POST["pass"])) {
			
					$password_error = "See väli on kohustuslik";
			
			
		}			//KASUTAJA LOOMINE
		} elseif(isset($_POST["create"])){
					if ( empty($_POST["mail"])) {
			
						$mail_error = "See väli on kohustuslik";
			
			
		}
					if ( empty($_POST["password"])) {
			
						$pass_error = "See väli on kohustuslik";
			
			
		}
					if ( empty($_POST["confirm_password"])) {
			
						$passc_error = "See väli on kohustuslik";
			
			
		}
		
					if ($_POST["password"] == $_POST["confirm_password"]) {
						$password_right = "Paroolid klapivadss";
		
		
}
					else {
						$password_fail = "Paroolid ei klapi.";
	}
		}
	}
?>

<?php
	$page_title = "Login leht";
	$file_name = "login.php"
?>
<?php require_once("../header.php"); ?>
	<h2>Login</h2>
	<form action="login.php" method="post">
	<input name="email" type="email" placeholder="E-post"> <?php echo $email_error  ?> <br><br>
	<input name="pass" type="password" placeholder="Parool"> <?php echo $password_error  ?><br><br>
	<input name="login" type="submit" value="Logi sisse"> <br><br>
	</form>
	<h2>Kasutaja loomine</h2>
	<form action="login.php" method="post">
	<input name="mail" type="email" placeholder="E-post"><?php echo $mail_error  ?> <br><br> 
	<input name="password" type="password" placeholder="Parool"><?php echo $pass_error  ?> <br><br> 
	<input name="confirm_password" type="password" placeholder="Korda parooli"> <?php echo $password_fail; echo $password_right; echo $passc_error  ?> <br><br>
	<input name="name" type="name" placeholder="Eesnimi"> <br><br>
	<input name="lastname" type="name" placeholder="Perekonnanimi"> <br><br>
	<input name="create" type="submit" value="Loo kasutaja"> <br><br>
	</form>
<?php require_once("../footer.php"); ?>
