<?php
    
    session_start();
    
    // If session variable does not exist, redirect to login screen
    if(!$_SESSION) {
        header("Location: login.php");
    } 
	
?>

Success!