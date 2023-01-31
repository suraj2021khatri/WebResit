<?php
	require 'header.php'; //header for search page
?>
<main>
<?php
	require 'leftColumn.php'; //left column side for search page.
?>
			<article>
<?php
	echo ' <h2> Search Function. </h2>'; //heading on the page title with line
	echo ' <p> Select one of the radio buttons depending on what search you wish to carry out. </p>'; //print out the given value
	echo ' <form action="searchResult.php" method="POST">  
					<label>get article by title:</label> <input type="radio" name="article" /> ss
					<label>get article by category:</label> <input type="radio" name="category" />
					<label>get article by author name:</label> <input type="radio" name="author" />
					<label>get user by first name:</label> <input type="radio" name="user" />
					<label>Search:</label> <input type="text" name="keyword" />
					<input type="submit" name="submit" value="Submit" />
			</form>';
	
	
?>		

			</article>
		</main>
<?php
	require 'footer.php'; //footer for search page
?>