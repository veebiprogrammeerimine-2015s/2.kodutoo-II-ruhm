<h3>Menu</h3>
<?php echo $file_name; ?>
<ul>
	<?php if($file_name == "home.php"){
		echo "<li>Avaleht</li>";
	}else{
		echo '<li><a href="home.php">Avaleht</a></li>';}
	?>

	<?php if($file_name == "login.php"){
		echo "<li>Login</li>";
	}else{
		echo '<li><a href="login.php">Login</a></li>';}
	?>
</ul>