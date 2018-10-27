<?php

$pages =array(
  "contact" => "Contact Us",
  "join_us" => "Join Us",
  "events" => "Events",
  "index" => "About Us"
);

function exec_sql_query($db, $sql, $params = array()) {
  $query = $db->prepare($sql);
  if ($query and $query->execute($params)) {
    return $query;
  }
  return NULL;
}

// YOU MAY COPY & PASTE THIS FUNCTION WITHOUT ATTRIBUTION.
// open connection to database
function open_or_init_sqlite_db($db_filename, $init_sql_filename) {
  if (!file_exists($db_filename)) {
    $db = new PDO('sqlite:' . $db_filename);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db_init_sql = file_get_contents($init_sql_filename);
    if ($db_init_sql) {
      try {
        $result = $db->exec($db_init_sql);
        if ($result) {
          return $db;
        }
      } catch (PDOException $exception) {
        // If we had an error, then the DB did not initialize properly,
        // so let's delete it!
        unlink($db_filename);
        throw $exception;
      }
    }
  } else {
    $db = new PDO('sqlite:' . $db_filename);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
  }
  return NULL;
}

// open connection to database
$db = open_or_init_sqlite_db("website.sqlite", "init/init.sql");

/* -------------- MESSAGE FUNCTIONS -------------- */

// Array that stores messages to later show to the user
$messages = array();

// Record message to later display to the user
function record_message($message) {
  global $messages;
  array_push($messages, $message);
}

// Print out current messages to the user
function print_messages() {
  global $messages;
  foreach ($messages as $message) {
    echo "<p><strong>".htmlspecialchars($message)."</strong></p>\n";
  }
}

/* -------------- END MESSAGE FUNCTIONS -------------- */


/* -------------- LOG IN FUNCTIONS -------------- */

function check_login() {
  if (isset($_SESSION['current_user'])) {
    return $_SESSION['current_user'];
  }
  else {
    return NULL;
  }
}

function log_in($username, $password) {
  global $db;

  if ($username && $password) {
    $sql = "SELECT * FROM accounts WHERE username = :username;";
    $params = array(':username' => $username);
    $records = exec_sql_query($db, $sql, $params)->fetchAll();

    if ($records) {
      $account = $records[0];
      if (password_verify($password, $account['password'])) {
        $_SESSION['current_user'] = $username;
        return $username;
      }
      else {
        record_message("Invalid username or password. Please try again.");
      }
    }
    else {
      record_message("Invalid username or password. Please try again.");
    }
  }
  else {
    record_message("No username or password given. Please try again.");
  }
  return NULL;
}


function log_out() {
  global $current_user;
  $current_user = NULL;

  unset($_SESSION['current_user']);
  session_destroy();
}

// Check if user is logging in or logging out
session_start();
if (isset($_POST['login'])) {
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $username = trim($username);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

  $current_user = log_in($username, $password);
}
elseif (isset($_POST['logout'])) {
  log_out();
  record_message("You've successfully logged out.");
}
else {
  // Check if user is already logged in
  $current_user = check_login();
}

/* -------------- END LOG IN FUNCTIONS -------------- */

?>
