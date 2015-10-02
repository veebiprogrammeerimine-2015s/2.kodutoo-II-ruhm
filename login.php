<!DOCTYPE html>
<?php

	require_once("../config.php");
	$database = "if15_olivrah";
	$mysqli = new mysqli($servername, $username, $password, $database);
	
	//echo $_POST["email"];
	
	//defineerime muutujad
	$email_error = "";
	$password_error = "";
	$firstname_error = "";
	$lastname_error = "";
	$age_error = "";
	$location_error = "";
	
	// muutujad väärtuste jaoks
	$email = "";
	$password = "";
	$firstname = "";
	$lastname = "";
	$age = "";
	$location = "";
	$create_email = "";
	$create_password = "";
	$create_firstname = "";
	$create_lastname = "";
	$create_age = "";
	$create_location = "";
	
	if($_SERVER["REQUEST_METHOD"] == "POST") {
	
		// kontrollin mis nuppu vajutati
		if(isset($_POST["login"])){
			if ( empty($_POST["email"]) ) {
				$email_error = "See väli on kohustuslik";
			}else{
				$email = cleanInput($_POST["email"]);
			}
			
			//Kas parool on tühi
			if( empty($_POST["password"]) ) {
				$password_error = "Parool on kohustuslik!";
			}else{
				$password = cleanInput($_POST["password"]);
			}
	// Kui oleme siia jõudnud, võime kasutaja sisse logida
			if($password_error == "" && $email_error == ""){
				echo "Võib sisse logida! Kasutajanimi on ".$email." ja parool on ".$password;
				
				$password_hash = hash("sha512", $password);
				$stmt = $mysqli->prepare("SELECT id, email FROM user_sample WHERE email=? AND password=?");
				$stmt->bind_param("ss", $email, $password_hash);
				
				//paneme vastuse muutujatesse
				
				$stmt->bind_result($id_from_db, $email_from_db);
				$stmt->execute();
				
				if($stmt->fetch()){
					
					//leidis
					
					echo "kasutaja id=".$id_from_db;
					
				}else{
					
					
					//tühi, ju siis midagi valesti
					
					echo "Wrong password or email";
					
				}
			
			
			}		
		}	
		
		// ********************
		// *** CREATE NUPP ****
		// ********************
		
		if(isset($_POST["create"])){ 
			if( empty($_POST["create_email"]) ) {
				$create_email_error = "E-post on kohustuslik!";
			} else {
				$create_email = cleanInput($_POST["create_email"]);
			}
			
			if ( empty($_POST["create_password"]) ) {
				$create_password_error = "See väli on kohustuslik";
			} else {
				if(strlen($_POST["create_password"]) < 8) {
					$create_password_error = "Peab olema vähemalt 8 tähemärki pikk!";
				}else{
					$create_password = cleanInput($_POST["create_password"]);
				}
			}
			
			if( empty($_POST["create_firstname"]) ) {
				$create_firstname_error = "Eesnimi on kohustuslik!";
			} else {
				$create_firstname = cleanInput($_POST["create_firstname"]);	
			
			}
			if( empty($_POST["create_lastname"]) ) {
				$create_lastname_error = "Perekonnanimi on kohustuslik!";
			} else {
				$create_lastname = cleanInput($_POST["create_lastname"]);
			
			}
			if( empty($_POST["create_age"]) ) {
				$create_age_error = "Vanus on kohustuslik!";
			} else {
				$create_age = cleanInput($_POST["create_age"]);
			}
			
			if( empty($_POST["create_location"]) ) {
				$create_location_error = "Vanus on kohustuslik!";
			} else {
				$create_location = cleanInput($_POST["create_location"]);
			
			}
			
			if(	$create_email_error == "" && $create_password_error == "" && $create_firstname_error == "" 
			&& $create_lastname_error == "" && $create_age_error == "" && $create_location_error == ""){
				echo "Võib kasutajat luua! Kasutajanimi on ".$create_email." ja parool on ".$create_password;
				
				$password_hash = hash("sha512", $create_password);
				echo"<br>";
				echo $password_hash;
				
				$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password, firstname, lastname, location, age) VALUE (?,?)");
				
				//echo $mysqli_error
				
				//asendame ? märgid muutujate väärtustega
				//ss - s tähendab string iga muutuja kohta
				$stmt->bind_param("ss", $create_email, $password_hash);
				$stmt->execute();
				$stmt->close();
				
				
			}
		
	
	
		} 	// create if end
	
			
	}
		
  	// funktsioon, mis eemaldab kõikvõimaliku üleliigse tekstist
	function cleanInput($data) {
		$data = trim($data);            //trim võtab ära tühikud, tabulaatorid (TAB nupp)
		$data = stripslashes($data);         // võtab ära \\ kaldkriipsud
		$data = htmlspecialchars($data);      //< -> &lt;   brauser muudab sümboli tekstiks
		return $data;
	}
  
  //paneme ühenduse kinni
  $mysqli->close();
?>


<html>
<?php

$page_title="Minu avaleht";
$file_name="login.php";

?>
<head>
			<title> Oliver Rahula </title>
</head>
	
<body>


<?php

	require_once("menu.php");

?>
	
	<br><br>
	<br><br>
	<h2 align="center">Sisselogimine</h2>
  
  
 
<form action="login.php" method="post" align="center">
	
    <input name="email" type="email" placeholder="E-post" > <?php echo $email_error; ?> <br><br>
	<input name="password" type="password" placeholder="Parool"> <?php echo $password_error; ?> <br><br>
	<input name="login" type="submit" placeholder="Logi sisse" > <br><br>	
	
</form>
	
	<br><br>
	<br><br>
	<h2 align="center">Registreerimine</h2>
	
	
<form action="login.php" method="post" align="center">	

		<input name="email" type="email" placeholder="E-post"> <?php echo $email_error; ?> <br><br>
		<input name="password" type="password" placeholder="Parool"> <?php echo $password_error; ?> <br><br>
		<input name="firstname" type="name" placeholder="Eesnimi"> <?php echo $firstname_error; ?> <br><br>
		<input name="lastname" type="name" placeholder="Perekonnanimi" > <?php echo $lastname_error ?> <br><br>
		<input name="age" type="age" placeholder="Vanus" > <?php echo $age_error ?> <br><br>
		<input name="location" type="location" placeholder="Asukoht" > <?php echo $location_error ?> <br><br>
		<input name="create" type="submit" placeholder="Sisesta" > <br><br>
		
</form>
	<br>
	<br>
	<p><i>Lehe koostas Oliver</i></p>
	
</body>


</html>