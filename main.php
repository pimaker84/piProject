<?php
require_once ('includes/functions.php');
require_once ('includes/defines.php');
session_start();

//check if ther exist in the session, otherwise redirct to index page

if(!isset($_SESSION['username']))
{
    //destroy the session
    session_destroy();
    
    //redirect to limit access to this resource
    header("Location: index.php");
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, user-scalable=no" />
<title>PIstorage main</title>
<script type="text/javascript" src="jscripts/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="jscripts/bootstrap.min.js"></script>
<script type="text/javascript" src="jscripts/lightbox/source/jquery.fancybox.js"></script>
<script type="text/javascript" src="jscripts/main.js"></script>
<script type="text/javascript" src="jscripts/treeview.js"></script>

<link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="styles/style.css" rel="stylesheet" type="text/css">
<link href="jscripts/lightbox/source/jquery.fancybox.css" rel="stylesheet" type="text/css">
<link href="styles/font-awesome.css" rel="stylesheet" type="text/css">
</head>

<body>

<header class="index_header">

<nav class="navbar navbar-default custom-nav">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">PIstorage</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav navbar-right">
          <li><a href="main.php?tab=storage"><div class="items"><span class="fa fa-database"></span> Storage</div></a></li>  
          <li><a href="main.php?tab=messages"><div class="items"><span class="fa fa-envelope"></span> Messages</div></a></li>
        <li><a href="logout.php"><div class="items"><span class="fa fa-sign-out"></span> Logout</div></a></li>
        
      </ul>
    </div><!-- navbar-collapse -->
  </div><!-- container-fluid -->
</nav>

<div class="icon_bar">
<span class="fa fa-envelope-o"></span>
<span class="fa fa-files-o"></span>
<span class="fa fa-user-plus"></span>
</div>

</header>

<div class="container-fluid">
  <div class="row">
      <!--
    <div class="sidebar">
      <div class="section_heading">Private Storage</div>
      <a href="main.php?tab=internal"><div class="items active"><span class="fa fa-floppy-o"></span>Internal Storage</div></a>
      <a href="#"><div class="items"><span class="fa fa-hdd-o"></span>Drive</div></a>
      <div class="section_heading">Shared Storage</div>
      <a href="#"><div class="items"><span class="fa fa-users"></span>Users</div></a>
      <a href="#"><div class="items"><span class="fa fa-dropbox"></span>Files</div></a>
      <a href="#"><div class="items"><span class="fa fa-cloud"></span>Drive</div></a>
    </div>-->
      
<?php
   
    $sidebar = $_GET['tab'];
    
    if($sidebar == 'storage'){
        
        include 'contents/storage_nav.php';
    }
    elseif($sidebar == 'messages'){
        
        include 'contents/message_nav.php';
        
    }  else {

       include 'contents/storage_nav.php';
    }
  


?>
    
<div class="content">
    <div class="handler">

<?php

    $maincontent = $_GET['id'];
    
    if($maincontent == 'storage'){
        
    }  else {
        include 'contents/upload.php';
        include 'contents/storage_content.php';
        
    }

?>    
 
       
                               
    </div>
          
</div>
  </div>
</div>

<div class="footer">&copy; Copyright 2015</div>

</body>
</html>
