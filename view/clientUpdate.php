<?php 
if (!$_SESSION['loggedin']) {
//  header('location: /phpmotors/');
echo "True";
 exit;
}
if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
}
?><!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Update Account | PHP Motors</title>
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
      <h1>Update Account</h1>
      <h2>Account Info</h2>
      <?php
          if (isset($message)) {
            echo $message;
          }
        ?>
        <form action="/phpmotors/accounts/" method="post">
            <label for="clientFirstname">First Name</label><br>
            <input required type="text" id="clientFirstname" name="clientFirstname" <?php
                if(isset($clientFirstname)){echo "value='$clientFirstname'";} else { echo "value={$_SESSION['clientData']['clientFirstname']}";}?>><br>
            <label for="clientLastname">Last Name</label><br>
            <input required type="text" id="clientLastname" name="clientLastname" <?php
                if(isset($clientLastname)){echo "value='$clientLastname'";} else { echo "value={$_SESSION['clientData']['clientLastname']}";}?>><br>
            <label for="clientEmail">Email</label><br>
            <input required type="text" id="clientEmail" name="clientEmail" <?php
                if(isset($clientEmail)){echo "value='$clientEmail'";} else { echo "value={$_SESSION['clientData']['clientEmail']}";}?>><br>
            <input type="submit" name="submit"  value="Update info">
            <input type="hidden" name="action" value="updateAccount">
            <input type="hidden" name="clientId" value="<?php echo $_SESSION['clientData']['clientId'] ?>">
        </form>
        <h2>Update Password</h2>
        <p>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</p>
        <p>*note your original password will be changed</p>
        <?php
          if (isset($message)) {
            echo $message;
          }
        ?>
        <form action="/phpmotors/accounts/" method="post">
            <label for="clientPassword">Password</label> <br>
            <input type="password" id="clientPassword" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br>
            <input type="submit" name="submit"  value="Change Password">
            <input type="hidden" name="action" value="updatePassword">
            <input type="hidden" name="clientId" value="<?php echo $_SESSION['clientData']['clientId'] ?>">
        </form>
      <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
      </footer>
    </div>

  </body>
</html>
