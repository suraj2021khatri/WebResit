<?php
	require 'header.php'; //signup page header
?>
<main>
<?php
	require 'leftColumn.php'; //left side column of signup page
?>
			
			<article>
				<h2>Sign Up</h2>
				<form action="signUpcompleted.php" method="POST">  <!-- form action completed  -->
					<p>In order to set up an account please fill the information below .</p>  <!-- text valuee -->

					<label>First Name</label> <input type="text" name="fName" /> <!--value="firstname" --> 
					<label>Surname</label> <input type="text" name="sName" /> <!--value="surname" --> 
					<label>Date Of Birth</label> <input type="date" name="dob" />  <!--value="date of birth" --> 
					<label>Email</label> <input type="text" name="email" />  <!--value="email" --> 
					<label>Password</label> <input type="password" name="pass" />  <!--value="password" --> 
					<input type="submit" name="submit" value="Submit" />   <!--value="submit" --> 
				</form>

			</article>
		</main>
<?php
	require 'footer.php'; //signup page footer
?>