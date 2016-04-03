<?php
	
// Loon AB'i ühenduse

    require_once("config.php");
	
    $database = "uus";
    $mysqli = new mysqli($servername, $username, $password, $database);
    
    //check connection
    if($mysqli->connect_error) {
        die("connect error ".mysqli_connect_error());
    }
	//loome uue funktsiooni, et küsida ab'ist andmeid
	
	
	session_start();
	
	
	// võtab andmed ja sisestab ab'i
	// võtame vastu 2 muutujat
	function createUser($create_email, $hash){
		
		// Global muutujad, et kätte saada config failist andmed
		//$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $GLOBALS["mysqli"]->prepare("INSERT INTO user_sample (email, password) VALUES (?,?)");
		$stmt->bind_param("ss", $create_email, $hash);
		$stmt->execute();
		$stmt->close();
		
		$GLOBALS["mysqli"]->close();
		
	}
	
	function loginUser($email, $hash){
		//$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);		
		
		$stmt = $GLOBALS["mysqli"]->prepare("SELECT id, email FROM user_sample WHERE email=? AND password=?");
		$stmt->bind_param("ss", $email, $hash);
		$stmt->bind_result($id_from_db, $email_from_db);
		$stmt->execute();
		if($stmt->fetch()){
			// ab'i oli midagi
			echo "Email ja parool õiged, kasutaja id=".$id_from_db;
			
			// tekitan sessiooni muutujad
			
			$_SESSION["logged_in_user_id"] = $id_from_db;
			$_SESSION["logged_in_user_email"] = $email_from_db;
			
			//suunan data.php lehele
			header("Location: kodu2_data.php");
			
		}else{
			// ei leidnud
			echo "Wrong credentials!";
		}
		$stmt->close();
		
		$GLOBALS["mysqli"]->close();
	}
	
	// fn sample
	//function hello($name, $age){
	//	echo $name." ".$age;
	//}
	
	
	
	
	
	
	
?>


