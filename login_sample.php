<style>
.error {color: #FF0000;}
</style>

<?php
	
	// ВСЕ ОШИБКИ ИДУТ СЮДА, И ЕЩЕ В 2 ОПРЕДЕЛЕННЫХ МЕСТА ВНИЗУ.
	$regpassword = "";
	$password_error = "";
	$password = "";
	
	$regemail = "";
	$email_error = "";
	$email = "";
	 
	
	// ПРОВЕРЯЕМ НАЖАЛ ЛИ КТО КНОПКУ СЛ
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
		if(isset($_POST["login"])){
		
		//echo "ktonibuty nazhimal knopku";
		//======================================================================================
		//===================LOGI SISSE ========================================================
		//======================================================================================
		//======================================================================================
		//ПОЧТА ПУСТАЯ ИЛИ НЕТ.===============================================================
		//======================================================================================
		if(isset($_POST["login"])){
			if ( empty($_POST["email"]) ) {
				$email_error = "See väli on kohustuslik";
			}else{
        // puhastame muutuja võimalikest üleliigsetest sümbolitest
				$email = cleanInput($_POST["email"]);
			}
			if ( empty($_POST["password"]) ) {
				$password_error = "See väli on kohustuslik";
			}else{
				$password = cleanInput($_POST["password"]);
			}
      // Kui oleme siia jõudnud, võime kasutaja sisse logida
			if($password_error == "" && $email_error == ""){
				echo "Võib sisse logida! Kasutajanimi on ".$email." ja parool on ".$password;
			}
		} // login if end
		
		// REGISTREERIMINE KASUTAJA =====================================================
	if(isset($_POST["create"])){
		
			if ( empty($_POST["create_email"]) ) {
				$email_error = "See väli on kohustuslik";
			}else{
				$regemail = cleanInput($_POST["create_email"]);
			}
			if ( empty($_POST["create_password"]) ) {
				$$password_error = "See väli on kohustuslik";
			} else {
				if(strlen($_POST["create_password"]) < 8) {
					$$password_error = "Peab olema vähemalt 8 tähemärki pikk!";
				}else{
					$regpassword = cleanInput($_POST["create_password"]);
				}
			}
			if(	$create_email_error == "" && $create_password_error == ""){
				echo "Võib kasutajat luua! Kasutajanimi on ".$regemail." ja parool on ".$regpassword;
      }
    } // create if end
	}
	}
	// funktsioon, mis eemaldab kõikvõimaliku üleliigse tekstist
	function cleanInput($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;	
	}
?>



<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>
 
		<h2>Log in</h2>
		<form action="login.php" method="post" >
			<input name="email" type="email" placeholder="E-post"> <?php echo $email_error; ?><br><br>
			<input name="password" type="password" placeholder="Parool"> <?php echo $password_error; ?> <br><br>
			<input name="login" type="submit" value="Login">
		</form> 
	
		<h2>Create user</h2>
		<form action="login.php" method="post">
			<input name="regemail" type="email" placeholder="email" > <?php echo $email_error; ?><?php echo $regemail; ?><br><br>
			<input name="regpassword" type="password" placeholder="passi" > <?php echo $password_error; ?> <?php echo $regpassword; ?><br><br>
			IF YOU WANT TO COMMENT THIS SITE, SO TRY IT <br><br>
			<textarea name="comment" rows="5" cols="40"></textarea><br><br>
			kas teil meeldib?<input type="radio" name="gender" value="female">Jah
			<input type="radio" name="gender" value="male">Ei <br><br>
			<input name="create" type="submit" value="create user" > <br><br>	
		</form>
	<body>
	<html>