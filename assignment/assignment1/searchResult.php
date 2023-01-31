<?php
	require 'header.php'; //header page for seacrh result page.
?>
<main>
<?php
	require 'leftColumn.php'; //left column page for search result page
?>
			<article>
<?php
	echo ' <h2> Search Function. </h2>'; //search function header
	$validationResults = validateSearchFields($_POST); //validating post
	
	if ($validationResults['isValid']) {  //validation 
		
		if (!isset($_POST['article']) || empty($_POST['article'])){  //based on article titles, searches for articles.
		}
		else if ($_POST['article'] == 'on') {  //post article
			$searchArticleName = $dbAccessObject->retrieveArticle($_POST['keyword']);  //retrieving article name
			if ($searchArticleName->rowCount () == 0) {  //verifying data
				echo '<p> No articles found by this name. </p>'; //print this value
			}
			foreach ($searchArticleName as $row) { 
				echo '<a href="article.php?article=' . $row['articleName'] . '"><h2>' . $row['articleName'] . '</h2></a>';  //linking article name
				echo '<p> Date written: ' . $row['creationDate'] . '</p>'; //creation date
				echo '<p> Written by: ' . $row['articleAuthor'] . '</p>'; //author name
				echo '<form>
				</form>';	 //ending form tag
			} 
		}
		
		if (!isset($_POST['category']) || empty($_POST['category'])){  // Before pulling through articles, /checks to see if the category radio button has been selected.
			
		}
		else if ($_POST['category'] == 'on') {  //post function
				$searchArticleCategory = $dbAccessObject->retrieveArticleByCategory($_POST['keyword']);  //retrieving article category
					if ($searchArticleCategory->rowCount () == 0) { //verifying data
						echo '<p> No articles in this category. </p>';  //printing the written value
					}
					foreach ($searchArticleCategory as $row) {   //print out the results of the query by looping
						echo '<a href="article.php?article=' . $row['articleName'] . '"><h2>' . $row['articleName'] . '</h2></a>'; //article name
						echo '<p> Date written: ' . $row['creationDate'] . '</p>'; //creation date
						echo '<p> Written by: ' . $row['articleAuthor'] . '</p>';  //article author
						echo '<p> Category: ' . $row['categoryName'] . '</p>'; //category name
						echo '<form>
						</form>'; 	  //form tag ending
					}
		}
		
		if (!isset($_POST['author']) || empty($_POST['author'])){  //based on author name, search for author
		
		}
		else if ($_POST['author'] == 'on') {  //calling post functiom
				$searchArticleAuthor = $dbAccessObject->retrieveArticleByAuthor($_POST['keyword']); //retrieve article author
					if ($searchArticleAuthor->rowCount () == 0) { //verifying data
						echo '<p> No articles by this author. </p>'; //print the written value
					}
					foreach ($searchArticleAuthor as $row) { //print out the results of the query by looping
						echo '<a href="article.php?article=' . $row['articleName'] . '"><h2>' . $row['articleName'] . '</h2></a>'; //article name
						echo '<p> Date written: ' . $row['creationDate'] . '</p>'; //creation date
						echo '<p> Written by: ' . $row['articleAuthor'] . '</p>'; //article author
						echo '<form>
						</form>'; 	 //ending form tag
					}
		}
		
		if (!isset($_POST['user']) || empty($_POST['user'])){  // find users by name 
		
		}
		else if ($_POST['user'] == 'on') {  //post function
				$searchUsers = $dbAccessObject->retrieveUserByName($_POST['keyword']);  //retrieve value by searching user
					if ($searchUsers->rowCount () == 0) {  //verifying data
						echo '<p> No users found by this name. </p>';   //print out this value
					}
					foreach ($searchUsers as $row) {  //print out the results of the query by looping
						echo '<a href="userComments.php?email=' . $row['Email'] . '"><h2>' . $row['FirstName'] . " " . $row['Surname'] . '</h2></a>';  //comments of user
						echo '<p> Email: ' . $row['Email'] . '</p>';  //email ID
						echo '<form>
						</form>'; 	//end form tag
					}
		}
		else {
			echo ' <p> Please use the radio options to choose your search criteria. </p>'; //text field
		}
	}
	else {
		echo '<p> a keyword must be entered in the search field. </p>'; //text field 
	}
	
	function validateSearchFields($fields){   // The following validates that the data has been entered.
	$valid = [                       // array for field validation The field is invalid if they are false or empty.
			'isValid' => true,  //value is true
			'invalidField' => ''  //invalid field
		];
		
		if(!isset($fields['keyword']) || empty($fields['keyword'])){  // verify that the keyword was entered.
			$valid['isValid'] = false;  //value is false
			$valid['invalidField'] = 'radio';  //keyword was entered.
		}
		
		return $valid;  //returning value
	}
?>		

			</article>
		</main>
<?php
	require 'footer.php'; // footer for search result page.
?>