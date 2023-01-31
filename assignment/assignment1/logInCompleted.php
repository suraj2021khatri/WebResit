<?php
	require 'header.php';  //header of login completed page
	
?>
<main>
<?php
		$validationResults = validateFields($_POST);  //validating the fields
	
		if ($validationResults['isValid']){  //checks the value provided matches with database or not
			$pass = sha1($_POST['email'] . $_POST['pass']);  //passowrd
			$userEmailValidation = $dbAccessObject->getUsersByEmail($_POST['email']);  //email verified 
			$userPassValidation = $dbAccessObject->usersPass($pass);  //password validation
			$email = $_POST['email'];	 //email ID
			
			
			
			if ($userEmailValidation->rowCount() == 1){	 //validating the email value
			
				if ($userPassValidation->rowCount() == 1){  //validating the password value
					$firstName = $dbAccessObject->fetchFirstName($email);  //fetching the first name
					$surname = $dbAccessObject->fetchSurname($email);  //fetching the surname
					$_SESSION['loggedIn'] = true;  //value is true
					$_SESSION['email'] = $email;  //email ID
					$_SESSION['firstName'] = $firstName;  //first name
					$_SESSION['surname'] = $surname;  //surname
					require 'leftColumn.php';  //left column side of login page
					echo '<h2>Logged in Successfully. </h2>';  //prints out login successful
					echo '<p>You have access now please enjoy all the functions </p>'; //prints the value
					
				}
				else {
				require 'leftColumn.php';  //left column side 
				echo '<h4> Incorrect Information: </h4>';  //prints incorrect information 
				echo ' <p>Please check your password again unable to login. </p>'; //printing unable to login
			
			}
			}
		
			else {
				require 'leftColumn.php';  //left column side
				echo '<h4> Incorrect Information: </h4>';  //prints incorrect information
				echo ' <p>Please check the credentials and try again. Unable to login. </p>';  //prints the given value
		
			}
		}
		else {
				require 'leftColumn.php';  //left column side
				echo '<h4> Incorrect Information: </h4>';  //incorrect information 
				echo ' <p> Please check the credentials and try again.Unable to login. </p>'; //prints the given valuess
			
			}
		

		
		
?>
			<article>
<?php
	function validateFields($fields){  //verifies that the fields on the log-in page's form have been filled out or not.
	   $valid = [   // array for field validation The field is invalid if they are false or empty.
			'isValid' => true,  //value is true
			'invalidField' => ''   //invalid field
		];
		
		if(!isset($fields['email']) || empty($fields['email'])){  //validating the email ID
			$valid['isValid'] = false;  //invalid cause value is false
			$valid['invalidField'] = 'email';  //invalid field
		}
		if(!isset($fields['pass']) || empty($fields['pass'])){  //validating password
		
			$valid['isValid'] = false;   //invalid cause value is false
			$valid['invalidField'] = 'pass';    //invalid field
		}
		
		return $valid;  //returning the value
	}
?>
	</article>
			
		</main>
<?php
	require 'footer.php'; //login completed page footer.
?>