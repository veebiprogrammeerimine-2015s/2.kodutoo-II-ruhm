<?php
// ühenduse loomiseks kasuta
	require_once("../config.php");
	$database = "if15_taunlai_";
	$mysqli = new mysqli($servername, $server_username, $server_password, $database);
	
	// funktsioon, mis eemaldab kõikvõimaliku üleliigse tekstist
	function cleanInput($data) { 
  	$data = trim($data); //eemaldab tühikud, tabid ja enterid
  	$data = stripslashes($data); // eemaldab tagurpidi kaldkriipsud "\"
  	$data = htmlspecialchars($data);
  	return $data;
  }
//echo $_POST["email"];


$email_error="";
$password_error="";

//kontrollin kas keegi vajutas nuppu
if($_SERVER["REQUEST_METHOD"]=="POST"){
	

// kontrollin mis nuppu vajutati
		if(isset($_POST["login"])){

	if(empty($_POST["email"])){
		//jah oli tühi
		$email_error = "See väli on kohustuslik";
}
else

//puhastame muutuja võimalikest üleliigsetest sümbolitest
$emial = cleanInput($_POST["email"]);
//kas parool on tühi
	//jah on tühi
if(empty($_POST["Password"])){
		$password_error = "See väli on kohustuslik";
}
else
			{
				$password = cleanInput($_POST["password"]);
			}
			// Kui oleme siia jõudnud, võime kasutaja sisse logida
			if($password_error == "" && $email_error == ""){
				echo "Võib sisse logida! Kasutajanimi on ".$email." ja parool on ".$password;
				
				$password_hash = hash("sha512", $password);
				
				$stmt = $mysqli->prepare("SELECT id, email FROM kontod32 WHERE email=? AND password=?");
				$stmt->bind_param("ss", $email, $password_hash);
				
				//paneme vastuse muutujatesse
				$stmt->bind_result($id_from_db, $email_from_db);
				$stmt->execute();
				
				if($stmt->fetch()){
					//leidis
					echo "<br>";
					echo"Kasutaja id=".$id_from_db;
				}else{
					//tühi, ei leidnud, ju siis midagi valesti
					echo "<br>";
					echo "Wrong password or email!";
					
				}
				
				$stmt->close();
			}
}	
		}
		
	
	//Paneme ühenduse kinni
	$mysqli->close();
?>

<?php
	$page_title = "Login leht";
	$file_name = "login.php";
?>

<html>

<head>
<title>Login Page </title>
</head>
<body>

<h2>Lehekülg</h2>


<h2> Login </h2>
<form action="login.php" method="POST">
<input type="email" placeholder="E-post"><?php echo  $email_error; ?>  <br><br>
<input type="password" placeholder="Parool"><?php echo $password_error; ?> <br><br>
<input type="submit" value="Logi sisse" > <br><br>
</form>

<h2> <a href="../1.kodutoo-II-ruhm/leht2">Not user? <br>Create User here!<br> </a> </h2>



 Idee kirjeldus. Lisan lehele Logimis ja registeerimis vormid, peale mida lisan lehti juurde , kuhu saab lisada pilte ja postitusi.




</body>
</html>