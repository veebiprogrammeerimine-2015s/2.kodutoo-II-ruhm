<h3>Menu</h3>
<?php //echo $file_name; ?>
<ul>
	
	<?php if($file_name == "home.php"){ ?>
		<li>Homepage</li>
	<?php } else { ?>
		<li><a href="home.php">Homepage</a></li>
	<?php } ?>
	
	<?php 
		
		if($file_name == "login.php"){ 
			echo "<li>Logi sisse</li>";
		}else{
			echo '<li><a href="login.php">Logi sisse</a></li>';
		}
	?>
</ul>