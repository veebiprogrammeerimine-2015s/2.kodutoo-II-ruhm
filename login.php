<?php

	//echo $_POST["email"];
	
	//Defineerime muutuja
	$email_error ="";
	$password_error = "";
	$first_name_error = "";
	$last_name_error = "";
	$date_error = "";
	$cemail_error ="";
	$cpassword_error ="";
	
	
	//kontrollin, kas keegi vajutas nuppu
	if($_SERVER["REQUEST_METHOD"] == "POST") {

		echo "jah";
	
		//kas e-post on tühi
		if ( empty($_POST["email"])	) {
			
			//jah oli tühi
			$email_error = "See väli on kohustuslik";
	
		}

	// kas parool on tühi
		if ( empty($_POST["password"]) ) {
			$password_error = "See väli on kohustuslik";
		} else {
			
			//Parool pole tühi
			if(strlen($_POST["password"]) < 6) {
				
				$password_error = "Parool peab olema vähemalt 6 tähemärki pikk.";
			}		
		}
		
		
		if ( empty($_POST["first_name"])	) {
			
			//jah oli tühi
			$first_name_error = "See väli on kohustuslik";
	
		}
		
		if ( empty($_POST["last_name"])	) {
			
			//jah oli tühi
			$last_name_error = "See väli on kohustuslik";
	
		}
		
		if ( empty($_POST["date"])	) {
			
			//jah oli tühi
			$date_error = "See väli on kohustuslik";
	
		}
		
				if ( empty($_POST["cemail"])	) {
			
			//jah oli tühi
			$cemail_error = "See väli on kohustuslik";
	
		}
		
						if ( empty($_POST["cpass"])	) {
			
			//jah oli tühi
			$cpassword_error = "See väli on kohustuslik";
	
		}
		
	}
	
	
	
?>
<html>
<head>
	<title>Login Page</title>
</head>
<body>

	<h2>Logi sisse</h2>
	<form action="login.php" method="post">
	<input name="email" type="email" placeholder="E-post" > <?php echo $email_error ?>	<br><br>
	<input name="password" type="password" placeholder="Parool" > <?php echo $password_error ?>	<br><br>
	<input type="submit" value="Logi sisse" >	<br><br>
	</form>
	
	
	<h2>Tee kasutaja</h2>
	<form action="login.php" method="post" >
	<input name="cemail" type="email" placeholder="Email ">*<?php echo $cemail_error ?><br><br>
	<input name="cpass" type="password" placeholder="Parool ">*<?php echo $cpassword_error ?><br><br>
	<input name="first_name" type="text" placeholder="Eesnimi">*<?php echo $first_name_error ?><br><br>
	<input name="last_name" type="name" placeholder="Perekonnanimi">*<?php echo $last_name_error ?><br><br>
	<input name="date" type="age" placeholder="Vanus">*<?php echo $date_error ?><br><br>
	<input type="submit" value="Registeeri">
	</form>
	MVP idee
	<p>Idee seisneb selles, et inimesed, kes käivad jõusaalis, saaks mugavalt oma järgida oma toitumist.
	 Koostaks kalkulaatori(vanus, rasvaprotsent, kui palju liigutakse nädalas) ja vastavalt oma soovidele(kaalu kaotus/massi suurendamine) näeks inimene, kuidas toiteväärtust muuta ja kuidas õigesti süüa.
	 Et asja natuke omamoodi luua, siis võiks olla lisa võimalus, et koostab päeva ja hiljem nädalaplaani ja lisab sellele kõrvale retseptid, et poest lihtsam asju osta oleks ja saaks täpselt toitumisnõuded ära täita.</p>
</body>
</html>