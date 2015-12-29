<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once('connection.php');
require_once ('defines.php');

/* 
 * Function that handels connection to a MySQL database
 */

function connecttoMysql()
{
    global $host, $username, $password, $dbname;
    
    try
    {
        $mysqli = new mysqli($host, $username, $password, $dbname);
        return $mysqli;
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
        exit(0);
    }
}

/* 
 * Function that handels connection to a MongoDB database
 */

function connecttoMongodb()
{
    try
    {
       $mongodb = new MongoClient();
       return $mongodb;
    }
    catch (Exception $e)
    {
       echo $e->getMessage();
       exit(0);
    }
 
}

function login($username, $password)
{
    $mysqli = connecttoMysql();
    
    $username = sanitise($username, 30); 
    $password = sanitise($password, 255);
    //$password = sha1($password);
    $result = false; 
    
    //check if there is an error connecting to database
    if($mysqli->connect_errno){
        echo "Connection with the database failed";
    }
        

    /* Create and execute statement to get the result set/Statement Object */
    if($stmt = $mysqli->query("SELECT username, password FROM user WHERE username = '$username' AND password = '$password'"))
    {
        //iterator to match the results
        while($row = $stmt->fetch_array(MYSQLI_ASSOC))
        {
            if($row['username'] == $username && $row['password'] == $password)
            {
                $result = true;
                break;
            }
        }
    }
    else
    {
        echo "System failed to query DB";
        $result = false; 
    }
    
    $mysqli->close();
    mysqli_free_result($stmt);
    return $result;
}

function getusrInfo($username)
{
    $mysqli = connecttoMysql();
      
    //check if there is an error connecting to database
    if($mysqli->connect_errno){
        echo "Connection with the database failed";
    }
    $stmt = $mysqli->query("SELECT email, isadmin FROM user WHERE username = '$username'");
	
	while($row = $stmt->fetch_object()) {

		$email = $row->email;
                $isadmin = $row->isadmin;
	
	}
        $mysqli->close();
        mysqli_free_result($stmt);
        
        return array($email, $isadmin);
       
}

// function that scans given directory and returns all files and folders contained within directory
function scandirectory($dir)
{
    // create an array for directory content
    
    $dir_content = array();
    
    if(file_exists($dir)){
        foreach (scandir($dir) as $f){
            if(!$f || $f[0] == '.'){
                continue;
            }
            
            if(is_dir($dir . DS . $f)){
                $dir_content[] = array(
                    "name" => $f,
                    "type" => "folder",
                    "path" => $dir . DS .$f,
                    "items" => scandirectory($dir . DS . $f)   
                );
            }
            else {
                $dir_content[] = array(
                    "name" => $f,
                    "type" => "file",
                    "path" => $dir . DS . $f,
                    "size" => filesize($dir . DS . $f)
                );
            }
            
        }
    }
    return $dir_content;
}

/**
* Function to Sanitize or clean to avoid SQL Injections
* Even after this cleaning and house-keeping, Parameter
* binding is used with MySqLI Prepare statements to ensure
* there will be no SQL Injections. 
* 
* @param $string - string to be cleaned
* @param $max - maximum length of string
*/
function sanitise($string, $max)
{
   //preserved only needed characters
   $string = substr($string, 0, $max);

   //strip html                     
   $string = strip_tags($string);

   //convert entities special characters
   $string = htmlspecialchars($string);

   //remove white spaces
   $string = trim(rtrim(ltrim($string)));
   
   //remove white spaces inside the string
   $string = str_replace(' ', '', $string);
   
   return $string;
}

