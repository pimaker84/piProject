<?php 
session_start();
require_once 'includes/functions.php'; 
?>



<?php

if(isset($_POST['submitlog'])) {
    if(!empty($_POST['username'])|| !empty($_POST['password'])){
    $usrn = $_POST['username'];
    $paswd = $_POST['password'];
    }
    
    
    if(login($usrn, $paswd))
    {
        list($usremail, $admin) = getusrInfo($usrn);
        
        $_SESSION['username'] = $usrn;
        $_SESSION['email'] = $usremail;
        $_SESSION['admin'] = $admin;       
        
        //redirect to main
        header("Location: main.php");   
    }
    else 
    {
        echo "Wrong username or password";
    }
}

?>



<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no" />
<title>PIstorage login</title>
<script type="text/javascript" src="jscripts/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="jscripts/bootstrap.min.js"></script>
<script type="text/javascript" src="jscripts/lightbox/source/jquery.fancybox.js"></script>
<script type="text/javascript" src="jscripts/main.js"></script>

<link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="jscripts/lightbox/source/jquery.fancybox.css" rel="stylesheet" type="text/css">
</head>

<body>

<header>
<a class="modalbox" href="#login-form"><button class="btn-danger login-btn login-header-btn">Login</button></a>
</header>

<div class="container">
<div id="login-form">
  <div class="modalclosebtn">X</div>
  <div class="title">Login</div>
  <form method="post" action="index.php">
  <div class="formlabel">Username</div>
  <div class="input"><input type="text" name="username" placeholder="Enter your username"></div>
  <div class="formlabel">Password</div>
  <div class="input"><input type="password" name="password" placeholder="Enter your password"></div>
  <div class="form-btn"><input class="login-btn" type="submit" name="submitlog" value="Login"></div>
  </form>
</div>
</div>

</body>
</html>
