<?php
require_once ('../../includes/functions.php');
require_once ('../../includes/defines.php');

  if(!empty($_SERVER['HTTP_X_REQUESTED_WITH'])&&strtolower($_SERVER['HTTP_X_REQUESTED_WITH'])=='xmlhttprequest'){
  		if(isset($_POST['apiKey'])&&trim($_POST['apiKey'])=='123'){
  			$files=scandirectory(STORAGE_ROOT);
 			header('Content-type: application/json');
  			echo json_encode(array(
  				'status'=>'ok',
  				'files'=>$files
  			));
  		}
 }
  
  die();

        
?>