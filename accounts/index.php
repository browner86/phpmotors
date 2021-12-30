<?php
//This is the accounts controller

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';

// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';

// Get the accounts model
require_once '../model/accounts-model.php';

// Get the functions library
require_once '../library/functions.php';

// Get the reviews model
require_once '../model/reviews-model.php';


// Get the array of classifications
$classifications = getClassifications();
                

// var_dump($classifications);
// 	exit;


$navList = buildNav($classifications);


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}
switch ($action){
  case 'login':
    
    include '../view/login.php';
    break;
  case 'registration':
    include '../view/registration.php';
    break;
  case 'login-success':
    $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
    $clientEmail = checkEmail($clientEmail);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
    $passwordCheck = checkPassword($clientPassword);

    // Run basic checks, return if errors
    if (empty($clientEmail) || empty($passwordCheck)) {
    $message = '<p class="notice">Please provide a valid email address and password.</p>';
    include '../view/login.php';
    exit;
    }
      
    // A valid password exists, proceed with the login process
    // Query the client data based on the email address
    $clientData = getClient($clientEmail);
    // Compare the password just submitted against
    // the hashed password for the matching client
    $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
    // If the hashes don't match create an error
    // and return to the login view
    if(!$hashCheck) {
      $message = '<p class="notice">Please check your password and try again.</p>';
      include '../view/login.php';
      exit;
    }
    // A valid user exists, log them in
    $_SESSION['loggedin'] = TRUE;
    // Remove the password from the array
    // the array_pop function removes the last
    // element from an array
    array_pop($clientData);
    // Store the array into the session
    $_SESSION['clientData'] = $clientData;
    // Send them to the admin view
    // var_dump($_SESSION['clientData']);
    // exit;
    include '../view/admin.php';
    exit;
  case 'register':
      // Filter and store the data
    $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
    $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword'));
    $clientEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);
    $existingEmail = checkExistingEmail($clientEmail);

      // Check for existing email address in the table
      if($existingEmail){
      $message = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
      include '../view/login.php';
      exit;
      }

    // Check for missing data
    if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
      $message = '<p class="message" >Please provide information for all empty form fields.</p>';
      include '../view/registration.php';
      exit;
    }

    // Send the data to the model
    // Hash the checked password
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

    $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

    // Check and report the result
    if($regOutcome === 1){
      setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
      $_SESSION['message']  = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
      header('Location: /phpmotors/accounts/?action=login');
      exit;
    } else {
      $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
      include '../view/registration.php';
      exit;
    }
    break;
  case 'admin':
    // echo "<pre>".var_dump($_SESSION)."<pre>";
    $clientId = $_SESSION['clientData']['clientId'];
    // var_dump($clientId);
    // exit;
    $reviewsList = getReviewsByClient($clientId);
    $clientReviewList = buildClientReviewListDisplay($reviewsList);
    include '../view/admin.php';
    break;

  case 'logout':
    $_SESSION = array();
    // session_destroy();
    $_SESSION['loggedin'] = FALSE;
    header("location: /phpmotors/");
  
  case 'updateClient-view':
    include '../view/clientUpdate.php';
    break;
  
  case 'updateAccount':
    //filter and collect inputs
    $clientFirstname = filter_input(INPUT_POST,'clientFirstname', FILTER_SANITIZE_STRING);
    $clientLastname  = filter_input(INPUT_POST,'clientLastname' , FILTER_SANITIZE_STRING);
    $clientEmail     = filter_input(INPUT_POST,'clientEmail'    , FILTER_SANITIZE_EMAIL);
    $clientId        = filter_input(INPUT_POST,'clientId'       , FILTER_SANITIZE_NUMBER_INT);

     //Check for missing data
     if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
      
      $message = '<p class="center">Please provide information for all empty form fields.</p>';
      $_SESSION['message'] = $message;
      // var_dump($message);
      // exit;
      include '../view/clientUpdate.php';
      exit;
    }
    //server side check to see if email is valid
    $clientEmail = checkEmail($clientEmail);
    // var_dump($_SESSION['clientData']['clientEmail']);
    // var_dump($clientEmail);
      
    

    // check to see if email is different then the one in the session
    if (!($clientEmail == $_SESSION['clientData']['clientEmail'])){
      // var_dump("true");
      //check that the new email address in not in clients table
      $existingEmail = checkExistingEmail($clientEmail);
      // var_dump($existingEmail);
      // exit;
      if($existingEmail){
        $message = '<p class="notice">That email address already exists. Please choose another Email address.</p>';
        $_SESSION['message'] = $message;
        include '../view/client-update.php';
        exit;
       }
    }
    

    $updateResult = updateClient($clientFirstname, $clientLastname, $clientEmail,$clientId);
    
    if ($updateResult) {
            
      $message = "<p class='notify'>Congratulations, $clientFirstname $clientLastname Your account was successfully updated.</p>";
      $_SESSION['message'] = $message;

      // header('location: /phpmotors/vehicles/');
      // exit;
    } else {
        $message ="<p class='notice'>Error. the $invMake $invModel was not updated.</p>";
        include '../view/vehicle-update.php';
        exit;
    }
    //get all client data from model based on client id as an array
    $clientData = getClientById($clientId);
    // Remove the password from the array
    // the array_pop function removes the last element from an array
    array_pop($clientData);
    // Store the array into the session
    $_SESSION['clientData'] = $clientData;
    // Send them to the admin view
    include '../view/admin.php';
    exit;

    break;

  case 'updatePassword':
    $clientPassword  = filter_input(INPUT_POST,'clientPassword' , FILTER_SANITIZE_STRING);
    $clientId        = filter_input(INPUT_POST,'clientId'       , FILTER_SANITIZE_NUMBER_INT);
    $passwordCheck = checkPassword($clientPassword);
    if (!($passwordCheck)) {
      $message = "Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special characte";

    }
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
    // echo $hashedPassword;
    $updatePassResult = updatePassword($hashedPassword,$clientId);
    // var_dump($updatePassResult);
    // exit;
    if ($updatePassResult) {
      // var_dump("True");
      // exit;
      $message = "Your Password has been updated.";
      $_SESSION['message'] = $message;
      include '../view/admin.php';
      exit;
      
    }else{
      // var_dump("False");
      // exit;
      $message = "Error: your password was not updated. Try again later.";
      $_SESSION['message'] = $message;  
      include '../view/admin.php';
      exit;
    }

  default:
    include '../view/registration.php';
    break;
     
   }