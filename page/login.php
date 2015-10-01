<?php

	$page_title = "Login leht";
	$file_name = "login.php";
	
?>

<?php
	//Kopeerime header.php sisu
	require_once("../header.php")

?>

<?php

	require_once("../../config.php");
	$database = "if15_kertkulp";
	$mysqli = new mysqli($servername, $username, $password, $database);
	
	//defineerime muutujad
	$email_error = "";
	$password_error = "";
	$firstname_error = "";
	$lastname_error = "";
	$create_password_error = "";
	$create_email_error = "";
	
	$email = "";
	$password = "";
	$createemail = "";
	$createpassword = "";
	$firstname = "";
	$firstname = "";
	
	//kontrollin kas keegi vajutas nuppu
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
		//Kontrollitakse kumbat nuppu vajutati
		if(isset($_POST["login"])){
		
		//LOGIN NUPP
		
			//Kas epost on tühi
			if( empty($_POST["email"]) ) {
				$email_error = "E-post on kohustuslik!";
			}else{
				$email = cleanInput($_POST["email"]);
			}
			//Kas parool on tühi
			if( empty($_POST["password"]) ) {
				$password_error = "Parool on kohustuslik!";
			}else{
				$password = cleanInput($_POST["password"]);
			}
		
		} elseif(isset($_POST["create"])){
			
			// CREATE USER NUPP
			
			//Kas epost on tühi
			if( empty($_POST["createemail"]) ) {
				$create_email_error = "E-post on kohustuslik!";
			}else{
				$createemail = cleanInput($_POST["createemail"]);
			}
			//Kas parool on tühi
			if ( empty($_POST["createpassword"]) ) {
				$create_password_error = "See väli on kohustuslik";
			} else {
				if(strlen($_POST["createpassword"]) < 8) {
					$createpassworderror = "Peab olema vähemalt 8 tähemärki pikk!";
				}else{
					$createpassword = cleanInput($_POST["createpassword"]);
				}
			}
			
			
			if( empty($_POST["firstname"]) ) {
				$firstname_error = "Eesnimi on kohustuslik!";
			}else{
				$firstname = cleanInput($_POST["firstname"]);
			}
			
			if( empty($_POST["lastname"]) ) {
				$lastname_error = "Perekonnanimi on kohustuslik!";
			}else{
				$firstname = cleanInput($_POST["firstname"]);
			}
			
			if(	$create_email_error == "" && $create_password_error == "" && $firstname_error == "" && $lastname_error == ""){
				echo "Võib kasutajat luua! Kasutajanimi on ".$createemail." ja parool on ".$createpassword;
			
				$password_hash = hash("sha512", $createpassword);
				echo "<br>";
				echo $password_hash;
				
				$stmt = $mysqli->prepare("INSERT INTO kasutajad (email, password) VALUE (?, ?)");
				
				//echo $mysqli->error;
				//echo $stmt->error;
				
				
				//asendame küsimärgid muutujate väärtustega
				//ss - s tähendab string iga muutjua kohta
				$stmt->bind_param("ss", $create_email, $password_hash);
				$stmt->execute();
				$stmt->close();
			}
		}
		
		}
	
	
	
	function cleanInput($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	
	$mysqli->close();

?>


<html>
	<head>
		<title>Login</title>
	</head>
	<body>		
		<h2>Login</h2>
		<form action="login.php" method="post"> 
			<input name="email" type="email" placeholder="E-post"> <?php echo $email_error; ?> <br><br>
			<input name="password" type="password" placeholder="Parool"> <?php echo $password_error; ?> <br><br>
			<input name="login" type="submit" value="Logi sisse"> <br><br>
		</form>
		<h2>Create user</h2>
		<form action="login.php" method="post"> 
			<input name="createemail" type="email" placeholder="E-post"> <?php echo $create_email_error; ?> <br><br>
			<input name="createpassword" type="password" placeholder="Parool"> <?php echo $create_password_error; ?> <br><br>
			<input name="createpassword" type="password" placeholder="Parool uuesti"> <?php echo $create_password_error; ?> <br><br>
			<input name="firstname" type="text" placeholder="Eesnimi"> <?php echo $firstname_error; ?> <br><br>
			<input name="lastname" type="text" placeholder="Perekonnanimi"> <?php echo $lastname_error; ?> <br><br>
			<input name="create" type="submit" value="Registreeru"> <br><br>
		</form>
	</body>

</html>


<?php
	//Kopeerime header.php sisu
	require_once("../footer.php")
?>