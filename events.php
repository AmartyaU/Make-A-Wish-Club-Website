<?php include('includes/init.php');

$current_page_id = "events";


$messages= array();
const MAX_FILE_SIZE = 10000000;
const BOX_UPLOADS_PATH = "uploads/current_events/";
$process="failure";
$valid_ext = array(
  "image/gif",
  "image/png",
  "image/jpeg",
  "image/pjpeg",);

  if (isset($_POST["submit"])) {
    $article  = filter_input(INPUT_POST, "article", FILTER_SANITIZE_STRING);
    $location= filter_input(INPUT_POST, "location", FILTER_SANITIZE_STRING);
    $title= filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);

    if($article!="" && $location!="" && $title!=""){

      $db->beginTransaction();

      $sql = "SELECT * FROM current_events WHERE title= :title";
      $params = array(':title' => $title);
      $records = exec_sql_query($db, $sql, $params)->fetchAll();
      if (!(isset($records) and !empty($records))){

        if (filter_input(INPUT_POST, "when", FILTER_VALIDATE_REGEXP,
        array("options"=>array("regexp"=>"/^(\d{4})-(\d{2})-(\d{2})$/")))) {
          $date = $_POST["when"];
        } else {
          $process= "date_failure";
        }

        $upload_info = $_FILES["box_file"];

        if ($upload_info['error'] == UPLOAD_ERR_OK) {
          $upload_name = trim(basename($upload_info["name"]));
          $upload_ext = trim(strtolower(pathinfo($upload_name,
          PATHINFO_EXTENSION)));

          if (in_array($upload_info["type"], $valid_ext)) {

            if(($upload_info['size'] > MAX_FILE_SIZE)) {
              array_push($messages, "Image you uploaded is too large. Max file
              size is 10MB. Reupload a smaller sized file. ");
            } else {

              if($process!= "date_failure"){
                $sql = "INSERT INTO current_events(title, location, image_date,
                  image_title, image_ext, article) VALUES(:title, :location,
                    :dateOfEvent, :image_title, :ext, :article);";
                    $params = array(
                      ':title' => $title,
                      ':location' => $location,
                      ':dateOfEvent' => $date,
                      ':image_title' => $upload_name,
                      ':ext' => $upload_ext,
                      ':article' => $article
                    );
                    $result = exec_sql_query($db, $sql, $params);

                    if ($result) {
                      $file_id = $db->lastInsertId("id");
                      if (move_uploaded_file($upload_info["tmp_name"],
                      BOX_UPLOADS_PATH ."$file_id.$upload_ext")){
                        array_push($messages, "Your file has been uploaded.");
                        $process="success";

                        $db->commit();

                      } else {
                        array_push($messages, "Could not upload file properly.");
                      }
                    } else {
                      array_push($messages, "Failed to upload file.");
                    }
                  }
                  array_push($messages,"No Date provided or invalid date format.");
                }
              } else {
                array_push($messages, "File you uploaded doesn't have a valid image
                extension(gif,png,jpeg,pjpeg). Reupload a correct image file.");
              }
            }
            else {
              array_push($messages, "Failed to upload file.");
            }
          }
          else
          {
            array_push($messages, "Please use a different title. Event already
            exists for given title");}
          }
          else
          {
            array_push($messages, "Please fill all fields before submitting.");}
          }

          if (isset($_POST["delete"])) {
            //pass past event into link
            $past_id = filter_input(INPUT_POST, 'past_id',
            FILTER_SANITIZE_STRING);
            $sql = "DELETE FROM past_events WHERE id = :past_id";
            $params = array(":past_id" => $past_id);
            exec_sql_query($db, $sql, $params);
          }

          if(isset($_POST["delete_article"])) {
            //pass upcoming event into link
            $upcoming_id = filter_input(INPUT_POST, 'upcoming_id',
            FILTER_SANITIZE_STRING);
            $image_ext = filter_input(INPUT_POST, 'image_ext',
            FILTER_SANITIZE_STRING);
            $full_name= $upcoming_id.".".$image_ext;
            $sql = "DELETE FROM current_events WHERE id = :upcoming_id";
            $params = array(":upcoming_id" => $upcoming_id);
            exec_sql_query($db, $sql, $params);
            unlink("uploads/current_events/".$full_name);
          }

          // Transfer current event into past events table
          if(isset($_POST['archive'])) {
            $db->beginTransaction();

            $article_id = filter_input(INPUT_POST, 'article_id',
            FILTER_SANITIZE_STRING);
            $image_ext = filter_input(INPUT_POST, 'image_ext',
            FILTER_SANITIZE_STRING);
            $full_name= $article_id.".".$image_ext;

            $title = filter_input(INPUT_POST, 'title',
            FILTER_SANITIZE_STRING);
            $title = trim($title);
            $description = filter_input(INPUT_POST, 'description',
            FILTER_SANITIZE_STRING);


            $sql_insert = "INSERT INTO past_events (title, description)
            VALUES (:title, :description)";
            $params_insert = array(":title" => $title,
            ":description" => $description);
            $records_insert = exec_sql_query($db, $sql_insert,
            $params_insert);

            $sql_delete = "DELETE FROM current_events
            WHERE id = :article_id";
            $params_delete = array(":article_id" => $article_id);
            $records_delete = exec_sql_query($db, $sql_delete,
            $params_delete);

            $db->commit();
            unlink("uploads/current_events/".$full_name);
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

  <title>Events</title>
</head>
<body>
  <div class="body">

    <div class= "banner">
      <h1 class= "title">Make A Wish At Cornell</h1>
    </div>

    <?php include("includes/header.php");?>

    <?php
    $sql = "SELECT * FROM current_events";
    $params = array();
    $records = exec_sql_query($db, $sql, $params)->fetchAll();

    if (isset($records) and !empty($records)) {
      echo"<h2 class='events_header'> Upcoming Events </h2>";
      echo("<div id='upcoming_events_container'>");
      foreach($records as $record) {
        $id=$record["id"];
        $title=$record["title"];
        $location=$record["location"];
        $date=$record["image_date"];
        $image_ext=$record["image_ext"];
        $article=$record["article"];
        $data= array('article_id' => $id);
        echo("<figure>");
        echo "<a class='current_event_image' href= 'article.php?".
        htmlspecialchars(http_build_query($data))."'>
        <img class='upcoming_events' alt='Gallery Image'
        src= uploads/current_events/".htmlspecialchars($id).".".
        htmlspecialchars($image_ext)."></a>";
        echo("<figcaption> <a class='upcoming_event_name' href=
        'article.php?".htmlspecialchars(http_build_query($data))."'>".
        htmlspecialchars($title)."</a>");
        echo" <p> When: ".htmlspecialchars($date). " </p>";
        echo"<p>Where: ".htmlspecialchars($location). "</p> </figcaption>";
        echo("</figure>");
      }
      echo("</div>");
    } else {
      echo ("No Upcoming Events to Display.");
    }

    $sql = "SELECT * FROM past_events";
    $params = array();
    $records = exec_sql_query($db, $sql, $params)->fetchAll();

    if (isset($records) and !empty($records)) {
      echo("<div id='past_events'>");
      echo"<h2 class='events_header'> Past Events </h2>";
      foreach($records as $record) {
        if(isset($_POST['archive'])) {echo"<div id='fixed'></div>";}
        $id=$record["id"];
        $title=$record["title"];
        $description=$record["description"];
        echo("<h3>".htmlspecialchars($title)."</h3>");
        if ($current_user) {  ?>
          <form class="deleteform" action="events.php" method="post">
            <?php  echo "<input type='hidden' name='past_id' value=".
            htmlspecialchars($id).">"; ?>
            <button name="delete" type="submit">Delete</button>
          </form>
          <?php
        }
        echo"<p class='past_event_description'> Description: ".
        htmlspecialchars($description);
        echo"</p>";
      }
    } else {
      echo ("No Past Events to Display.");
    }
    echo("</div>");
    if ($current_user) {
      ?>

      <div id='uploadFile_container'>
        <h2 >Add an Event(All fields are required):</h2>
        <?php
        if (isset($_POST["submit"])){
          echo(" <div class='homepageContent2'>");
          if ($process=="success"){ echo "Your article has been uploaded in
            Upcoming Events! You can view it above. If you want to add another
            article, you can add it below.";}
            else {  print_messages();}
            echo"</div>";
          } ?>
          <form id='uploadFile' action='events.php#uploadFile1' method='post'
          enctype='multipart/form-data' novalidate>
          <div>
            <label for="title">Title</label>(Name of Event)
            <span class="error hidden" id="TitleError">
              No Title provided.
            </span>
            <input id="title" type="text" name="title" placeholder="Enter Title"
            required class="input">
          </div><div>
            <label for="location">Where</label>(Location of Event)
            <span class="error hidden" id="LocationError">
              No Location provided.
            </span>
            <input id="location" type="text" name="location"
            placeholder="Enter Location" required class="input">
          </div>
          <div>
            <label for="date">When</label>(Time of Event)
            <span class="error hidden" id="DateError">
              No Date provided or invalid Date format.
            </span>
            <input type="date" name="when" min="2018-01-01" id="date"
            class="input" required/>

            <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
            <label>Upload image</label>(Image of Event)
            <span class="error hidden" id="fileError">
              No Image Uploaded.
            </span>
            <input type="file" name="box_file" id="file" required class="input">
          </div>

          <label for="article">About the Event</label>(Description of Event)
          <span class="error hidden" id="messageError">
            No Description provided.
          </span>
          <textarea name="article" id="article" rows="13"
          cols="65" required class="input"
          placeholder="Write a few paragraphs describing the event(Give details)">
          </textarea>
          <button name="submit" id="submit" type="submit">Add Event</button>
          </form>
        </div>
      <?php
      }
      ?>



      <div class="line"></div>
    </div>
    <?php include("includes/footer.php");?>
  </body>
  </html>
