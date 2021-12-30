<?php
// This is the main controller

// Create or access a Session
session_start();
date_default_timezone_set('America/Phoenix');

require_once 'library/connections.php';
require_once 'model/main-model.php';
require_once 'library/functions.php';
// Get the array of classifications
$classifications = getClassifications();
                

// var_dump($classifications);
// 	exit;

// Build a navigation bar using the $classifications array
// $navList = '<ul id = "nav-list">';
// $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
// foreach ($classifications as $classification) {
//  $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
// }
// $navList .= '</ul>';

$navList = buildNav($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}
// Check if the firstname cookie exists, get its value
if(isset($_COOKIE['firstname'])){
  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
 }

switch ($action){
  
    
    
    default:
    
     include 'view/home.php';
   }