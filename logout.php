<?php



// Initialize the session.
session_start();

// set all session variables to an empty array
$_SESSION = array();

// Finally, destroy the session.
session_destroy();

header("Location: index.php");

