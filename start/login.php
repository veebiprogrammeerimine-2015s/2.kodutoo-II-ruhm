<style>
.error {color: #FF0000;}
</style>

<?php
	
	// LOGIN.PHP
	
	// ühenduse loomiseks kasuta
	require_once("../../config.php");
	$database = "if15_vitamak";
	$mysqli = new mysqli($servername, $username, $password, $database);

	
	// ВСЕ ОШИБКИ ИДУТ СЮДА, И ЕЩЕ В 2 ОПРЕДЕЛЕННЫХ МЕСТА ВНИЗУ.
	$email_error = $password_error = "";
	
	$email = $regemail = "";
	$password = $regpassword = "";
	
	// ПРОВЕРЯЕМ НАЖАЛ ЛИ КТО КНОПКУ СЛ
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		if(isset($_POST["login"])){
		
		//echo "ktonibuty nazhimal knopku";
		//======================================================================================
		//===================CREATE LOG ========================================================
		//======================================================================================
		//======================================================================================
		//ПОЧТА ПУСТАЯ ИЛИ НЕТ.===============================================================
		//======================================================================================
		if (empty($_POST["email"])) {
			$email_error = "e-mail is required";
		}else{
			 $email = test_input($_POST["email"]);
			//======================================================================================
			// ПРОВЕРЯЕМ ЕСЛИ ПОЧТА В ПРАВЕЛЬНОМ ФОРМАТЕ.===========================================
			//======================================================================================
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Invalid email format"; 
		}
		}
		//======================================================================================
		//ПРОВЕРКА ПАРОЛЯ, СТРОКА ПУСТА ИЛИ НЕТ.==============================================
		//======================================================================================
		if ( empty($_POST["password"])) {
			$password_error = "password is required";
		}else{
				$password = test_input($_POST["password"]);
				//======================================================================================
				// ПРОВЕРКА ПАРОЛЯ, СОДЕРЖИТ ЛИ ЛИШНИЕ ЗНАКИ
				//======================================================================================
				if (!preg_match("/^[a-zA-Z ]*$/",$password)) {
				$password = "Only letters and white space allowed"; 
		}
  }
 		}
		}
		
			 if(isset($_POST["create"])){
		
			//======================================================================================
			//===================СОЗДАНИЕ КНОПКИ "РЕГИСТРАЦИИ" CREATE===============================
			//======================================================================================
			if( empty($_POST["regemail"]) ) {
				// ОШИБКА ПУСТОГО ПОЛЯ
				$regemail_error = "email is required";
			}
			if( empty($_POST["regpassword"]) ) {
				// ОШИБКА ПУСТОГО ПОЛЯ
				$regpassword_error = "password is required";
			}			
			
	}		
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
			<input name="regemail" type="email" placeholder="email" > <?php echo $regemail_error; ?><br><br>
			<input name="regpassword" type="password" placeholder="passi" > <?php echo $regpassword_error; ?><br><br>
			IF YOU WANT TO COMMENT THIS SITE, SO TRY IT <br><br>
			<textarea name="comment" rows="5" cols="40"></textarea><br><br>
			kas teil meeldib?<input type="radio" name="gender" value="female">Jah
			<input type="radio" name="gender" value="male">Ei <br><br>
			<input name="create" type="submit" value="create user" > <br><br>
			
		</form>
<?php require_once("../footer.php"); ?>