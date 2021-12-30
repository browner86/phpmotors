<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Deleted Review | PHP Motors</title>
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
    <h1>Delete Review.</h1>
  
    <form class="" action="../reviews/" method="post">
    <?php
      if (isset($reviewDisplay)) {
        echo ($reviewDisplay);
      }
      ?>
      <input type='hidden' name='action' value='deleteReview'>
      <input type='hidden' name='reviewId' value='<?php echo($reviewId);?>'>
      <label for="button">Are you sure you want to Delete this review?</label>
      <br><br>
      <button type="submit" name="button" class="btn">Delete Review</button>
    </form>
    <footer>
      <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>
  </div>

</body>

</html>