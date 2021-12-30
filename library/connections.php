<?php

/*
* proxy connection to hte phpmotors database
*/
function phpmotorsConnect() {
    
$server = 'localhost';
$dbname ='phpmotors';
$username = 'iClient';
$password = '************';
//password removed for github.

$dsn = "mysql:host=$server;dbname=$dbname";

$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

// Create the actual connection object and assign it to a variable
try {
$link = new PDO($dsn, $username, $password, $options);
// var_dump($dsn);
// exit;
if (is_object($link)){
    // I am just adding a header to the index so the page does something on success
   
}
return $link;
} catch(PDOException $e) {
    echo 'it didnt work, error: '. $e->getMessage();
header('Location: /phpmotors/view/500.php');
exit;
}
}
