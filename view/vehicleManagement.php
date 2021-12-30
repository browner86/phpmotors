<?php
if (!$_SESSION['loggedin'] || $_SESSION['clientData']['clientLevel'] < 2) {
  header('location: /phpmotors/');
}
if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
 }
?><!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Vehicle Management | PHP Motors</title>
  <link rel="stylesheet" href="../css/styles.css" type="text/css" media="screen">
</head>

<body>
  <div id="wrapper">
    <header>
      <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

    </header>
    <nav>
      <?php echo $navList; ?>
    </nav>
    <h1>Vehicle Management</h1>


    <a href="../vehicles/index.php?action=newVehicleView">Add New Vehicle</a>
    <a href="../vehicles/index.php?action=newClassificationView">Add New Vehicle Classification</a>
    <?php
    if (isset($message)) {
      echo $message;
    }
    if (isset($classificationList)) {
      echo '<h2>Vehicles By Classification</h2>';
      echo '<p>Choose a classification to see those vehicles</p>';
      echo $classificationList;
    }
    ?>
    <noscript>
      <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
    </noscript>
    <table id="inventoryDisplay"></table>
    <footer>
      <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
  </div>

</body>
<script src="../js/inventory.js"></script>

</html>
<?php unset($_SESSION['message']); ?>