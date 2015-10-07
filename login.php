<?php
		
	//ühenduse loomiseks kasuta
	require_once("../config.php");
	$database = "if15_koitkor_2";
	$mysqli = new mysqli($servername, $server_username, $server_password, $database);

	
	// muuutujad errorite jaoks
	$email_error = "";
	$password_error = "";
	$create_email_error = "";
	$create_password_error = "";
	$create_fname_error = "";
	$create_lname_error = "";
	$create_age_error = "";
	// muutujad väärtuste jaoks
	$email = "";
	$password = "";
	$create_email = "";
	$create_password = "";
	$create_fname = "";
	$create_lname = "";
	$create_age = "";
	if($_SERVER["REQUEST_METHOD"] == "POST") {
	//Kontrollin kas keegi vajutas login
	if(isset($_POST["login"])){
		if ( empty($_POST["email"]) ) {
			$email_error = "See väli on kohustuslik";
		} else {
			$email = cleanInput($_POST["email"]);
		}
		if ( empty($_POST["password"]) ) {
			$password_error = "See väli on kohustuslik";
		} else {
			$password = cleanInput($_POST["password"]);
		}
		
		if($password_error == "" && $email_error == ""){
			echo "Võib sisse logida! Kasutajanimi on ".$email." ja parool on ".$password.". Eesnimi: ".$create_fname." Perekonnanimi: ".$create_lname." Vanus: ".$create_age;
			
			$password_hash = hash("sha512", $password);
			
			$stmt = $mysqli->prepare("SELECT id, email FROM user_sample2 WHERE email=? AND password=?");
			$stmt->bind_param("ss", $email, $password_hash);
			
			//paneme vastuse muutujatesse
			$stmt->bind_result($id_from_db, $email_from_db);
			$stmt->execute();
			
			//küsima kas AB'ist saime kätte
			if($stmt->fetch()){
				//leidis
				echo ". Kasutaja id=".$id_from_db;
			}else{
				// tühi, ei leidnud , ju siis midagi valesti
				echo "Wrong password or email!";
				
			}
			
			$stmt->close();
		}
			
	}	
	}
	
	//Kontrollin kas keegi vajutas registreeru
	if(isset($_POST["create"])){
		if ( empty($_POST["create_fname"]) ) {
			$create_fname_error = "See väli on kohustuslik";
		}
		
		if ( empty($_POST["create_lname"]) ) {
			$create_lname_error = "See väli on kohustuslik";
		}
		
		if ( empty($_POST["create_age"]) ) {
			$create_age_error = "See väli on kohustuslik";
		}
				
		if ( empty($_POST["create_email"]) ) {
			$create_email_error = "See väli on kohustuslik";
		}
		
		if ( empty($_POST["create_password"]) ) {
			$create_password_error = "See väli on kohustuslik";
		} else {
			if(strlen($_POST["create_password"]) < 8) {
				$create_password_error = "Peab olema vähemalt 8 tähemärki pikk!";
			}
		}
		if(	$create_email_error == "" && $create_password_error == ""){
				echo "Võib kasutajat luua! Kasutajanimi on ".$create_email." ja parool on ".$create_password. "Kasutajanimi on ".$email." ja parool on ".$password.". Eesnimi: ".$create_fname." Perekonnanimi: ".$create_lname." Vanus: ".$create_age;
				
				$password_hash = hash("sha512", $create_password);
				echo "<br>";
				echo $password_hash;
				
				$stmt = $mysqli->prepare("INSERT INTO user_sample2 (enimi, pnimi, vanus, email, password) VALUES (?, ?, ?, ?, ?)");
				
				echo $mysqli->error;
				echo $stmt->error;
				//asendame ? märgid muutujate väärtuste
				// ss - s tähendab string iga muutuja kohta
				$stmt->bind_param("sssss", $create_fname, $create_lname, $create_age, $create_email, $password_hash);
				$stmt->execute();
				$stmt->close();
				
				
			}
	}
	// funktsioon, mis eemaldab kõikvõimaliku üleliigse tekstist
  function cleanInput($data) {
  	$data = trim($data);
  	$data = stripslashes($data);
  	$data = htmlspecialchars($data);
  	return $data;
  }
  
  // paneme ühenduse kinni
  $mysqli->close();
?>

<html>
<head>
	<title>Login page</title>
</head>
<body>
	<h2>Login</h2>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<input name="email" type="email" placeholder="E-post"> <?php echo $email_error;?> <br> <br> 
	<input name="password" type="password" placeholder="Parool"> <?php echo $password_error;?> <br> <br> 
	<input name="login" type="submit" value="Logi sisse"> <br> <br>
	</form>
	
	
	
	<h2>Create user</h2>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<input name="create_fname" type="text" placeholder="Eesnimi" value="<?php echo $create_fname; ?>"> <?php echo $create_fname_error; ?><br><br>
	<input name="create_lname" type="text" placeholder="Perekonnanimi" value="<?php echo $create_lname; ?>"> <?php echo $create_lname_error; ?><br><br>
	<input name="create_age" type="int" placeholder="Vanus" value="<?php echo $create_age; ?>"> <?php echo $create_age_error; ?><br><br>


	<input name="create_email" type="email" placeholder="E-post" value="<?php echo $create_email; ?>"> <?php echo $create_email_error; ?><br><br>
  	<input name="create_password" type="password" placeholder="Parool"> <?php echo $create_password_error; ?> <br><br>
  	<input name="create" type="submit" value="Registreeru">
	</form>
</body>

</html>