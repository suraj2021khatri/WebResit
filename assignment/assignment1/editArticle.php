<?php
	require 'header.php';  //header of article page
?>
<main>
<?php
	 
		require 'leftColumn.php';  //left column side of edit article page
	
?>
			<article>
<?php
	
	if ($_GET['edit'] == 'delete') {  //The get array's contents are checked by the if expression. Afterward, each function will be executed based on the data saved in the get.
		echo '<h2> Delete article:</h2>'; //delete article
		$validationResults = validateDeleteFields($_POST); //validating the post fields have been filled or not
		if ($validationResults['isValid']){ // check the article is there inorder to delete it.
			$deleteArticleVerificationResult = $dbAccessObject->checkDeleteArticle($_POST['deleteArticle']); //deleting the article
			if ($deleteArticleVerificationResult->rowCount() == 0){ //verifying the value
				echo '<p> Please try again.Could not find article to delete. </p>'; //prints the value
				}
			else{
				$deleteArticle = $dbAccessObject->deleteArticle($_POST['deleteArticle']); // runs deleteing an article query. 
				echo '<p> Article deleted. </p>'; //prints article deleted.
				unset($_POST);  //removing the element
			}	
		}
		else {
			echo '
			<p> Please type the name of the article you wish to delete. </p>
				<form action="editArticle.php?edit=delete" method="POST">
					<label>Article: </label> <input type="text" name="deleteArticle" />
					<input type="submit" name="submit" value="Submit" />
				</form>';
		}
	}
	if ($_GET['edit'] == 'editArticleName') {  // edits an article name below. 	
		echo '<h2> Change an article\'s name:</h2>';  //changed article name
		$validationResults = validateEditArticleNameFields($_POST);  //Verifies that the post array's fields are correctly filled up.
		if ($validationResults['isValid']){  //validation result invalid
			$editArticleVerificationResult = $dbAccessObject->checkEditArticle($_POST['articleName']); //To ensure that the article is present, check to modify it.
			if ($editArticleVerificationResult->rowCount() == 0){ //verifying the result
				echo '<p>Please try again.Could not find article to edit. </p>'; //prints the value
				}
			else{
				$editArticleName = $dbAccessObject->editArticleName($_POST['articleName'], $_POST['newArticleName']); //change the article name
				echo '<p> Article name changed. </p>'; //prints article name changed.
				unset($_POST);  //removing the element
			}	
		}
		else {
			echo '<p> Please type the name of the article you wish to edit. </p> 
				<form action="editArticle.php?edit=editArticleName" method="POST">
					<label>Article name: </label> <input type="text" name="articleName" />
					<label>New article name: </label> <input type="text" name="newArticleName" />
					<input type="submit" name="submit" value="Submit" />
				</form>';
		}
	}
	// the below edits the authour of the articles. 
	if ($_GET['edit'] == 'editArticleAuthor') {
		echo '<h2> Change an article\'s author:</h2>';
		// validates the information as before. 
		$validationResults = validateEditArticleAuthorFields($_POST);
		if ($validationResults['isValid']){
			// this checks the article is in the database to edit. 
			$editArticleVerificationResult = $dbAccessObject->checkEditArticle($_POST['articleName']);
			if ($editArticleVerificationResult->rowCount() == 0){
				echo '<p> could not find article to edit. Please retry the process. </p>';
				}
			else{
				// the below updates the authour on an article. 
				$editArticleAuthor = $dbAccessObject->editArticleAuthor($_POST['articleName'], $_POST['newArticleAuthor']);
				echo '<p> Article Author has been changed. </p>';
				unset($_POST);
			}	
		}
		else {
			echo '<p> Please type the name of the article you wish to change. </p>
				<form action="editArticle.php?edit=editArticleAuthor" method="POST">
					<label>Article name: </label> <input type="text" name="articleName" />
					<label>New authors name: </label> <input type="text" name="newArticleAuthor" />
					<input type="submit" name="submit" value="Submit" />
				</form>';
		}
	}
	// edits an articles category. 
	if ($_GET['edit'] == 'editArticleCategory') {
		echo '<h2> Change an article\'s category:</h2>';
		// checks the fields have been filled out. 
		$validationResults = validateEditArticleCategoryFields($_POST);
		if ($validationResults['isValid']){
			// check the article is there. to edit.
			$editArticleVerificationResult = $dbAccessObject->checkEditArticle($_POST['articleName']);
			if ($editArticleVerificationResult->rowCount() == 0){
				echo '<p> could not find article to edit. Please retry the process. </p>';
			}
			else{
				// checks that the category is stored in the database already. 
				$editCategoryVerificationResult = $dbAccessObject->checkEditCategory($_POST['newArticleCategory']);
				if ($editCategoryVerificationResult->rowCount() == 0){
					echo '<p> The category is not listed. Please add this category before setting it to any articles by using the tool bar.</p>'; 
				}
				else{
				//	this updates the article category. 
					$editArticleAuthor = $dbAccessObject->editArticleCategory($_POST['articleName'], $_POST['newArticleCategory']);
					echo '<p> Article category has been changed. </p>';
					unset($_POST);
				}
			}	
		}
		else {
			echo '<p> Please type the name of the article you wish to change. </p>
				<form action="editArticle.php?edit=editArticleCategory" method="POST">
					<label>Article name: </label> <input type="text" name="articleName" />
					<label>New article category: </label> <input type="text" name="newArticleCategory" />
					<input type="submit" name="submit" value="Submit" />
				</form>';
		}
	}
	if ($_GET['edit'] == 'editArticleContent') {  //edit the article content
		echo '<h2> Change an article\'s content:</h2>';  //header for article content chanaged
		$validationResults = validateEditArticleContentFields($_POST);  // check that the fields have been filled out correctly. 
		if ($validationResults['isValid']) {  //invalid validation
			$editArticleVerificationResult = $dbAccessObject->checkEditArticle($_POST['articleName']); // check the article is in the article already.
			if ($editArticleVerificationResult->rowCount () == 0) { //verifying the value
				echo '<p>Please try again.Could not find article. </p>';  //prints the value
			}
			else {
				if (!isset($_POST['articleName']) || empty($_POST['articleName']) || !isset($_POST['articleContent']) || empty($_POST['articleContent'])) { // Verify that the fields are set. 
					echo '<p>Please restart the content and double check to ensure the content hasnt changed. </p>';  //prints the value
					}
					else {
						echo '<p> updated </p>'; //updated
						echo '<p>Please click the link below to access the article.</p>';  //prints the value
						echo '<a href="article.php?article=' . $_POST['articleName'] . '"><p>' . $_POST['articleName'] . '</p>';   //linking article
						$articleContent=preg_replace("/[\n]/","<br>",$_POST['articleContent']); //The following line is advantageous for text fields. This is achieved by replacing every n (newline) with br.
						$editArticleContent = $dbAccessObject->editArticleContent($articleContent, $_POST['articleName']); //editing the article content
						unset($_POST);  //removing the element
					}
			}
		}
		else {
			echo '<p> Please type the name of the article you wish to edit and the new content. </p>
				<form action="editArticle.php?edit=editArticleContent" method="POST">
					<label>Article name: </label> <input type="text" name="articleName" />
					<label>Article content:</label><textarea name="articleContent"></textarea>
					<input type="submit" name="submit" value="Submit" />
				</form>';
		}
	}
	function validateDeleteFields($fields){ //The functionality listed below helps validate the fields to make sure that the transmitted data is accurate.
		$valid = [  // array for validating the fields if they are false or blank then the field isn't valid	
			'isValid' => true,  //value is true
			'invalidField' => ''  //invalid field
		];
		
		if(!isset($fields['deleteArticle']) || empty($fields['deleteArticle'])){  //delete article
			$valid['isValid'] = false;  //value is false
			$valid['invalidField'] = 'deleteArticle';  //invalid field for delete article
		}
		
		return $valid;  //returning value
	}
	
	function validateEditArticleNameFields($fields){  // array for validating the fields if they are false or blank then the field isn't valid	
	
		$valid = [  //validation
			'isValid' => true,  //value is true
			'invalidField' => ''  //invalid field
		];
		
		if(!isset($fields['articleName']) || empty($fields['articleName'])){   //article name
			$valid['isValid'] = false;  //value is false
			$valid['invalidField'] = 'articleName';  //invalid field for article name
		}
		if(!isset($fields['newArticleName']) || empty($fields['newArticleName'])){  //new article name
			$valid['isValid'] = false;  //value is false
			$valid['invalidField'] = 'newArticleName';   //invalid field for new article name
		}
		 
		return $valid;  //returning value
	}
	
	function validateEditArticleAuthorFields($fields){  // 	array for field validation The field is invalid if they are false or empty.
	         $valid = [  //validation
			'isValid' => true, //value is true
			'invalidField' => ''  //invalid field
		];
		
		if(!isset($fields['articleName']) || empty($fields['articleName'])){   //article name
			$valid['isValid'] = false;  //value is false
			$valid['invalidField'] = 'articleName';  //invalid field for article name
		}
		if(!isset($fields['newArticleAuthor']) || empty($fields['newArticleAuthor'])){  //article author
			$valid['isValid'] = false;  //value is false
			$valid['invalidField'] = 'newArticleAuthor';  //invalid field for article name
		}
		
		return $valid;  //returning value
	}
	
	function validateEditArticleCategoryFields($fields){  // array to check the fields The field is invalid if they are false or empty.
		    $valid = [   //validation 
			'isValid' => true,  //valid is true
			'invalidField' => ''  //invalid field
		];
		
		if(!isset($fields['articleName']) || empty($fields['articleName'])){  //article name
			$valid['isValid'] = false;  //value is false
			$valid['invalidField'] = 'articleName';  //invalid field for article name
		}
		if(!isset($fields['newArticleCategory']) || empty($fields['newArticleCategory'])){  //new article category
			$valid['isValid'] = false;  //value is false
			$valid['invalidField'] = 'newArticleCategory';  //invalid field
		}
		
		return $valid;  //returning value
	}
	
	function validateEditArticleContentFields ($fields){  // array for field validation The field is invalid if they are false or empty.
		$valid = [   //validation
			'isValid' => true,   //value is true
			'invalidField' => ''  //invalid field
			];
		
		if(!isset($fields['articleName']) || empty ($fields['articleName'])) {  //article name
			$valid['isValid'] = false;   //value is false
			$valid['invalidField'] = 'articleName';  //invalid field
		}
		
		return $valid;  //returning the value
	}
?>
			</article>
		</main>
<?php
	require 'footer.php'; // article edit page footer
?>