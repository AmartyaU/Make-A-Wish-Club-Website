<?php
include("includes/init.php");

$current_page_id = "article";
$current_user = check_login();

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script type="text/javascript" src="scripts/jquery-3.2.1.js"></script>
  <script type="text/javascript" src="scripts/site.js"></script>
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />

  <title>Individual Event</title>
</head>

<body>
  <div class="body">
    <div class= "banner">
      <h1 class="title"> Make A Wish At Cornell </h1>
    </div>
    <?php include("includes/header.php");?>

    <?php
    print_messages();

    if(isset($_GET['article_id'])){
      $article_id = filter_input(INPUT_GET, 'article_id', FILTER_SANITIZE_STRING);
      $sql = "SELECT * FROM current_events WHERE id = :article_id";
      $params = array(":article_id" => $article_id);
      $records = exec_sql_query($db, $sql, $params)->fetchAll();

      if (isset($records) and !empty($records)) {

        foreach($records as $record) {
          echo("<div id='article1'>");
          $id=$record["id"];
          $title=$record["title"];
          $location=$record["location"];
          $date=$record["image_date"];
          $image_ext=$record["image_ext"];
          $article=$record["article"];
          echo("<h1> ".htmlspecialchars($title)."</h1>");
          echo("<figure>");
          echo "<img alt='Gallery Image'
          src= uploads/current_events/".htmlspecialchars($id).".".
          htmlspecialchars($image_ext).">";
          echo"<figcaption> <p> When: ".htmlspecialchars($date). " </p>";
          echo"<p> Where: ".htmlspecialchars($location). "</p>";
          //Source of 5K run article image: Client's image
          if ($title== 'Bake Sale'){
            echo("<p> Image Source: https://bit.ly/2rJtiHR </p> </figcaption>");
          }
          elseif ($title=='Carnation Sale') {
            echo("<p> Image Source: https://bit.ly/2wI2Set </p> </figcaption>");
          }
          echo("</figure>");
          if ($current_user) {  ?>
            <form class="deleteform1" action="events.php" method="post">
              <?php  echo "<input type='hidden' name='upcoming_id' value=".
              htmlspecialchars($id).">"; ?>
              <?php  echo "<input type='hidden' name='image_ext' value=".
              htmlspecialchars($image_ext).">"; ?>
              <button name="delete_article" type="submit">Delete</button>
            </form>
            <?php
          }
          echo"<p class='article_description'>".htmlspecialchars($article)."</p>";
          echo("</div>");

        }

      } else {
        echo ("No Event to Display.");
      }

    }

    if ($current_user) {
      ?>
      <div class="moveForm">
        <h2> Move this event to Past Events: </h2>

        <form id="archive" action="events.php#fixed" method="post" novalidate>

          <?php  echo "<input type='hidden' name='article_id' value='".
          htmlspecialchars($id)."'>"; ?>
          <?php  echo "<input type='hidden' name='image_ext' value='".
          htmlspecialchars($image_ext)."'>"; ?>
          <?php  echo "<input type='hidden' name='title' value='".
          htmlspecialchars($title)."'>";?>
          <label for="description">Describe What Happened In Event
          </label>(required)
          <span class="error hidden" id="descriptionError">
            Enter Description.
          </span>
          <input type="text" name="description" id="description"
          placeholder="Write 3-4 lines(max) about what happened in this event"
          class="input" required/>
          <?php echo "<button name='archive' type='submit'>Move</button>" ?>
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
