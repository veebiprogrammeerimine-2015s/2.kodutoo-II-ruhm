<?php

	$page_title = "Login leht";
	$file_name = "login.php";
	
?>

<?php
	//Kopeerime header.php sisu
	require_once("../header.php")

?>

<?php

	//echo $_POST["email"];
	
	//defineerime muutujad
	$email_error = "";
	$password_error = "";
	$firstname_error = "";
	$lastname_error = "";
	$create_password_error = "";
	$create_email_error = "";
	
	//kontrollin kas keegi vajutas nuppu
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		
		//Kontrollitakse kumbat nuppu vajutati
		if(isset($_POST["login"])){
		
		//LOGIN NUPP
		
			//Kas epost on tühi
			if( empty($_POST["email"]) ) {
				$email_error = "E-post on kohustuslik!";
			}
			//Kas parool on tühi
			if( empty($_POST["password"]) ) {
				$password_error = "Parool on kohustuslik!";
			}
		
		} elseif(isset($_POST["create"])){
			
			// CREATE USER NUPP
			
			//Kas epost on tühi
			if( empty($_POST["createemail"]) ) {
				$create_email_error = "E-post on kohustuslik!";
			}
			//Kas parool on tühi
			if( empty($_POST["createpassword"]) ) {
				$create_password_error = "Parool on kohustuslik!";
			}
			
			if( empty($_POST["firstname"]) ) {
				$firstname_error = "Eesnimi on kohustuslik!";
			}
			
			if( empty($_POST["lastname"]) ) {
				$lastname_error = "Perekonnanimi on kohustuslik!";
			}
		
		}
	}
?>







		
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
	//Kopeerime footer.php sisu
	require_once("../footer.php")

?>