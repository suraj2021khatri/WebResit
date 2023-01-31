<?php
	require 'header.php'; //header of the article page
?>
<main>
<?php
	require 'leftColumn.php'; //left side of the article page
?>
			<article>
				<h2>Latest Articles</h2>
				<form>
				</form>
<?php
	$articles = $dbAccessObject->retrieveLatestArticle();  //retrive article in descending order
	foreach ($articles as $row){  //print the result usnig above query
		
		echo '<a href="article.php?article=' . $row['articleName'] . '"><h2>' . $row['articleName'] . '</h2></a> <p> Written by: ' . $row['articleAuthor'] . '</p> <p> Poseted on: ' . $row['creationDate'] . '</p>'; //article are pulled
		echo '<form>';  //form tag
		echo '</form>';  //ending form tag
	}  
?>

			</article>
		</main>
<?php
	require 'footer.php'; //footer of the article page
?>