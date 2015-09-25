<h3>Menüü</h3>
<?php echo $file_name; ?>
<ul>
	
	
	<?php 
		
		if($file_name == "home.php"){ 
		
			echo "<li>Avaleht</li>";
		
		}else{
	
			echo '<li><a href="home.php">Avaleht</a></li>';
		}
		
	?>
	<?php 
		
		if($file_name == "login.php"){ 
		
			echo "<li>Logi sisse</li>";
		
		}else{
	
			echo '<li><a href="login.php">Logi sisse</a></li>';
		}
		
	?>
	
	
	
</ul>