<div id="top-header">
      <img src="/phpmotors/images/site/logo.png" alt="PHP Motors logo" id="logo">
      <?php if(isset($_SESSION['clientData']['clientFirstname'])){
            $clientFirstname = $_SESSION['clientData']['clientFirstname'];
            echo "<a href='/phpmotors/accounts/?action=admin'>Welcome $clientFirstname</a>";
            echo "<a href='/phpmotors/accounts/index.php?action=logout' id='acc'>Logout</a>";
            } else {
                  echo "<a href='/phpmotors/accounts/index.php?action=login' id='acc'>My Account</a>";
            } ?>
      <!-- <a href="/phpmotors/accounts/index.php?action=login" id="acc">My Account</a> -->
</div>
