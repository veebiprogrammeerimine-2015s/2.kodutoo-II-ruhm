<?php

	$page_title = "Loginleht";
	$file_name = "login.php";


?>
<?php

	// ühenduse loomiseks kasuta
	require_once("/home/pihlakre/public_html/if13/Veebiprog-2015/konfig.php");
	$database = "if13_rene_p";
	$mysqli = new mysqli($servername, $username, $password, $database);
	
	//echo $_POST["username"]; 
	$username_error ="";
	$email_error ="";
	$password_error ="";
	$firstname_error ="";
	$lastname_error ="";
	$tel_error ="";
	$logemail_error ="";
	$logpassword_error ="";
	

	
	
	
	$create_username = "";
	$create_email = "";
	$create_firstname = "";
	$create_lastname = "";
	$create_tel = "";
	$create_amet = "";
	$create_password = "";
	
	
	$email = "";
	$password = "";
	
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		if( isset($_POST["creat"])){
		
		//echo "jah";
		
		
	
	if(empty($_POST["username"])){
		
		$username_error = "See väli on kohustuslik ";
		
		
	}
		if(empty($_POST["email"])){
		
		$email_error = "See väli on kohustuslik ";
		
		
	}
				if(empty($_POST["password"])){
		
		$password_error = "See väli on kohustuslik ";
		
		
	}
				if(empty($_POST["firstname"])){
		
		$firstname_error = "See väli on kohustuslik ";
		
		
	}
				if(empty($_POST["lastname"])){
		
		$lastname_error = "See väli on kohustuslik ";
		
		
	}
				if(empty($_POST["tel"])){
		
		$tel_error = "See väli on kohustuslik ";
		
		
	}
	
	
	}elseif( isset($_POST["login"])){
		
		
		if(empty($_POST["email"])){
		
		$logemail_error = "See väli on kohustuslik ";
		
		
	}
	
	if(empty($_POST["password"])){
		
		$logpassword_error = "See väli on kohustuslik ";
		
		
	}
		
		
		
		
		
	}
	
		
	}
	
	
	function cleanInput($data) {
  	$data = trim($data); //tabulaator, tühikud, Enter
  	$data = stripslashes($data); //Kaldkriipsud
  	$data = htmlspecialchars($data); // 
  	return $data;
  }
	
	
	
	
?>
<?php
	
	require_once("../header.php");



?>
		<h1>Kasutaja loomis vorm</h1>
		
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<input name="create_username" type="text" placeholder="Kasutajanimi" pattern=".{5,10}" required title="5 to 10 märki" value="<?php echo $create_username; ?>" ><?php  echo $username_error; ?><br /><br />
			<input name="create_email" type="email" placeholder="E-mail" required value="<?php echo $create_email; ?>" ><?php  echo $email_error; ?><br /><br />
			<input name="create_firstname" type="text" placeholder="Eesnimi" required value="<?php echo $create_firstname; ?>" ><?php  echo $firstname_error; ?><br /><br />
			<input name="create_lastname" type="text" placeholder="Perekonnanimi" required value="<?php echo $create_lastname; ?>"><?php  echo $lastname_error; ?><br /><br />
			<input name="create_tel" type="tel" pattern="[0-9]{10}" placeholder="Telefoni number" required value="<?php echo $create_tel; ?>"><?php  echo $tel_error; ?><br /><br />
			<input name="create_amet" type="text" placeholder="Amet" value="<?php echo $create_amet; ?>"><br /><br />
			<input name="create_password" type="password" placeholder="Password" pattern=".{8,16}" required title="8 kuni 16 märki"><?php  echo $password_error; ?><br /><br />
			<input type="submit" value="Registreeru" name="create">
		</form>
		
		
		<h1>Login</h1>
		
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			<input name="email" type="email" placeholder="E-post" value="<?php echo $email; ?>" > <?php echo $logemail_error; ?> <br><br>
			<input name="password" type="password" placeholder="Parool" > <?php echo $logpassword_error; ?> <br><br>
			<input type="submit" value="Logi sisse" name="login"> <br><br>
		</form>
<?php
	
	require_once("../footer.php");



?>