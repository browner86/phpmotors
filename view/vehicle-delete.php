<?php
if(!$_SESSION['loggedin']||$_SESSION['clientData']['clientLevel'] < 2){
  header('location: /phpmotors/');
}?><!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php 
                if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		            echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
	            elseif(isset($invMake) && isset($invModel)) { 
		            echo "Delete $invMake $invModel"; }?> | PHP Motors</title>
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
      <h1><?php if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
	                echo "Delete $invInfo[invMake] $invInfo[invModel]";} 
                elseif(isset($invMake) && isset($invModel)) { 
	                echo "Delete $invMake $invModel"; }?></h1>
      <p>Confirm Vehicle Deletion. The delete is permanent.</p>
      <?php
          if (isset($message)) {
          echo $message;
          }
       ?>
      <form action="/phpmotors/vehicles/index.php" method="post">
      
      <label for="invMake">Make:</label><br>
      <input type="text" id="invMake" name="invMake" readonly <?php if(isset($invMake)){echo "value='$invMake'";} elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'";}?>><br><br>
      <label for="invModel">Model:</label><br>
      <input type="text" id="invModel" name="invModel" readonly <?php if(isset($invModel)){echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; ;}?>><br><br>
      <label for="invDescription">Description:</label><br>
      <input type="text" id="invDescription" name="invDescription" readonly  <?php if(isset($invDescription)){echo "value='$invDescription'"; } elseif(isset($invInfo['invDescription'])) {echo "value='$invInfo[invDescription]'"; ;}?>><br><br>
      <input type="submit" value="Delete Vehicle" class="btn">
      <input type="hidden" name="action" value="deleteVehicle">
      <input type="hidden" name="invId" value="<?php
                                                 if(isset($invInfo['invId'])){ 
                                                     echo $invInfo['invId'];
                                                 }elseif(isset($invId)){ 
                                                     echo $invId; } ?>">
      </form>
      <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
      </footer>
    </div>

  </body>
</html>
