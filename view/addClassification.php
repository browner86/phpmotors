<?php 
if(!$_SESSION['loggedin']||$_SESSION['clientData']['clientLevel'] < 2){
  header('location: /phpmotors/');
}
?><!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add Vehicle Classification | PHP Motors</title>
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
      <h1>Add Vehicle Classification</h1>
      <p>All fields are required.</p>
      <?php
          if (isset($message)) {
          echo $message;
          }
       ?>
          <form action="/phpmotors/vehicles/index.php" method="post">
          <label for="classificationName">New Car Classification</label><br>
          <input type="text" id="classificationName" name="classificationName" required ><br><br>
          <input type="hidden" name="action" value="newClassification">
          <input type="submit" value="Add Classification" class="btn">
          </form>
      <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
      </footer>
    </div>

  </body>
</html>
