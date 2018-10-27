<?php
include("includes/init.php");

$current_page_id = "login";

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

  <title>Login</title>
</head>

<body>
  <div class="body">

    <div class= "banner">
      <h1 class="title"> Make A Wish At Cornell </h1>
    </div>

    <?php include("includes/header.php");?>

    <div id="content-wrap">

      <?php


      if ($current_user) {
        echo "<h2 id='Log_in_header'>Log Out</h2>";
        echo"<div class='message'>";
        record_message("You're currently signed in.
        You can logout to use a different account.");
        print_messages();
        echo"</div>";
        ?>
        <form id="input" action="login.php" method="post">
          <button name="logout" type="submit">Log Out</button>
        </form>
        <?php
      }
      else {
        echo "<h2 id='Log_in_header'>Log in</h2>";
        echo"<div class='message'>";
        print_messages();
        echo"</div>";
        ?>

        <form id="input" action="login.php" method="post">
          <p><label>Username:</label>
            <input type="text" name="username" required/> ##Use admin1 </p>
            <p><label>Password:</label>
              <input type="password" name="password" required/> ##Use password1
            </p>
            <button name="login" type="submit">Log In</button>
          </form>
        <?php }
        ?>
      </div>

      <div class="line"></div>
    </div>
    <?php include("includes/footer.php");?>
  </body>

  </html>
