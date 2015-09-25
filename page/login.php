<?php
	// ühenduse loomiseks kasuta
	require_once("../../config.php");
	$database = "if15_karilaid";
	$mysqli = new mysqli($servername, $username, $password, $database);
	
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
			}else{
				$email = cleanInput($_POST["email"]);
			
		}
				if ( empty($_POST["pass"])) {
			
					$password_error = "See väli on kohustuslik";
				}else{
					$pass = cleanInput($_POST["pass"]);
			
		}	
				if($password_error == "" && $email_error == ""){
				
					echo "Võib sisse logida! Kasutajanimi on ".$email." ja parool on ".$password;
			}		
						//KASUTAJA LOOMINE
		} elseif(isset($_POST["create"])){
					if ( empty($_POST["mail"])) {
			
						$mail_error = "See väli on kohustuslik";
			
			
		}
					if ( empty($_POST["password"])) {
			
						$pass_error = "See väli on kohustuslik";
			
			
		}
					if ( empty($_POST["confirm_password"])) {

							$passc_error = "See väli on kohustuslik";

					} else {

					if ($_POST["password"] == $_POST["confirm_password"]) {
						
							$password_right = "Paroolid klapivad";
					} else {
						
							$password_fail = "Paroolid ei klapi.";
    }

}
		}
		
	function cleanInput($data) {
  	$data = trim($data);
  	$data = stripslashes($data);
  	$data = htmlspecialchars($data);
  	return $data;
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
