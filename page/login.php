<style>
.error {color: #FF0000;}
</style>

<?php
	
	// LOGIN.PHP
	
	// ühenduse loomiseks kasuta
	require_once("../../config.php");
	$database = "if15_vitamak";
	$mysqli = new mysqli($servername, $username, $password, $database);

	
	// errori muutujad peavad igal juhul olemas olema 
	$email_error = $password_error = $regname_error = $reglog_error = $lastname_error = $regpassword_error = $regemail_error = "";
	
	$email = $regemail = "";
	$password = $regpassword = "";
	
	// kontrollime et keegi vajutas input nuppu
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if(isset($_POST["login"])){
		
		//echo "ktonibuty nazhimal knopku";
		//CREATE LOG ===========================================================================
		//proverka pochty pustoy ili net
		if (empty($_POST["email"])) {
			$email_error = "e-mail is required";
		}else{
			 $email = test_input($_POST["email"]);
			// check if e-mail address is well-formed
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format"; 
		}
		}
		
		//proverka porolya, pustoi ili net
		if ( empty($_POST["password"])) {
			$password_error = "password is required";
		}else{
				$password = test_input($_POST["password"]);
				// check if pass only contains letters and whitespace
				if (!preg_match("/^[a-zA-Z ]*$/",$password)) {
				$password = "Only letters and white space allowed"; 
		}
  }
 		}
		}
		
			 if(isset($_POST["create"])){
		
			//CREATE NUPP ======================================================================
			
				// kas NIMI on tühi
				if( empty($_POST["name"]) ) {
				// registre name on tühi
				$name_error = "Name is required";
			}
				if( empty($_POST["lastname"]) ) {
				// lastname on tühi
				$lastname_error = "perekonnanimi is required";
			}
				if( empty($_POST["login"]) ) {
				// login on tühi
				$reglog_error = "login is required";
			}
				if( empty($_POST["regpassword"]) ) {
				// reg pass on tühi
				$regpassword_error = "password is required";
			}
				if( empty($_POST["regname"]) ) {
				// reg pass on tühi
				$regname_error = "name is required";
			}
				if( empty($_POST["regemail"]) ) {
				// reg pass on tühi
				$regemail_error = "email is required";
			}
				
				$password_hash = hash("sha512", $create_password);
				echo "<br>";
				echo $password_hash;	
				
				$stmt = $mysqli->prepare("INSERT INTO usesdf_sample (email, password) VALUE (?, ?)");
				
				//echo $mysqli->error;
				//echo $stmt->error;
				//asendame ? märgid muutujate väärtuste
				// ss - s tähendab string iga muutuja kohta
				$stmt->bind_param("ss", $create_email, $password_hash);
				$stmt->execute();
				$stmt->close();
			}	
		
		
		
	function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
				// paneme ühenduse kinni
				$mysqli->close();
?>


<?php
	$page_title = "logi sisse";
	$file_name = "login.php";
?>



<?php require_once("../header.php"); ?>
		<h2>Log in</h2>
		<form action="login.php" method="post" >
			<input name="email" type="email" placeholder="E-post"> <?php echo $email_error; ?><br><br>
			<input name="password" type="password" placeholder="Parool"> <?php echo $password_error; ?> <br><br>
			<input name="login" type="submit" value="Login">
		</form> 
	
		<h2>Create user</h2>
		<form action="login.php" method="post">
			<input name="regname" type="text" placeholder="eesnimi" > <?php echo $regname_error; ?><br><br>
			<input name="lastname" type="text" placeholder="perekonnanim" > <?php echo $lastname_error; ?><br><br>
			<input name="reglog" type="text" placeholder="login" > <?php echo $reglog_error; ?><br><br>
			<input name="regpassword" type="password" placeholder="passi" > <?php echo $regpassword_error; ?><br><br>
			<input name="regemail" type="email" placeholder="email" > <?php echo $regemail_error; ?><br><br>
			IF YOU WANT TO COMMENT THIS SITE, SO TRY IT <br><br>
			<textarea name="comment" rows="5" cols="40"></textarea><br><br>
			kas teil meeldib?<input type="radio" name="gender" value="female">Jah
			<input type="radio" name="gender" value="male">Ei <br><br>
			<input name="create" type="submit" value="create user" > <br><br>
			
		</form>
<?php require_once("../footer.php"); ?>