<?php
	require 'header.php'; // category page heading
?>
<main>
<?php
	
		require 'leftColumn.php'; //category page left column
	
?>
			<article>
				<h2>Categories</h2>   
<?php 
		if (!isset($_POST['submit']) || empty($_POST['submit'])){ //allow to create and modify categories
			$categories = $dbAccessObject-> retrieveCategories(); //retrieving the categories
			foreach ($categories as $row){  //print out the result from above query
				echo '<p>' . $row['categoryName'] . '</p>';   //category name
			}
			echo '<p> Please type the name of the category you would like to add. </p>  
				<p> Only change the name of categories that don\'t have any articles assigned to them. </p> 
				<form action="categories.php" method="POST">
					<label>Add category: </label> <input type="text" name="addCategory" />
					<label>Delete a category: </label> <input type="text" name="deleteCategory" />
					<label>Edit category: </label> <input type="text" name="editCategory" />
					<label>Change to: </label> <input type="text" name="replaceToCategory" />
					<input type="submit" name="submit" value="Submit" />  
				</form>';			 //ending form tag
		}
		else {
			if (isset($_POST['addCategory']) || !empty($_POST['addCategory'])){  //to add the category to the database from above information
				$addCategoryVerificationResult = $dbAccessObject->checkAddCategory($_POST['addCategory']); //verifying the added category
				if ($addCategoryVerificationResult->rowCount() >= 1){  //verifying the data
					echo '<p> Category is already in the website please use different name. </p>';  //print out if the category has been added or not
					
				}
				else {
					$addCategories = $dbAccessObject->addCategory($_POST['addCategory']);  //adding category
					echo '<p> Category successfully added to the website. </p>'; //printing out the category has been added successfully
				}	
			}
			if (isset($_POST['deleteCategory']) || !empty($_POST['deleteCategory'])){  //this will allow you to delete category from database
				$deleteCategoryVerificationResult = $dbAccessObject->checkDeleteCategory($_POST['deleteCategory']); //deleting the unauthorized category
				if ($deleteCategoryVerificationResult->rowCount() == 0){  //verifying the data
					echo ' <p> Category isn\'t on the website please enter a different category name to delete. </p>';  //printing the category isnt on the website
				}
				else{
					$deleteCategories = $dbAccessObject->deleteCategory($_POST['deleteCategory']);  //deleting the unauthorized category
					echo '<p>Category deleted. </p>'; //printing the category has been deleted
				}
			}

			if (isset($_POST['editCategory']) || !empty($_POST['editCategory']) && isset($_POST['replaceToCategory']) || !empty($_POST['replaceToCategory']) ){ //modifying the category
				$editCategoryVerificationResult = $dbAccessObject->checkEditCategory($_POST['editCategory']);  //editing the verified category
				if ($editCategoryVerificationResult->rowCount() == 0) { //verifying the data
					echo '<p> The category you want to edit doesn\'t exist please type in a valid category. </P>.';  //prints the category to edit doesnt exist
				}
				else {
					$editCategory = $dbAccessObject->updateCategory($_POST['editCategory'], $_POST['replaceToCategory']); //udpating the category
					echo '<p>Category updated.</p>'; //prints out the category has been updated
				}
			}
		
		}
		unset($_POST);  // information stored in the post array is cleared
		
?>
			</article>
			
		</main>
<?php
	require 'footer.php'; // category page footer
?>