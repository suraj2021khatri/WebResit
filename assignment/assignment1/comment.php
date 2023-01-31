<?php
	require 'header.php'; // header of the commennt page
?>
<main>
<?php
	require 'leftColumn.php'; //left column side of the comment page.
?>
			<article>
<?php
	echo ' <h2> Authorise Comments. </h2>'; // authorizing comments by the admin
	echo ' <form>  
		</form>';  //ending form tag
	
	$retrieveUnauthorisedComments = $dbAccessObject->unauthorisedComments();  //retrieving unauthorized comments
	if ($retrieveUnauthorisedComments->rowCount() == 0){  //verifying the data
		echo '<p> There is currently no comments to action. </p>';  //prints out the text
	}
	else {
		foreach ($retrieveUnauthorisedComments as $row) {  //retrieving unauthorized comment
			echo '<h4>' . $row['firstName'] . ' ' . $row['surname'] .  '</h4>';   //naming function
			echo '<p>' . $row['commentDate'] . '</p>';  //comment date
			echo '<p>' . $row['commentContent'] . '</p>';  //content of comment
			echo '<a href="authoriseComment.php?authorise=yes&commentId=' . $row['commentId'] . '">Authorise comment.</a>';  //comment authorization
			echo '</br>';  //break the line
			echo '<a href="authoriseComment.php?authorise=no&commentId=' . $row['commentId'] . '">Remove comment.</a>';  //comment removed
			echo '<form>  
				</form>';  //ending form tag
		}
		
	}
				
							
					
?>		

			</article>
		</main>
<?php
	require 'footer.php'; // comment page footer
?>