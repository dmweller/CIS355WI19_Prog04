<?php

session_start();

require_once 'database.php';

if($_GET) $errorMessage = $_GET['errorMessage'];
else $errorMessage = '';

// If successful log in
if($_POST) {
    $success = false;
    $username = $_POST['username'];
    $password = $_POST['password'];
    //$password = MD5($password);
    
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM customers WHERE email  = '$username' AND password = '$password' LIMIT 1";
    $q = $pdo->prepare($sql);
    $q->execute(array());
    $data = $q->fetch(PDO::FETCH_ASSOC);
    
    // If successful go to success.php
    if($data) {
        $_SESSION["username"] = $username;
        header("Location: customers.php");
    } else { // else go back to login.php
        header("Location: login.php?errorMessage=Invalid");
        exit();
    }
}
// else show empty login form


?>

<a href="https://github.com/dmweller/CIS355_WI19_Prog01">Github Link to Program01</a>

<h1>Log in</h1>

<form class = "form-horizontal" action = "login.php" method = "post">
    
    <input name="username" type="text" placeholder="me@email.com" required>
    <input name="password" type="password" required>
    <button type="submit" class="btn btn-success">Sign in</button>
    <a href='logout.php'> Log out </a>
    
    <p style='color: red;'><?php echo $errorMessage; ?></p>
    
</form>