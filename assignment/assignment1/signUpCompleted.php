<?php
	require 'header.php'; //header for signup completed page.
?>
<main>
<?php
	require 'leftColumn.php'; //left column side for signup completed page
?>
			<article>
<?php
	$validationResults = validateFields($_POST);  //sign up forms fields have been completed and are set are verified
	if ($validationResults['isValid']){  //if clause to continue running until all fields have been filled in
		$emailVerificationResult = $dbAccessObject->getUsersByEmail($_POST['email']); //it sends email from the form to a function in order to make sure it is in database or not
		if ($emailVerificationResult->rowCount() >= 1){	 //verifying the data
			echo '<p>Email address taken already please enter another email address. </p>'; //print out the email have been used already
		}
		else {
		$Uiplacements = [  	//use the insert function. Send the array below to it.
				'FirstName' => $_POST['fName'],  //firstname
				'Surname' => $_POST['sName'],   //surname
				'DOB' => $_POST['dob'],  //date of birth
				'Email' => $_POST['email'],  //email ID
				'Password' => sha1($_POST['email'] . $_POST['pass'])];  //password
			$userInserted = $dbAccessObject->insertUser($Uiplacements);  //verifying the user inserted
			echo '<p> Please login. You have been added to the database. </p>'; //prints you can login you have been added to the database
			
		}
	}
	// If the fields are not validated, which implies the boxes are empty, the code below executes. This will display the field that has been left empty.
	else {
		echo '<p> Please fill out the boxes unable to sign up. </p>';  //prints signup first
	}
	function validateFields($fields){   //this verifies that the fields on signup page are filled out as per requested
		$valid = [  //array for field validation the field is invalid if they are false or empty
			'isValid' => true,  //verifying value
			'invalidField' => ''  //left blank
		];
		
		if(!isset($fields['fName']) || empty($fields['fName'])){  //verifying first name
			$valid['isValid'] = false;  //false value
			$valid['invalidField'] = 'fName';  //invalid field cause its value is false
		}
		
		if(!isset($fields['sName']) || empty($fields['sName'])){  //verifying surname
			$valid['isValid'] = false;  //false value
			$valid['invalidField'] = 'sName';  //invalid field cause its value is false
		}
		
		if(!isset($fields['dob']) || empty($fields['dob'])){  //verifying date of birth
			$valid['isValid'] = false;  //false value
			$valid['invalidField'] = 'dob';  //invalid field cause its value is false
		}
		
		if(!isset($fields['email']) || empty($fields['email'])){  //veirfying email
			$valid['isValid'] = false;  //false value
			$valid['invalidField'] = 'email';  //invalid field cause its value is false
		}
		if(!isset($fields['pass']) || empty($fields['pass'])){  //verifying password
		
			$valid['isValid'] = false;  //false value
			$valid['invalidField'] = 'pass';  //invalid field cause its value is false
		}
		
		return $valid;  //returing the value
	}
?>

			</article>
		</main>
<?php
	require 'footer.php'; //signup page footer
		

?>

