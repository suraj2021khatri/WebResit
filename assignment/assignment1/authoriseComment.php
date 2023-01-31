<?php
	require 'header.php'; //header of the comment authorization page
?>
<main>
<?php
	require 'leftColumn.php';  //left column side of authorise comment page
?>
			<article>
<?php

	echo ' <h2> Authorise Comments. </h2>';  //h2 header of text
	if ($_GET['authorise'] == 'no') {  //authorizing the  comment
		$deleteComment = $dbAccessObject-> deleteComment($_GET['commentId']);  //the authorized comments are deleted
		echo '<p> Comment deleted. </p>';  //prints out comment has been deleted
	}
	if ($_GET['authorise'] == 'yes') {  //authorizing the comment
		$authoriseComment = $dbAccessObject-> updateAuthorisedComment($_GET['commentId']);   //the authorized comments are updated
		echo '<p> Comment approved. </p>';  //prints out comment has been aproved
	}
				
							
					
?>		

			</article>
		</main>
<?php
	require 'footer.php'; //footer of the authorize comment page
?>