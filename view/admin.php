<?php
if (!$_SESSION['loggedin']) {
  header('location: /phpmotors/');
}
if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Content Title | PHP Motors</title>
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
    <div id="account-admin">
      <h1> Welcome <?php echo ($_SESSION['clientData']['clientFirstname']); ?> </h1>
      <p>You are logged in.</p>
      <?php
      if (isset($message)) {
        echo $message;
      }
      ?>
      <ul>
        <li>First Name: <?php echo ($_SESSION['clientData']['clientFirstname']); ?></li>
        <li>Last Name: <?php echo ($_SESSION['clientData']['clientLastname']); ?></li>
        <li>Email Address: <?php echo ($_SESSION['clientData']['clientEmail']); ?></li>
        <li>Client ID: <?php echo ($_SESSION['clientData']['clientId']); ?></li>

      </ul>
      <a href="../accounts/?action=updateAccount">Update Account</a>
      <br><br>
      <hr>
    </div>
    <div id = vehicle-admin>
      <?php
      if ($_SESSION['clientData']['clientLevel'] > 1) {
        echo ("<h2>Vehicle administration</h2>");
        echo ("<p><a href = '/phpmotors/vehicles/'>Update Vehicle Inventory</a> </p>");
        echo "<br><hr>";
      }
      ?>
    </div>
    <div id='review-admin'>
    
    <?php
        if (isset($clientReviewList)) {
          echo $clientReviewList;
        } ?>
    </div>

    <footer>
      <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
  </div>

</body>

</html>