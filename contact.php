<?php include('includes/init.php');

$current_page_id = "contact";

if (isset($_POST["submit"])) {

  $fname  = filter_input(INPUT_POST, "FName", FILTER_SANITIZE_STRING);

  $lname  = filter_input(INPUT_POST, "Lname", FILTER_SANITIZE_STRING);

  if (filter_input(INPUT_POST, "PNumber", FILTER_VALIDATE_REGEXP,
  array("options"=>array("regexp"=>"/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/")))) {
    $phone = $_POST["PNumber"];
  } else {
    $phone = NULL;
  }

  $email  = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

  $subject  = filter_input(INPUT_POST, "Subject", FILTER_SANITIZE_STRING);
  $message  = filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRING);
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
  <script type="text/javascript" src="scripts/jquery-3.2.1.js"></script>
  <script type="text/javascript" src="scripts/site.js"></script>


  <title>Contact</title>
</head>

<body>
  <div class="body">

    <div class= "banner">
      <h1 class="title"> Make A Wish At Cornell </h1>
    </div>

    <?php include("includes/header.php");?>

    <div>

      <?php
      if (!(isset($_POST["submit"]))){ ?>

        <h2 id="contact_header">Contact Us</h2>
        <form action="contact.php" method="post" id="form" novalidate>
          <p>Required fields are followed by
            <span class="required">(required)</span>
            and optional fields are followed by (optional).
          </p>

          <div>
            <label for="FName">First Name</label>
            <span class="required">(required)</span>
            <span class="error hidden" id="nameError">
              No First Name provided.
            </span>
            <input id="FName" type="text" name="FName"
            placeholder="Enter First Name" required class="input">
          </div>
          <div>
            <label for="Lname">Last Name</label>
            <span class="required">(required)</span>
            <span class="error hidden" id="BnameError">
              No Last Name provided.
            </span>
            <input id="Lname" type="text" name="Lname"
            placeholder="Enter Last Name" required class="input">
          </div>
          <div>
            <label for="PNumber">Phone Number</label>
            <span class="required">(optional)</span>
            <span class="error hidden" id="PNumberError">
              Invalid format. Enter in xxx-xxx-xxxx format.
            </span>
            <input id="PNumber" type="tel" name="PNumber"
            placeholder=" Enter phone number in xxx-xxx-xxxx format"
            pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" class="input">
          </div>
          <div>
            <label for="email">Email</label>
            <span class="required">(required)</span>
            <span class="error hidden" id="emailerror">
              Invalid or no Email Address provided.
            </span>
            <input id="email" type="email" name="email"
            placeholder="Enter Email" required class="input">
          </div>
          <div>
            <label for="Subject">Subject</label>
            <span class="required">(required)</span>
            <span class="error hidden" id="SubjectError">
              No Subject provided.
            </span>
            <input id="Subject" type="text" name="Subject"
            placeholder="Enter Subject of Message" required class="input">
          </div>
          <div>
            <label for="message">Enter Message</label>
            <span class="required">(required)</span>
            <span class="error hidden" id="messageError">
              No Message provided.
            </span>
            <textarea name="message" placeholder="Enter your Message"
            id="message" rows="13" cols="65" required class="input">
          </textarea>
        </div>
        <button type="submit" name="submit" id="submit">Send</button>
      </form>

      <?php
    }
    else {
      echo"<h4>Form Submitted. If you want to change something, resubmit
      the <a href='contact.php'>form</a>, or go back to
      <a href='index.php'> Home Page </a></h4>";
      $name= htmlspecialchars($fname)." ".htmlspecialchars($lname);
      echo("<h4>Thank you ".htmlspecialchars($name).".
      Your message has been submitted. You will receive a response within two
      business days. </h4>");
      if (isset($phone)) {echo("<h4>Phone: " .
        htmlspecialchars($phone) . "</h4>");}
        if (isset($email)) { echo("<h4>Email: " .
          htmlspecialchars($email) . "</h4>");}
          if (isset($subject)) {echo("<h4>Subject: " .
            htmlspecialchars($subject) . "</h4>");}
            if (isset($message)) {echo("<h4>Message: " .
              htmlspecialchars($message) . "</h4>");}

              $recipient = 'amartyau123@gmail.com';
              // enter email here

              $subject0 = "Contact form submission by ".
              htmlspecialchars($name);
              $mailBody= "From: ".htmlspecialchars($email)." ".
              htmlspecialchars($phone)."\nSubject: ".htmlspecialchars($subject).
              "\nMessage: ".htmlspecialchars($message);
              mail($recipient, $subject0, $mailBody);
            }
            ?>
          </div>

          <div class="line"></div>
        </div>
        <?php include("includes/footer.php");?>
      </body>

      </html>
