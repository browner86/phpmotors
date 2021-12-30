<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title><?php echo $vehicleFullName; ?> | PHP Motors</title>
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
    <main>
      <div class='ind-vehicle-display'>



        <?php
        if (isset($message)) {
          echo $message;
        }

        ?>
        <?php
        if (isset($thumbnailDisplay)) {
          echo $thumbnailDisplay;
        } ?>
        <?php
        if (isset($individualVehicleDisplay)) {
          echo $individualVehicleDisplay;
        } ?>



      </div>



      <div class=vehicle-reviews>
        <h2>Customer Reviews</h2>
        <?php
        if (!$_SESSION['loggedin']) {
          echo "<p>Log in to leave a review.</p>";
        } ?>
        <!-- insert php to display results of vehicle reviews -->
        <?php
        if (isset($vehicleReviewList)) {
          echo $vehicleReviewList;
        } ?>

        <!-- <p>Log in to leave a review.</p> -->
        <!--insert php to create form if logged in  -->


        <?php
        // var_dump($_SESSION);

        if ($_SESSION['loggedin']) {
         

          // echo "<p>in else</p>";

          if (isset($newReviewForm)) {
            echo $newReviewForm;
          }
        }
        ?>

      </div>
    </main>

    <hr>
    <footer>
      <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>

  </div> <!-- Wrapper ends-->
</body>

</html>