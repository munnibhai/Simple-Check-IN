<?php
	
	include "links.php";
?>

<?php
	//Get username from 
	$date = DATE('Y-m-d');
	$users = array();
	$getUsers = new DOMDocument;
	$getUsers->preserveWhiteSpace = false;
	$getUsers->load('config.xml');
	$showUsers = $getUsers->documentElement;
	foreach($showUsers->childNodes as $user){
		$users[] = $user->nodeValue;
	}
	
	if(isset($_GET['error'])){
		$errCode = $_GET['error'];
		$userTry = $_GET['userTry'];
		echo "<div class='error'>". $userTry . " :: " . $lang[$errCode] . "</div>";
		echo "<div class='clear'></div>";
	}
	
	foreach($users as $username){
		include "index2.php";
	}
?>