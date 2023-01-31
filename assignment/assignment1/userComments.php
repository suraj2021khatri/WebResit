<?php
	require 'header.php'; //header of comments of user page
?>
<main>
<?php
	
		require 'leftColumn.php'; //left side column of users comments page.
	
?>
			<article>
<?php
	 
	$user = $dbAccessObject->retrieveUserByEmail($_GET['email']); //users entire profile is compiled
	foreach ($user as $row){  // loop to aid in printing the outcomes of the aforementioned query.
		
		echo '<h2>' . $row['FirstName'] . " " . $row['Surname'] . '</h2>'; //naming fuction
		echo '<p> Email: ' . $row['Email'] . '</p>'; //email ID
		echo '<form>
		</form>'; // ending form tag
	}
	echo '<h4> Comments: </h4>'; //header for Comments
	echo '</br>';  //breaks the line
	$userComments = $dbAccessObject->retrieveUserComments($_GET['email']); //comment made by a specific user are obtained
	foreach ($userComments as $row) {  //looping over the results
		echo '<p> Article title: ' . $row['articleName'] . '</p>';  //article title
		echo '</br>';  //breaking line
		echo '<p> Date of comment: ' . $row['commentDate'] . '</p>';  //date 
		echo '</br>'; //breaking line
		echo '<p>Comment: ' . $row['commentContent'] . '</p>';  //contnet of comment
		echo '<form>
		</form>';  //ending form tag
	
	}
	
?>	
			</article>
		</main>
<?php
//footer for user comment page
	require 'footer.php'; 
?>