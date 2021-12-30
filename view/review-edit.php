<?php
if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];}
?><!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Update Review | PHP Motors</title>
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
    <h1>Update your Review</h1>
    <?php
      if (isset($message)) {
        echo $message;
      }
      ?>
    <form action="../reviews/" method="post">
      <textarea name="reviewText" cols="30" rows="10"><?php
                                                      echo($reviewText);
                                                      ?></textarea>
      <input type='hidden' name='reviewId' value='<?php
                                                  echo $reviewId;
                                                  ?>'>
      <input type='hidden' name='action' value='updateReview'>
      <br><br>
      <button type='submit' name='button' class="btn">Update Review</button>
    </form>
    <footer>
      <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
  </div>

</body>

</html>