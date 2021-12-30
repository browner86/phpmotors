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
      <main>
        <div class="main">
          <h1>Login</h1>
          <?php
          if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
           }
       ?>
          <p>All fields are required.</p>
          <form action="/phpmotors/accounts/" method="post">
          <label for="clientEmail">Email:</label><br>
          <input type="email" id="clientEmail" name="clientEmail" required><br><br>
          <label for="clientPassword">Password:</label><br>
          <input type="password" id="clientPassword" name="clientPassword" required><br><br>
          <input type="submit" value="Sign In" class="btn">
          <input type="hidden" name="action" value="login-success">
          </form>
          <a href="../accounts/index.php?action=registration">Need an account?</a><br>
        </div>
      </main>
      <footer>
        <?php require $_SERVER['DOCUMENT_ROOT'].'/phpmotors/snippets/footer.php'; ?>
      </footer>
    </div>

  </body>
</html>
