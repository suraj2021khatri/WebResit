<?php
	require 'header.php'; // header of the page

?>
<main>
<?php
	require 'leftColumn.php'; // left column of the page
?>
			<article>
				<h2>Add a new article.</h2>
<?php
			  
			$validationResults = validateFields($_POST); //runing the validation function for what value is entered.
				if (!isset($_POST['submit']) || empty($_POST['submit'])){ // submit function 
					/* creating form for article content   */
					echo '<form action="addArticle.php" method="POST">      
						<label> Article name:<input type="text" name="articleName" /> 
						<label>Article author:</label> <input type="text" name="articleAuthor" />
						<label>Article date:</label> <input type="date" name="articleDate" />
						<label>Article category:</label> <input type="text" name="articleCategory" />
						<label>Article content:</label><textarea name="articleContent"> </textarea>
						<input type="submit" name="submit" value="Submit" />
					</form>';
					
				}
				
				else{
					if ($validationResults['isValid']){ // checking whether the fields are filled or not and executing adding the article using the data above.
						$addArticleVerificationResult = $dbAccessObject->checkArticleName($_POST['articleName']); // checking the article name that hasn't been already used through the article name.
						$checkCategoryName = $dbAccessObject->checkDeleteCategory($_POST['articleCategory']); //checking the category that is used in the database or not otherwise need to create.
						if ($addArticleVerificationResult->rowCount() >= 1){ // verifying the data.
							echo '<p> Article name already used. </p>'; // shows if the article has already been used.
						}
						if ($checkCategoryName->rowCount() == 0){
							echo '<p> Category name has not been added please type in a category that has been added. </p>'; // it shows whether the category has been added or not.
						}
						else {
							$articleContent=preg_replace("/[\n]/","<br>",$_POST['articleContent']); // to create spaces in text fields
							
							$articleCriteria = [ //crieria for adding article query.
												'articleName' => $_POST['articleName'],  //article name
												'articleAuthor' => $_POST['articleAuthor'], //artivle author
												'creationDate' => $_POST['articleDate'], //article date
												'categoryName' => $_POST['articleCategory'],  //article category
												'articleContent' => $articleContent];  //content for article
							$addArticle = $dbAccessObject->addArticle($articleCriteria); //storing it in variable by executing the query.
							echo '<p> Article has been added.</p>'; // shows the article has been added.
						}	
					}
					else{
						echo '<p> please fill out all the boxes. </p>'; //shows if the fields are left empty.
					}
					
				}
			
		function validateFields($fields){ //leaving blank if the field isnt valid or array for validating the fields if they are false.	
		$valid = [
			'isValid' => true,  //validate the fields true.
			'invalidField' => ''
		];
		
		if(!isset($fields['articleName']) || empty($fields['articleName'])){ // array for validation
			$valid['isValid'] = false;  // validating the fields if false
			$valid['invalidField'] = 'articleName';  //invalid field for article name
		}
		
		if(!isset($fields['articleAuthor']) || empty($fields['articleAuthor'])){  // array for validation
			$valid['isValid'] = false;  // validating the fields if false
			$valid['invalidField'] = 'articleAuthor';  //invalid field for article author
		}
		 
		if(!isset($fields['articleDate']) || empty($fields['articleDate'])){   // array for validation
			$valid['isValid'] = false;  // validating the fields if false
			$valid['invalidField'] = 'articleDate';  //invalid field for article date
		}
		
		if(!isset($fields['articleCategory']) || empty($fields['articleCategory'])){  // array for validation
			$valid['isValid'] = false;  // validating the fields if false
			$valid['invalidField'] = 'articleCategory';  //invalid field for article category
		}
		if(!isset($fields['articleContent']) || empty($fields['articleContent'])){  // array for validation
		
			$valid['isValid'] = false;  // validating the fields if false
			$valid['invalidField'] = 'articleContent';  //invalid field for article content
		}
		
		return $valid;  //returing the validation
	}
?>
			</article>
		</main>
<?php
	require 'footer.php'; //footer for the page
?>