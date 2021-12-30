<?php
function checkEmail($clientEmail)
{
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}


function checkPassword($clientPassword)
{
    // Check the password for a minimum of 8 characters, at least one 1 capital letter, at least 1 number and at least 1 special character{
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}


function buildNav($classifications)
//Builds navigation in each view.
{
    $navList = '<ul id = "nav-list">';
    $navList .= "<li><a href='/phpmotors/' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classifications as $classification) {
        $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=" . urlencode($classification['classificationName']) .    "' title='View our $classification[classificationName] lineup of vehicles'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    // var_dump($navList);
    // exit;
    return $navList;
}

function buildClassificationList($classifications)
{
    // Build the classifications select list{
    $classificationList = '<select name="classificationId" id="classificationList">';
    $classificationList .= "<option>Choose a Classification</option>";
    foreach ($classifications as $classification) {
        $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
    }
    $classificationList .= '</select>';
    return $classificationList;
}


function buildVehiclesDisplay($vehicles)
{
    // var_dump("in buildVehiclesDisplay function");
    // exit;
    $dv = '<ul id="inv-display">';

    foreach ($vehicles as $vehicle) {
        $priceUS = formatUSD($vehicle['invPrice']);
        $dv .= '<li>';
        $dv .= "<a href='/phpmotors/vehicles/?action=vehicle&invId=" . urldecode($vehicle['invId']) . "' title='View our $vehicle[invMake], $vehicle[invModel]'><img class = 'ind-vehicle-image' src='$vehicle[imgPath]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
        $dv .= '<hr>';
        $dv .= "<a href='/phpmotors/vehicles/?action=vehicle&invId=" . urldecode($vehicle['invId']) . "'><h2>$vehicle[invMake] $vehicle[invModel]</h2></a>"; //"<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
        $dv .= "<span>$priceUS</span>";
        $dv .= '</li>';
    }
    $dv .= '</ul>';
    // var_dump($dv);
    // exit;
    return $dv;
}

function formatUSD($price)
{
    $currency = "$ " . number_format($price, 2, '.', ',');
    return $currency;
}

function buildIndividualVehicleDisplay($vehicle)
{
    // echo date_default_timezone_get() . ' => ' . date('e') . ' => ' . date('T');
    // exit;
    // var_dump($_SESSION);
    // exit;
    $priceUS = formatUSD($vehicle['invPrice']);
    // $display = "<div class='ind-vehicle-display'>";
    $display = "<div class='ind-vehicle-heading'>";
    $display .= "<h1>$vehicle[invMake] , $vehicle[invModel] </h1>";
    // $display .= "<hr class='solid'>";
    $display .= "</div>";
    $display .= "<div class='ind-vehicle-image'>";
    $display .= "<img src='$vehicle[imgPath]' alt='Photo of $vehicle[invMake] , $vehicle[invModel]'>";
    $display .= "<p>Price: $priceUS</p>";
    $display .= "</div>";
    $display .= "<div class='ind-vehicle-info'>";
    $display .= "<h2>$vehicle[invMake] $vehicle[invModel] Details</h2>";
    $display .= "<ul >";
    $display .= "<li id='vehicle-desc'>$vehicle[invDescription]</li>";
    $display .= "<li>Color: $vehicle[invColor]</li>";
    $display .= "<li># in Stock: $vehicle[invStock]</li>";
    $display .=  "</ul>";
    $display .= "</div>";
    // $display .= "</div>";

    return $display;
}

function buildThumbnailListDisplay($thumbnailList)
{
    // var_dump($vehicle);
    // exit;
    $display = "<div class='thumbnail-panel'>";

    $display .= "<h2 id='thumbnail-heading'>Additional images</h2>";
    // var_dump($display);
    // exit;
    foreach ($thumbnailList as $thumbnail) {
        // var_dump("$thumbnail[imgPath]");
        // exit;
        $display .= "<img src='$thumbnail[imgPath]' class= 'thumbnail' alt='$thumbnail[invMake] $thumbnail[invModel]'>";
    }
    $display .= "</div>";
    return $display;
}

/* * ********************************
*  Functions for working with images
* ********************************* */


function makeThumbnailName($image)
// Adds "-tn" designation to file name
{
    $i = strrpos($image, '.');
    $image_name = substr($image, 0, $i);
    $ext = substr($image, $i);
    $image = $image_name . '-tn' . $ext;
    return $image;
}


function buildImageDisplay($imageArray)
// Build images display for image management view
{
    $id = '<ul id="image-display">';
    foreach ($imageArray as $image) {
        $id .= '<li>';
        $id .= "<img src='$image[imgPath]' title='$image[invMake] $image[invModel] image on PHP Motors.com' alt='$image[invMake] $image[invModel] image on PHP Motors.com'>";
        $id .= "<p><a href='/phpmotors/uploads?action=delete&imgId=$image[imgId]&filename=$image[imgName]' title='Delete the image'>Delete $image[imgName]</a></p>";
        $id .= '</li>';
    }
    $id .= '</ul>';
    return $id;
}


function buildVehiclesSelect($vehicles)
// Build the vehicles select list
{
    $prodList = '<select name="invId" id="invId">';
    $prodList .= "<option>Choose a Vehicle</option>";
    foreach ($vehicles as $vehicle) {
        $prodList .= "<option value='$vehicle[invId]'>$vehicle[invMake] $vehicle[invModel]</option>";
    }
    $prodList .= '</select>';
    return $prodList;
}


function uploadFile($name)
// Handles the file upload process and returns the path
// The file path is stored into the database
{
    // Gets the paths, full and local directory
    global $image_dir, $image_dir_path;
    if (isset($_FILES[$name])) {
        // Gets the actual file name
        $filename = $_FILES[$name]['name'];
        if (empty($filename)) {
            return;
        }
        // Get the file from the temp folder on the server
        $source = $_FILES[$name]['tmp_name'];
        // Sets the new path - images folder in this directory
        $target = $image_dir_path . '/' . $filename;
        // Moves the file to the target folder
        move_uploaded_file($source, $target);
        // Send file for further processing
        processImage($image_dir_path, $filename);
        // Sets the path for the image for Database storage
        $filepath = $image_dir . '/' . $filename;
        // Returns the path where the file is stored
        return $filepath;
    }
}


function processImage($dir, $filename)
// Processes images by getting paths and 
// creating smaller versions of the image
{
    // Set up the variables
    $dir = $dir . '/';

    // Set up the image path
    $image_path = $dir . $filename;

    // Set up the thumbnail image path
    $image_path_tn = $dir . makeThumbnailName($filename);

    // Create a thumbnail image that's a maximum of 200 pixels square
    resizeImage($image_path, $image_path_tn, 200, 200);

    // Resize original to a maximum of 500 pixels square
    resizeImage($image_path, $image_path, 500, 500);
}


function resizeImage($old_image_path, $new_image_path, $max_width, $max_height)
// Checks and Resizes image
{

    // Get image type
    $image_info = getimagesize($old_image_path);
    $image_type = $image_info[2];

    // Set up the function names
    switch ($image_type) {
        case IMAGETYPE_JPEG:
            $image_from_file = 'imagecreatefromjpeg';
            $image_to_file = 'imagejpeg';
            break;
        case IMAGETYPE_GIF:
            $image_from_file = 'imagecreatefromgif';
            $image_to_file = 'imagegif';
            break;
        case IMAGETYPE_PNG:
            $image_from_file = 'imagecreatefrompng';
            $image_to_file = 'imagepng';
            break;
        default:
            return;
    } // ends the swith

    // Get the old image and its height and width
    $old_image = $image_from_file($old_image_path);
    $old_width = imagesx($old_image);
    $old_height = imagesy($old_image);

    // Calculate height and width ratios
    $width_ratio = $old_width / $max_width;
    $height_ratio = $old_height / $max_height;

    // If image is larger than specified ratio, create the new image
    if ($width_ratio > 1 || $height_ratio > 1) {

        // Calculate height and width for the new image
        $ratio = max($width_ratio, $height_ratio);
        $new_height = round($old_height / $ratio);
        $new_width = round($old_width / $ratio);

        // Create the new image
        $new_image = imagecreatetruecolor($new_width, $new_height);

        // Set transparency according to image type
        if ($image_type == IMAGETYPE_GIF) {
            $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
            imagecolortransparent($new_image, $alpha);
        }

        if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
            imagealphablending($new_image, false);
            imagesavealpha($new_image, true);
        }

        // Copy old image to new image - this resizes the image
        $new_x = 0;
        $new_y = 0;
        $old_x = 0;
        $old_y = 0;
        imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);

        // Write the new image to a new file
        $image_to_file($new_image, $new_image_path);
        // Free any memory associated with the new image
        imagedestroy($new_image);
    } else {
        // Write the old image to a new file
        $image_to_file($old_image, $new_image_path);
    }
    // Free any memory associated with the old image
    imagedestroy($old_image);
} // ends resizeImage function


function buildReviewListDisplay($reviewsList)
{
    // echo '<pre>' . var_export($reviewsList, true) . '</pre>';
    // exit;

    $display = '<ul id="review-display">';
    foreach ($reviewsList as $review) {
        $clientId = $review['clientId'];
        // $firstNameAbrev = $review['clientFirstname'];
        // var_dump($clientId);
        // exit;
        $name = createScreenName($clientId);

        $date = $review['reviewDate'];
        // $date = date_format($review['reviewDate'], 'Y-m-d H:i:s');
        $display .= '<li>';
        $display .= "<p>$name <p/>";
        $display .= "<p>\"$review[reviewText]\"<p/>";
        $display .= "<p>$date<p/>";
        $display .= "<hr>";

        $display .= '</li>';
    }
    $display .= '</ul>';

    return $display;
}
function buildClientReviewListDisplay($reviewsList)
{
    // echo '<pre>' . var_export($reviewsList, true) . '</pre>';
    // exit;

    $display = '<ul id="client-review-display">';
    $display .= '<h2>Vehicle Reviews</h2>';
    $display .= '<hr>';
    foreach ($reviewsList as $review) {
        $clientId = $review['clientId'];
        $reviewId = $review['reviewId'];
        // $firstNameAbrev = $review['clientFirstname'];
        // var_dump($clientId);
        // exit;
        $name = "$review[invMake] $review[invModel]";

        $date = $review['reviewDate'];
        // $date = date_format($review['reviewDate'], 'Y-m-d H:i:s');
        $display .= '<li>';
        $display .= "<h3>$name </h3>";
        $display .= "<p>\"$review[reviewText]\"<p/>";
        $display .= "<p>$date<p/>";
        $display .= "<a href='../reviews/?action=updateReview-view&reviewId=$reviewId'><button class= 'btn' type='button' name='button'>Edit</button></a>";
        $display .= "<a href='../reviews/?action=deleteConfirm-view&reviewId=$reviewId'><button class= 'btn' type='button' name='button'>Delete</button></a>";
        // $display .= "<form class='review-form' action='../reviews/' method='post'>
        //                 <input type='hidden' name='invId' value='$review[invId]'>
        //                 <input type='hidden' name='clientId' value='$review[clientId]'>
        //                 <input type='hidden' name='reviewId' value='$review[reviewId]'>
        //                 <input type='hidden' name='reviewDate' value='$review[reviewDate]'>
        //                 <input type='hidden' name='reviewText' value='$review[reviewText]'>
        //                 <input type='hidden' name='action' value='updateReview-view'>
        //                 <button type='submit' name='button'>Edit Review</button>
        //             </form>";
        $display .= "<hr>";

        $display .= '</li>';
    }
    $display .= '</ul>';

    return $display;
}

function buildNewReviewForm($clientFirstname, $clientLastname, $invId, $clientId)
{

    // var_dump($clientFirstname);
    // exit;
    // $reviewDate = date("F j, Y, g:i a");
    $reviewDate = date("Y-m-d h:i:s");
    // $reviewDate = strtotime($reviewDate);
    // var_dump($reviewDate);
    // exit;
    $screenName = createScreenName($clientId);

    $display = "<form class= 'review-form' action= '../reviews/' method= 'post'>";
    // $display .=   "<label for='screenName'>Screen Name</label>";
    $display .= "<h3>$screenName</h3>";
    // $display .= "<input type= 'text' readonly name= 'screenName' value = '$screenName'>";
    $display .= "<label for='ReviewText'>Please enter review below.</label>";
    $display .= "<textarea name='reviewText' rows='8' cols='80'></textarea>";

    $display .= "<input type= 'hidden' name= 'invId' value= '$invId'>";
    $display .= "<input type= 'hidden' name= 'clientId' value= '$clientId'>";
    $display .= "<input type= 'hidden' name= 'reviewDate' value= '$reviewDate'>";
    $display .= "<input type='hidden' name='action' value='addNewReview'>";
    $display .= "<button type='submit' name='button' class='btn'id= 'post-button' >Post Review</button>";


    $display .= "</form>";
    return $display;
}
function createScreenName($clientId)
{
    $clientInfo = getClientById($clientId);
    $clientFirstname = $clientInfo['clientFirstname'];
    $firstNameAbrev = substr($clientFirstname, 0, 1);
    $clientLastname = $clientInfo['clientLastname'];
    $screenName = $firstNameAbrev . $clientLastname;
    // var_dump($screenName);
    // exit;
    return $screenName;



    // var_dump($clientLastname);
    // exit;


}
