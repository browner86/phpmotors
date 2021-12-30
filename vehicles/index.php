<?php
//This is the accounts controller

// Create or access a Session
session_start();
date_default_timezone_set('America/Phoenix');
// echo '<pre>'; var_dump($_SESSION); echo '</pre>';
// exit;
// Get the database connection file
require_once '../library/connections.php';

// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';

// Get the accounts model
require_once '../model/vehicles-model.php';

// Get the functions library
require_once '../library/functions.php';

// Get the uploads model
require_once '../model/uploads-model.php';

// Get the uploads model
require_once '../model/reviews-model.php';

require_once '../model/accounts-model.php';

// Get the array of classifications
$classifications = getClassifications();
// var_dump($classifications);
// exit;
                

$navList = buildNav($classifications);


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL){
 $action = filter_input(INPUT_GET, 'action');
}
switch ($action){
    case 'newClassificationView':
    
        include '../view/addClassification.php';
        break;
    case 'newVehicleView':
        include '../view/addVehicle.php';
        break;
    case 'newVehicle':
        $invMake          = trim(filter_input(INPUT_POST,'invMake'         , FILTER_SANITIZE_STRING));
        $invModel         = trim(filter_input(INPUT_POST,'invModel'        , FILTER_SANITIZE_STRING));
        $invDescription   = trim(filter_input(INPUT_POST,'invDescription'  , FILTER_SANITIZE_STRING));
        $invImage         = trim(filter_input(INPUT_POST,'invImage'        , FILTER_SANITIZE_URL));
        $invThumbnail     = trim(filter_input(INPUT_POST,'invThumbnail'    , FILTER_SANITIZE_URL));
        $invPrice         = trim(filter_input(INPUT_POST,'invPrice'        , FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock         = trim(filter_input(INPUT_POST,'invStock'        , FILTER_SANITIZE_NUMBER_INT));
        $invColor         = trim(filter_input(INPUT_POST,'invColor'        , FILTER_SANITIZE_STRING));
        $classificationId = trim(filter_input(INPUT_POST,'classificationId', FILTER_SANITIZE_NUMBER_INT));

        if(empty($invMake)||empty($invModel)||empty($invDescription)||empty($invImage)|| 
            empty($invThumbnail) || empty($invPrice) ||empty($invStock)||empty($invColor)){
            $message = '<p class="message">Please provide information for all empty form fields.</p>';
            include '../view/addVehicle.php';
            exit;
            }
        $newVehicle = createNewVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail ,$invPrice, $invStock, $invColor, $classificationId);
        
        if ($newVehicle === 1) {

        $message = "<p>You have successfully added $invStock $invMake-$invModel to the inventory. </p>";
            include '../view/vehicleManagement.php';
            exit;
        } else {
            $message ="<p>Please fill out all input forms.</p>";
            include '../view/addVehicle.php';
            exit;
        }

            include '../view/addVehicle.php';
            exit;
            break;
        break;


    case 'newClassification':
        // var_dump("in New Classification case");
        // exit;
        // Filter and store the data
            $newClassification = filter_input(INPUT_POST,'classificationName', FILTER_SANITIZE_STRING);

        //   var_dump($newClassification);
        //   exit;
        // Check for missing data
        if(empty($newClassification)){
            
            $message = '<p class="message">Please provide information for all empty form fields.</p>';
            include '../view/addClassification.php';
                            
            exit;
        }

        $createdClassification = createNewClassification($newClassification);
        // var_dump($createdClassification);
        // exit;
        if ($createdClassification === 1) {
            header("location: /phpmotors/vehicles/index.php");
                exit;
        }else{
            $message ="<p>Sorry $clientFirstname, but the registration failed Please try again.</p>";
            include '../view/addClassificationView.php';
            exit;
        }
        break;
    case 'getInventoryItems':
        // Get the classificationId
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        // fetch the vehicles by classificationId from the DB
        $inventoryArray = getInventoryByClassification($classificationId);
        // convert the aray to a JSON object and send it back
        echo json_encode($inventoryArray);
        break;
    case 'mod':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if(count($invInfo)<1){
         $message = 'Sorry, no vehicle information could be found.';
        }
        include '../view/vehicle-update.php';
        exit;
        break;
    case 'updateVehicle':
        $invId            =      filter_input(INPUT_POST, 'invId'          , FILTER_SANITIZE_NUMBER_INT);
        $invMake          = trim(filter_input(INPUT_POST,'invMake'         , FILTER_SANITIZE_STRING));
        $invModel         = trim(filter_input(INPUT_POST,'invModel'        , FILTER_SANITIZE_STRING));
        $invDescription   = trim(filter_input(INPUT_POST,'invDescription'  , FILTER_SANITIZE_STRING));
        $invImage         = trim(filter_input(INPUT_POST,'invImage'        , FILTER_SANITIZE_URL));
        $invThumbnail     = trim(filter_input(INPUT_POST,'invThumbnail'    , FILTER_SANITIZE_URL));
        $invPrice         = trim(filter_input(INPUT_POST,'invPrice'        , FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $invStock         = trim(filter_input(INPUT_POST,'invStock'        , FILTER_SANITIZE_NUMBER_INT));
        $invColor         = trim(filter_input(INPUT_POST,'invColor'        , FILTER_SANITIZE_STRING));
        $classificationId = trim(filter_input(INPUT_POST,'classificationId', FILTER_SANITIZE_NUMBER_INT));

        if(empty($invMake)||empty($invModel)||empty($invDescription)||empty($invImage)|| 
            empty($invThumbnail) || empty($invPrice) ||empty($invStock)||empty($invColor)){
            $message = '<p class="message">Please provide information for all empty form fields.</p>';
            include '../view/vehicleUpdate.php';
            exit;
            }
        $updateResult = updateVehicle($invId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail ,$invPrice, $invStock, $invColor, $classificationId);
        
        if ($updateResult) {
            $message = "<p class='notify'>Congratulations, the $invMake $invModel was successfully updated.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;  
        } else {
            $message ="<p>Update was not successful, please try again.</p>";
            include '../view/vehicle-update.php';
            exit;
        }

            include '../view/vehicle-update.php';
            exit;
            break;
        break;

    case 'del':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (count($invInfo) < 1) {
		    $message = 'Sorry, no vehicle information could be found.';
	    }
	    include '../view/vehicle-delete.php';
	    exit;
        break;

    case 'deleteVehicle':
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        $deleteResult = deleteVehicle($invId);
        if ($deleteResult) {
            $message = "<p class='notice'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p class='notice'>Error: $invMake $invModel was not
        deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        }
        break;
    case 'classification':
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
        $vehicles = getVehiclesByClassification($classificationName);
        // var_dump($vehicles);
        // exit;
        if(!count($vehicles)){
        $message = "<p class='notice'>Sorry, no $classificationName could be found.</p>";
        } else {
        $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }
        // echo $vehicleDisplay;
        // exit;
        include '../view/classification.php';
        break;

    case 'vehicle':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $vehicle = getInvItemInfo($invId);
        $thumbnailList = getThumbnail($invId);
        $vehicleFullName ="$vehicle[invMake] $vehicle[invModel]";
        
        if(!($vehicle)){
            $message = "<p class='notice'>Sorry, vehicle could not be found.</p>";
           } else {
            $individualVehicleDisplay = buildIndividualVehicleDisplay($vehicle);
            $thumbnailDisplay = buildThumbnailListDisplay($thumbnailList);
            $reviewsList = getReviewsByInventoryItem($invId);
            $vehicleReviewList = buildReviewListDisplay($reviewsList);
            if($_SESSION['loggedin']){
                
                $clientId = $_SESSION['clientData']['clientId'];
                $clientFirstname = $_SESSION['clientData']['clientFirstname'];
                $clientLastname = $_SESSION['clientData']['clientLastname'];
                
                $newReviewForm = buildNewReviewForm($clientFirstname, $clientLastname, $invId, $clientId);
           }}
           
           include '../view/vehicle-detail.php';
           break;

        break;
    default:
        $classificationList = buildClassificationList($classifications);
        include '../view/vehicleManagement.php';
        break;
     
   }