<?php
	require 'header.php'; //logout page header

?>
<main>
<?php
	
	require 'leftColumn.php'; // left column of logout page
?>
			<article>
				<h2>Log Out!</h2>
				
<?php		
			if (!isset($_POST['submit'])){  //after erasing the session variables it allows you to log off
				
				echo '<p> Please confirm that you would like to log out by clicking the log out button below </p>			
				<form action="index.php" method="POST">
					<input type="submit" name="submit" value="Log Out." />   
				</form>';
				session_destroy(); //session end
			}
			else {
				
			}
?>
			</article>
		</main>
<?php
	require 'footer.php'; //logout page footer
?>