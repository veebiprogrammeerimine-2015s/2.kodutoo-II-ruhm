
<?php

//echo $_POST["email"];




$first_name_error="";
$last_name_error="";
$user_name_error="";
$password_error="";
$email_error="";
//kontrollin kas keegi vajutas nuppu
if($_SERVER["REQUEST_METHOD"]=="POST"){

echo "jah";




if(empty($_POST["Password"])){
	$parool_error = "See väli on kohustuslik";
		}

if(empty($_POST["first_name"])){
	$first_name_error = "See väli on kohustuslik";
		}

if(empty($_POST ["last_name"])){
	$last_name_error="See väli on kohustuslik";
}	
if(empty($_POST ["user_name"])){
	$user_name_error="See väli on kohustuslik";
}
if(empty($_POST ["password"])){
	$password_error="See väli on kohustuslik";
}
if(empty($_POST ["email"])){
	$email_error="See väli on kohustuslik";
}
}
?>
<html>
<head>

</head>
<body>


<h2> Create User </h2>

<form action="leht2" method="POST">
<input name="first_name" type="text" placeholder ="Name"><?php echo $first_name_error; ?><br><br>
<input name ="Lastname" type="text " placeholder="Lastname"><?php echo $last_name_error; ?><br><br>
<input name="User" type="text" placeholder="Username"><?php echo $user_name_error;?><br><br>
<input name="Password" type="text" placeholder="Password"><?php echo $password_error?><br><br>
<input name="Email" type="text" placeholder="Email"><?php echo $email_error?><br><br>
<input type="submit" value="Submit"><br><br>
</form>


</body>

</html>
