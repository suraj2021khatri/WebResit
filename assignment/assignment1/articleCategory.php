<?php
	require 'header.php'; // header of the category page
?>
<main>
<?php
	require 'leftColumn.php'; // left column of category page
?>
			<article>
<?php
		if ($_GET['category'] == 'category'){ //gather information from category
			$categories = $dbAccessObject-> retrieveCategories(); // the authorized categories of the article are retrieved.
			foreach ($categories as $row){  //print out result using above query
				echo '<a href="articleCategory.php?category=' . $row['categoryName'] . '"><h4>' . $row['categoryName'] . '</h4>';
				echo '<form>';
				echo '</form>';
			}
		}
		else{
			$articles = $dbAccessObject->retrieveArticles($_GET['category']);  //to grab the categories it uses the retrive article fucntion
			if ($articles ->rowCount() == 0) { //using loop it displays the result. it will show a list of all the categories that are available.
				echo '<p> Unfortunately there is no articles for this category. </p>'; //print out no result in the category
			}
			else {
				foreach ($articles as $row){  //print out result using above query
					echo '<a href="article.php?article=' . $row['articleName'] . '"><h2>' . $row['articleName'] . '</h2></a> <p> Written by: ' . $row['articleAuthor'] . '</p> <p> Posted on: ' . $row['creationDate'] . '</p>'; //linkiing all the queries
					echo '<form>';  //form tag
					echo '</form>';  //ending form tag
				}
			}
		}	
				
							
					
?>		

			</article>
		</main>
<?php
	require 'footer.php';  // footer of the article page
?>