<?php
	require 'header.php'; //header for the users page.
?>
<main>
<?php
	require 'leftColumn.php'; //left column side of users page.
?>
			<article>
<?php
	echo ' <h2> Edit User: </h2>'; //edit user
	if (!isset($_POST['submit']) || empty($_POST['submit'])){  // decides what modification to be needed.
		echo ' <p> Please make some changes to a user below. </p> ';  //prints the value
		echo ' <p> If you wish to delete a user you must enter their email address in the account you want to edit box and the delete box. </p> '; //prints the value
	
		echo ' <form action="users.php?edit=user" method="POST">   
							<label> user\'s email address of the account you want to edit:<input type="text" name="email" />
							<label>Change first name:</label> <input type="text" name="firstName" />
							<label>Change surname:</label> <input type="text" name="surname" />
							<label>Change date of birth:</label> <input type="date" name="dob" />
							<label>Change Email:</label> <input type="text" name="newEmail" />
							<label>Change Password:</label> <input type="text" name="password" />
							<label> Enter email address of user you wish to delete:<input type="text" name="delete" />
							<input type="submit" name="submit" value="Submit" />
				</form>';  //ending tag
	} 
	else {
		if (!isset($_POST['email']) || empty($_POST['email'])) {  // It confirms that the user's email has been entered in order to identify the person who will be modified.
			echo ' <p> Please fill out the first box on the previous page if the account you wish to modify has not yet been entered. </p>';  //prints the value
		}
		else{
			$emailVerificationResult = $dbAccessObject->getUsersByEmail($_POST['email']);  //verifying the email ID
			if ($emailVerificationResult->rowCount() >= 1){	  //verifying the value
				if (!isset($_POST['firstName']) || empty($_POST['firstName'])){  //modifying users first name

				}
				else {
					$changeUserFirstName = $dbAccessObject->updateUserFirstName($_POST['firstName']);  //changing users first name
					
					if ($changeUserFirstName == true) {  //users first name changed 
						echo '<p> The User\'s first name has been changed to ' . $_POST['firstName'] . '.</p>';  //prints out the changed user name
					}
					else {
						echo '<p> Please try the process again because it failed the first time. </p>';  //prints out the value
					}
				}	
				if (!isset($_POST['surname']) || empty($_POST['surname'])) {  //changes the users surname
					
				}
				else {
					$changeUserSurname = $dbAccessObject->updateUserSurname($_POST['surname']);  //updates the surname
					
					if ($changeUserSurname == true) {  //users surname changed
						echo '<p> The User\'s surname has been changed to ' . $_POST['surname'] . '.</p>';  //prints out the changed surname
					}
					else {
						echo '<p>Please try the process again because it failed the first time. </p>'; //pritns out the value
					}
				}
				
				if (!isset($_POST['dob']) || empty($_POST['dob'])) {  //modifying date of birth
					
				}
				else {
					$changeUserDob = $dbAccessObject->updateUserDob($_POST['dob']);  //changing date of birth
					
					if ($changeUserDob == true) {  //date of birth changed
						echo '<p> The User\'s DoB has been changed to ' . $_POST['dob'] . '.</p>';  //prints out the changed date of birth
					}
					else {
						echo '<p> Please rerun the process again the process has failed. </p>'; //prints out value
					}
				}

				if (!isset($_POST['password']) || empty($_POST['password'])) {  //modifying the users password
					
				}
				else {
					$changeUserPassword = $dbAccessObject->updateUserPassword($_POST['password']);  //changing users password
					
					if ($changeUserPassword == true) {  //users password changed
						echo '<p> The User\'s password has been changed.</p>';  //prints the changed password
					}
					else {
						echo '<p> Please rerun the process again the process has failed.  </p>';  //prints the value
					}
				}
		
				if (!isset($_POST['delete']) || empty($_POST['delete'])) { //deleting a user from the database
					
				}
				else {
					$emailVerificationResult = $dbAccessObject->getUsersByEmail($_POST['delete']);  //verifying email ID
					if ($emailVerificationResult->rowCount() >= 1){  //verifying the value
						$deleteUser = $dbAccessObject->deleteUser($_POST['delete']);  //user deleted
						
						if ($deleteUser == true) {  //verifying the user
							echo '<p>User deleted. </p>';  //prints user deleted
						}
						else {
							echo '<p>Please rerun the process again the process has failed.  </p>'; //prints the value
						}
					}
					else {
						echo '<p> User not found to delete. </p>'; //prints user not found
					}
				}
			
			if (!isset($_POST['newEmail']) || empty($_POST['newEmail'])) {  //modifying users email address
					
				}
				else {
					$emailVerificationResult = $dbAccessObject->getUsersByEmail($_POST['newEmail']);  //verifying email address
					if ($emailVerificationResult->rowCount() == 0){	 //verifying the value
						$changeUserEmail = $dbAccessObject->updateUserEmail($_POST['newEmail']); //changing user email address
						
						if ($changeUserEmail == true) {  //verifying value
							echo '<p> The User\'s email has been changed to ' . $_POST['newEmail'] . '.</p>'; //prints changed email address.
						}
						else {
							echo '<p>Please rerun the process again the process has failed.  </p>';  //prints the value
						}
					}
					else {
						echo '<p> Please use a distinct email address. Email address: ' . $_POST['newEmail'] . ' is already in use.</p>';  //ask user to enter new address
					}
				}
				
			}
			else {
				echo '<p>Email address not found.Try Again</p>';  //prints email not found.
			}
		}
	}
				
				
?>				
	
			</article>
		</main>
<?php
	require 'footer.php'; //footer for the users page.
?>