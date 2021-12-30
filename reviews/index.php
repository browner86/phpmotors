<?php
//review Controller
session_start();
date_default_timezone_set('America/Phoenix');
require_once '../library/connections.php';
require_once '../model/main-model.php';
require_once '../model/vehicles-model.php';
require_once '../model/uploads-model.php';
require_once '../model/accounts-model.php';
require_once '../library/functions.php';
require_once '../model/reviews-model.php';

// Get the array of classifications
$classifications = getClassifications();
// Build a navigation bar using the $classifications array
$navList = buildNav($classifications);

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}



switch ($action) {
    case 'addNewReview':
       //use insertReview()
       // form will be on bottom of vehicle detail view
       $reviewId    = trim(filter_input(INPUT_POST,'reviewId'   , FILTER_SANITIZE_STRING));
       $reviewText  = trim(filter_input(INPUT_POST,'reviewText' , FILTER_SANITIZE_STRING));
       $reviewDate  = trim(filter_input(INPUT_POST,'reviewDate' , FILTER_SANITIZE_STRING));
       $invId       = trim(filter_input(INPUT_POST,'invId'      , FILTER_SANITIZE_STRING));
       $clientId    = trim(filter_input(INPUT_POST,'clientId'   , FILTER_SANITIZE_STRING));
        
    //    if(empty($reviewId)||empty($reviewText)||empty($invId)|| 
    //         empty($clientId)) {
    //             // var_dump("ReviewId = $reviewId");
    //             // var_dump("reviewText = $reviewText");
    //             // var_dump("invId = $invId");
    //             // var_dump("client = $clientId");
    //             // echo '<pre>' . var_export($_POST, true) . '</pre>';
    //             // exit;
    //         $message = '<p class="message">Please provide information for all empty form fields.</p>';
    //         // require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/vehicles?action=vehicle&invId=1';
    //         // include "../phpmotors/vehicles/?action=vehicle&invId=$invId";
    //         // header("location: /phpmotors/vehicles/?action=vehicle&invId=$invId");
    //         // "phpmotors/vehicles/?action=vehicle&invId=$invId";//need specific to vehicle being used.
    //         exit;
    //         }

        $newReview = insertReview($reviewText,$reviewDate,$invId,$clientId);
        
        if ($newReview === 1) {

            $message = "<p>Thank you for leaving your review. </p>";
                include '../view/vehicle-detail.php';
                exit;
            } else {
                $message ="<p>Please fill out all input forms.</p>";
                include '../view/vehicle-detail.php';
                exit;
            }
    
                include '../view/vehicle-detail.php';
                exit;
                break;
        break;
    case 'updateReview-view':
        //use getReview($reviewID) in reviews model
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
        $reviewInfo = getReview($reviewId);
        $reviewText = $reviewInfo['reviewText'];
        // var_dump($_GET);
        // exit;
        if(count($reviewInfo)<1){
            $message = 'Sorry, no review information could be found.';
           }
        include '../view/review-edit.php';
       
        break;
    case 'updateReview':
        // var_dump("in updateReview case");
        // exit;
        $reviewId    = trim(filter_input(INPUT_POST,'reviewId'   , FILTER_SANITIZE_STRING));
        $reviewText  = trim(filter_input(INPUT_POST,'reviewText' , FILTER_SANITIZE_STRING));
        // $reviewDate  = trim(filter_input(INPUT_POST,'reviewDate' , FILTER_SANITIZE_STRING));
        $invId       = trim(filter_input(INPUT_POST,'invId'      , FILTER_SANITIZE_STRING));
        $clientId    = trim(filter_input(INPUT_POST,'clientId'   , FILTER_SANITIZE_STRING));
        // echo "<pre>".var_dump($_POST)."</pre>";
        // exit;
        $reviewDate = date("Y-m-d h:i:s");
    
       if(empty($reviewText)) {
            $message = '<p class="message">Please provide updated review. If you wish to delete your review click the delete button on the account admin page.</p>';
            $_SESSION['message'] = $message;
            header("location: /phpmotors/reviews/?action=updateReview-view&reviewId=$reviewId");
            // include '../view/vehicle-detail.php';//need specific to vehicle being used.
            exit;
            }
            $updateResult = updateReview($reviewId,$reviewText,$reviewDate);
            // var_dump($updateResult);
            // exit;

            if ($updateResult) {
                $message = "<p class='notify'>Thank you for updating your review.</p>";
                $_SESSION['message'] = $message;
                header('location: /phpmotors/accounts/?action=admin');
                exit;  
            } else {
                $message ="<p>Update was not successful, please try again.</p>";
                include '../view/vehicle-detail.php';//need specific to vehicle being used.
                exit;
            }
    
                include '../view/vehicle-detail.php';
                exit;
                break;


        break;

    case 'deleteConfirm-view':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
        $reviewInfo = getReview($reviewId);
        // var_dump($reviewId);
        // exit;
        $reviewText = $reviewInfo['reviewText'];
       
        $reviewDate = $reviewInfo['reviewDate'];
        $invMake = $reviewInfo['invMake'];
        $invModel = $reviewInfo['invModel'];
        $invMakeModel = "$invMake, $invModel";


        $reviewDisplay = "<div id= 'delete-Review'>";
        $reviewDisplay .= "<h2>$invMakeModel</h2>";
        $reviewDisplay .= "<p>$reviewText</p>";
        $reviewDisplay .= "<p>$reviewDate</p>";
        $reviewDisplay .= "</div>";


        if (count($reviewInfo) < 1) {
		    $message = 'Sorry, no review information could be found.';
	    }
	    include '../view/review-confirmDelete.php';
	    exit;
        break;

    case 'deleteReview':
        //use deleteReview($reviewId)
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_VALIDATE_INT);
        // var_dump($reviewId);
        // exit;
        $deleteResult = deleteReview($reviewId);
        if ($deleteResult) {
            $message = "<p class='notice'>Your review has been deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/?action=admin');

            // header('location: /phpmotors/vehicles/');
            // include "../view/admin.php";
            exit;
        } else {
            $message = "<p class='notice'>Error: Sorry your review was not deleted. Please try again.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/accounts/?action=admin');
            // include "../view/admin.php";
            exit;
        }
        break;

    default:
        //deliver admin view if client logged in or home if not.
        include '../view/admin.php';
        break;
}
