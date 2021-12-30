<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login | PHP Motors</title>
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
      <h1>Register</h1>
      <p>All fields are required.</p>
      <?php
          if (isset($message)) {
          echo $message;
          }
       ?>
      <form action="/phpmotors/accounts/index.php" method="post">
      <label for="clientFirstname">First Name:</label><br>
      <input type="text" id="clientFirstname" name="clientFirstname" required <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?>><br><br>
      <label for="clientLastname">Last Name:</label><br>
      <input type="text" id="clientLastname" name="clientLastname" required <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?>><br><br>
      <label for="clientEmail">Email:</label><br>
      <input type="email" id="clientEmail" name="clientEmail" required <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?>><br><br>
      <label for="clientPassword">Password:</label><br>
      <span>Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character</span> 
      <input type="password" id="clientPassword" name="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br><br>
     
      <input type="submit" value="Sign up" class="btn">
      <input type="hidden" name="action" value="register">
      </form>
      <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
      </footer>
    </div>

  </body>
</html>
