<?php
	//Ühenduse loomiseks
	require_once("../../config.php");
	$database = "if15_rimo";
	$mysqli = new mysqli($servername, $username, $password, $database);
	
	//errorid
	$email_error = "";
	$password_error = "";
	$create_emailerror = "";
	$create_passworderror = "";
	$create_passwordAgainerror = "";
	$create_usererror = "";
	
	//väärtused
	$email = "";
	$password = "";
	$Cpassword = "";
	$Cusername = "";
	$Cemail = "";
	$login_accepted = "";
	
	//kontrollin kas keegi vajutas nuppu
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		
		if(isset($_POST["Login"])){
			//kas e-post on tühi
			if(empty($_POST["email"])){
				$email_error = "E-mail is required";
			}else{
				$email = test_input($_POST["email"]);
			}
			
			//kas password on tühi
			if(empty($_POST["password"])){
				$password_error = "Password is required";
			}else{
				$password = test_input($_POST["password"]);
			}
			if($password_error == "" && $email_error == ""){
				$login_accepted = "You've logged in with".$email;
				
				$password_hash = has("sha512", $password);
				$stmt = $mysqli->prepare("SELECT id FROM user_info WHERE email=? AND password=?");
				$stmt->bind_param("ss", $email, $password_hash);
				//vastuse muutujatesse
				$stmt->bind_result($id_from_db, $email_from_db);
				$stmt->execute();
				//kas saime andmebaasist kätte?
				if($stmt->fetch()){
					echo "kasutaja id=".$id_from_db;
				}else{
					echo "Wrong password or email";
				}
				$stmt->close();
			}
		}
		
		if(isset($_POST["Create"])){
			//kas create email on tühi
			if(empty($_POST["Cemail"])){
				$create_emailerror = "E-mail is required";
			}else{
				$Cemail = test_input($_POST["Cemail"]);
			}
			
			//Cusername väli on tühi
			if(empty($_POST["Cusername"])){
				$create_usererror = "Username is required";
			}else{
				$Cusername = test_input($_POST["Cusername"]);
			}
			
			//create password on tühi
			if(empty($_POST["Cpassword"])){
				$create_passworderror = "Password is required";
			}else{
				//kontrollib et parool oleks rohkem kui 8 sümbolit
				if(strlen($_POST["Cpassword"]) < 8 ){
					$create_passworderror = "Must be longer than 8 symbols";
				}else{
					$Cpassword = test_input($_POST["Cpassword"]);
				}
			}
			if($_POST["Cpassword"] !== $_POST["repassword"]){
				//kui parool ei võrdu kordusparooliga lükkab errori ette
				$create_passwordAgainerror = "Your passwords don't match";
			}
			if ($create_emailerror == "" && $create_passworderror == "" && $create_passwordAgainerror == ""){
				echo "Loodud kasutaja email on".$Cemail."ja username on".$Cusername;
				$password_hash = hash("sha512", $Cpassword);
				$stmt = $mysqli->prepare("INSERT INTO user_info (email, password, username) VALUES (?, ?, ?)");
				//Kui error kasuta:
				//echo $mysqli->error;
				//echo $stmt->error;
			
				//?? saavad väärtused
				$stmt->bind_param("sss", $Cemail, $password_hash, $Cusername);
				$stmt->execute();
				$stmt->close();
			}
		}
	}	
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;	
	}
	$mysqli->close();
?>

<?php
$page_title = "Login";
$file_name = "login.php";
?>	

<?php require_once("../header.php");?>


	<h3>Mõtlesin siis teha lehe kuhu inimesed saavad teha postitusi erinevate teemade alla ja teised saavad siis kommenteerida, põhimõtteliselt väga lihtsustatud reddit</h3>
	<h2>Login</h2>
	<?php echo $login_accepted ?>
	<p>* required field.</p>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	<input name="email" type="email" placeholder="E-mail" value="<?php echo $email ?>"> * <?php echo $email_error?><br><br>
	<input name="password" type="password" placeholder="password"> * <?php echo $password_error?><br><br>
	<input name="Login" type="submit" value="Login"> <br><br>
	</form>

	<h2>Create user</h2>
	<p>* required field.</p>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	<input name="Cusername" type="text" placeholder="Username" value="<?php echo $Cusername ?>"> * <?php echo $create_usererror?><br><br>
	<input name="Cemail" type="email" placeholder="E-mail" value="<?php echo $Cemail ?>"> * <?php echo $create_emailerror?><br><br>
	<input name="Cpassword" type="password" placeholder="password"> * <?php echo $create_passworderror?><br><br>
	<input name="repassword" type="password" placeholder="password again"> * <?php echo $create_passwordAgainerror?><br><br>
	<input name="Create" type="submit" value="Create"><br><br>
	</form>
	
<?php require_once("../footer.php");?>