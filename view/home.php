<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Home | PHP Motors</title>
  <link rel="stylesheet" href="./css/styles.css" type="text/css" media="screen">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
      <h1>Welcome to PHP Motors!</h1>
      <div class="featured-car">
        <div class="car-bio">
          <h2>DMC Delorean</h2>
          <p>3 Cup Holders</p>
          <p>Superman Doors</p>
          <p>Fuzzy Dice</p>
        </div>
        <img src="./images/vehicles/delorean.jpg" alt="DMC Delorean">
        <a id="sales" href="#">Own Today</a>
      </div>

      <div class="reviews">
        <h1>DMC Delorean Reviews</h1>
        <ul>
          <li>"So fast its almost like traveling in time." [4/5]</li>
          <li>"Coolest ride on the road." [4/5]</li>
          <li>"I'm feeling Marty McFly" [5/5]</li>
          <li>"The most futuristic ride of our day" [4.5/5]</li>
          <li>"80's livin and I love it!" [5/5]</li>
        </ul>
      </div>
      <div class="upgrades">
        <h1>Delorean Upgrades</h1>
        <div class="upgrade-item" id="flux">
          <img class="upgradeimg" src="./images/upgrades/flux-cap.png" alt="">
          <a href="#">Flux Capacitor</a>
        </div>
        <div class="upgrade-item" id="flame">
          <img class="upgradeimg" src="./images/upgrades/flame.jpg" alt="">
          <a href="#">Flame Decals</a>
        </div>
        <div class="upgrade-item" id="stickers">
          <img class="upgradeimg" src="./images/upgrades/bumper_sticker.jpg" alt="">
          <a href="#"> Bumper Stickers</a>
        </div>
        <div class="upgrade-item" id="hub">
          <img class="upgradeimg" src="./images/upgrades/hub-cap.jpg" alt="">
          <a href="#">Hub Caps</a>
        </div>
      </div>
    </main>
    <hr>
    <footer>
      <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </footer>

  </div> <!-- Wrapper ends-->
</body>

</html>