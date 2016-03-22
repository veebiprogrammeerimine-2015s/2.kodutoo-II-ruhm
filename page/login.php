<?php
	$page_title = "Login leht";
	$file_name = "login.php";
	
?>

<?php
	require_once("../header.php")
?>

<?php
	
	require_once("../../config.php");
	$database = "if15_areinlo_2";
	$mysqli = new mysqli($servername, $username, $password, $database);
  
	$email_error = "";
	$password_error = "";
	$create_email_error = "";
	$create_password_error = "";
	$create_password_again_error = "";
  
	$email = "";
	$password = "";
	$create_email = "";
	$create_password = "";
	$create_password_again = "";
	
if($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST["login"])){
		if ( empty($_POST["email"]) ) {
			$email_error = "This field is required";
		}else{
			$email = cleanInput($_POST["email"]);
		}
		if ( empty($_POST["password"]) ) {
			$password_error = "This field is required";
		}else{
			$password = cleanInput($_POST["password"]);
		}
		if($password_error == "" && $email_error == ""){
			echo "Success! Username is ".$email." and password is ".$password;
			$password_hash = hash("sha512", $password);
				$stmt = $mysqli->prepare("SELECT id, email FROM Users WHERE email=? AND password=?");
				$stmt->bind_param("ss", $email, $password_hash);
				
				$stmt->bind_result($id_from_db, $email_from_db);
				$stmt->execute();
				
				if($stmt->fetch()){
					echo "<br>";
					echo"Kasutaja id=".$id_from_db;
				}else{
					
					echo "<br>";
					echo "Wrong password or email!";
					
				}
				
				$stmt->close();

			
			
			

		}
	} 
   if(isset($_POST["create"])){
		if ( empty($_POST["create_email"]) ) {
			$create_email_error = "This field is required";
		}else{
			$create_email = cleanInput($_POST["create_email"]);
		}
		if ( empty($_POST["create_password"]) ) {
			$create_password_error = "This field is required";
		} else {
			if(strlen($_POST["create_password"]) < 8) {
				$create_password_error = "Your password must be at least 8 characters long!";
			}else{
				$create_password = cleanInput($_POST["create_password"]);
			}
		}
		if ( empty($_POST["create_password_again"]) ) {
			$create_password_again_error = "This field is required";
		} else {
			if ($_POST["create_password"] != $_POST["create_password_again"] ) {
			$create_password_again_error = "Passwords do not match!";
			} else {	
				if(strlen($_POST["create_password_again"]) < 8) {
				$create_password_again_error = "This field is required!";
				}else{
				$create_password_again = cleanInput($_POST["create_password"]);
				}
			}
		}
		if(	$create_email_error == "" && $create_password_error == "" && $create_password_again_error == ""){
			echo "Võib kasutajat luua! Kasutajanimi on ".$create_email." ja parool on ".$create_password;
			$password_hash = hash("sha512", $create_password);
				echo "<br>";
				echo $password_hash;
			
			
			
			$stmt = $mysqli->prepare("INSERT INTO Users (email, password) VALUE (?, ?)");
			$stmt->bind_param("ss", $create_email, $password_hash);
			$stmt->execute();
			$stmt->close();
		}
    } 
	}
  function cleanInput($data) {
  	$data = trim($data);
  	$data = stripslashes($data);
  	$data = htmlspecialchars($data);
  	return $data;
  }
	
 $mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>
  <h2>Log in</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
  	<input name="email" type="email" placeholder="Email" value="<?php echo $email; ?>"> <?php echo $email_error; ?><br><br>
  	<input name="password" type="password" placeholder="Password" value="<?php echo $password; ?>"> <?php echo $password_error; ?><br><br>
  	<input type="submit" name="login" value="Log in">
	</form>

	<h2>Create user</h2>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
  	<input name="create_email" type="email" placeholder="Email" value="<?php echo $create_email; ?>"> <?php echo $create_email_error; ?><br><br>
  	<input name="create_password" type="password" placeholder="Password"> <?php echo $create_password_error; ?> <br><br>
  	<input name="create_password_again" type="password" placeholder="Confirm password"> <?php echo $create_password_again_error; ?> <br><br>
	<input type="submit" name="create" value="Create user">
  </form>
</body>
</html>
