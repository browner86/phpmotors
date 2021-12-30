<?php
if(!$_SESSION['loggedin']||$_SESSION['clientData']['clientLevel'] < 2){
  header('location: /phpmotors/');
}
$classificationList = "<label for='classificationList'>Classification:</label><br>";
$classificationList .= "<select name='classificationId' id='classificationList'>";

$classificationList .= "<option value='0'>Select a Classification</option>";

foreach($classifications as $classification){
    $classificationList .= "<option value='$classification[classificationId]'";
      if(isset($classificationId)){
        if($classification['classificationId'] === $classificationId){
          $classificationList .= ' selected ';
        }
      }
    $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= "</select><br><br>";
?><!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add Vehicle | PHP Motors</title>
    <link rel="stylesheet" href="../css/styles.css" type="text/css" media="screen">
  </head>
  <body>
    <div id="wrapper">
      <header>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/header.php'; ?>

      </header>
      <nav>
      <?php echo $navList; ?>
      </nav>
      <h1>Add Vehicle</h1>
      <p>All fields are required.</p>
      <?php
          if (isset($message)) {
          echo $message;
          }
       ?>
      <form action="/phpmotors/vehicles/index.php" method="post">
      <?php echo $classificationList;?>
      <label for="invMake">Make:</label><br>
      <input type="text" id="invMake" name="invMake" required <?php if(isset($invMake)){echo "value='$invMake'";}?>><br><br>
      <label for="invModel">Model:</label><br>
      <input type="text" id="invModel" name="invModel" required <?php if(isset($invModel)){echo "value='$invModel'";}?>><br><br>
      <label for="invDescription">Description:</label><br>
      <input type="text" id="invDescription" name="invDescription" required <?php if(isset($invDescription)){echo "value='$invDescription'";}?>><br><br>
      <label for="invImage">Image:</label><br>
      <input type="text" id="invImage" name="invImage" value="../images/no-image.png" required <?php if(isset($invImage)){echo "value='$invImage'";}?>><br><br>
      <label for="invThumbnail">Thumbnail:</label><br>
      <input type="text" id="invThumbnail" name="invThumbnail" value="../images/no-image.png" required <?php if(isset($invThumbnail)){echo "value='$invThumbnail'";}?>><br><br>
      <label for="invPrice">Price:</label><br>
      <input type="text" id="invPrice" name="invPrice" required <?php if(isset($invPrice)){echo "value='$invPrice'";}?>><br><br>
      <label for="invStock">Stock:</label><br>
      <input type="text" id="invStock" name="invStock" required <?php if(isset($invStock)){echo "value='$invStock'";}?>><br><br>
      <label for="invColor">Color:</label><br>
      <input type="text" id="invColor" name="invColor" required <?php if(isset($invColor)){echo "value='$invColor'";}?>><br><br>
      <input type="submit" value="Add Vehicle" class="btn">
      <input type="hidden" name="action" value="newVehicle">
      </form>
      <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
      </footer>
    </div>

  </body>
</html>
