<?php
	require 'header.php';  //header of the article page
?>
<main>
<?php
	
		require 'leftColumn.php';  //left column of article page
	
?>
			<article>
<?php
	
	$article = $dbAccessObject->retrieveArticle($_GET['article']); //query that gathers all information of article
	foreach ($article as $row){ // print out the results of above query by looping 
		
		echo '<h2>' . $row['articleName'] . '</h2>';    //print out the article name
		echo '<p> Date written: ' . $row['creationDate'] . '</p>';  //date wriiten on article
		echo '<p> Written by: ' . $row['articleAuthor'] . '</p>'; //author of the article content
		echo '<form>'; //form tag
		echo '<p>' . $row['articleContent'] . '</p>'; //article content
		echo '</form>'; //ending form tag
		echo '<form>  
		</form>'; //ending tag
		$comments = $dbAccessObject->retrieveArticleComments($_GET['article']); // the authorized comments of the article are retrieved.
		.
		foreach ($comments as $row) {  //print out the results of the query by looping
			echo '<h4> Name: ' . $row['firstName'] . ' ' . $row['surname'] . '</h4>';  //naming on comment query
			echo '<p> Date written: ' . $row['commentDate'] .'</p>';  //date on the comment added.
			echo '<p> Comment: ' . $row['commentContent'] .'</p>';  //comment writtern by user
			echo '<form>
				</form>';
		}
		if ($_SESSION['loggedIn'] == true){  //it checks whether someone is logged in or not
			$validationResults = validateFields($_POST);  //validating the post that are passed through
			if ($validationResults['isValid']){
				$getCommentId = $dbAccessObject->getCommentId();  //it helps to pull through the comment ID
				$commentContent=preg_replace("/[\n]/","<br>",$_POST['comment']); // to keep spaces in text fields 
				$getCommentId++;  // to add 1 to the comment ID
				$commentDate = date('Y/m/d'); //to add the system date to the comment database.
				$addCommentCriteria = [  //criteria for the add comment query.
						'commentId' => $getCommentId,  //comment ID
						'firstName' => $_SESSION['firstName'],  //first name
						'surname' => $_SESSION['surname'],  //surname
						'email' => $_SESSION['email'],  //email ID
 						'articleName' => $_GET['article'],  //article
						'commentDate' => $commentDate,  //comment date
						'commentContent' => $commentContent, //content of comment
						'authorised' => 'N'];
				$addComment = $dbAccessObject->addComment($addCommentCriteria); //executing the add comment query by running the code
				echo '<p> Comment added. </p>'; //print out the comment has been post.
				unset($_POST); //remove the element
			}
			else {
				// form for the add comment
				echo '  <form action="article.php?article=' . $row['articleName'] . '" method="POST"> 
						<label> Comment: </label><textarea name="comment"> </textarea> //
						<input type="submit" name="submit" value="Submit" />
					</form> ';
			}
		}
		else {
			echo '<p> Please log in inorder to add a comment. </p>'; //user to login before adding comment
		}
	}
		function validateFields($fields){  //validation for page s	 
		$valid = [  //validate the fields if they are false or leave blank if the field isnt valid.
			'isValid' => true,  //validating the field
			'invalidField' => ''  //leaving blank for invalid field
		];
		
		if(!isset($fields['comment']) || empty($fields['comment'])){  //
			$valid['isValid'] = false;  //validating the field
			$valid['invalidField'] = 'comment';  //field is true
		}
		
		return $valid;  //returning the value
	}
?>
			</article>
		</main>
<?php
	require 'footer.php';  //footer of the article page.
?>