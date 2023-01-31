<?php
	session_start();  //run session on all the page
	if(!isset($_SESSION['loggedIn'])){ //checks if someone is logged in or not
		$_SESSION['loggedIn'] = false; //verifying the data
	}
	require 'dbAccessObject.php'; //connecting to the database
	$server = 'v.je';  // sets the variables for connecting with the database. 
	$username = 'student';  //username
	$password = 'student';  //password
	$schema = 'Northampton_News';  //schema
	$dbAccessObject = new DbAccessObject($server, $username, $password, $schema);  //passes the variable throguh connecting to the database
	$pdo = $dbAccessObject->getPdo();  //using PDO function
	$Categories = $dbAccessObject->retrieveCategories();  //retrieve through the categories
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="styles.css"/>  
		<title>Northampton News - Home</title>  
	</head>
	<body>
		<header>
			<section>
					<h1>Northampton News</h1>
			</section>
		</header>
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li> 
				<li><a href="latestArticle.php">Articles</a></li>
				<li><a href="articleCategory.php?category=category">Categories</a>
				<ul>
<?php

	foreach ($Categories as $row){  //print out the result using query
			echo '<li><a href="articleCategory.php?category=' . $row['categoryName'] . '">' . $row['categoryName'] . '</a></li>'; //categories are pulled
		
	} 

?>
				</ul>
				</li>
				<li><a href="contact.php">Contact us</a></li>  
			</ul>
		</nav>
		<img src="images/banners/randombanner.php" />   
		