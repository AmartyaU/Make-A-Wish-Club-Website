<?php
include('includes/init.php');

$current_page_id = "join_us";

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
  <script src="scripts/jquery-3.2.1.min.js" type="text/javascript"> </script>


  <title>Join Us</title>
</head>

<body>
  <div class="body">
    <div class= "banner">
      <h1 class="title"> Make A Wish At Cornell </h1>
    </div>

    <?php include("includes/header.php");?>


    <div id="Recruitment_18">
      <h1 class="recruit_header"> Recruitment Fall 2018 </h1>
      <div id="InfoSession_1">
        <h2 class="recruit_header"> Information Session 1 </h2>
        <h3> When: September 10, 2018 | 2:55pm - 4:10pm</h3>
        <h3> Where: WSH </h3>
      </div>
      <br/>
      <div id="InfoSession_2">
        <h2 class="recruit_header"> Information Session 2</h2>
        <h3> When: September 12, 2018 | 2:55pm - 4:10pm </h3>
        <h3> Where: RPCC </h3>
      </div>
    </div>


    <div id="ST_Container">
      <h1> Student Testimonies </h1>
      <div id= "Student4">
        <figure>
          <!-- Image Source: Client's Camera -->
          <img id= "S_4_img" alt ="Student4" src = "images/student1.jpg"/>
          <figcaption> Daniella Manzano '19 </figcaption>
        </figure>
        <p id="S_4_txt">  "Make a Wish has been one of my best experiences at
          Cornell. I joined as a sophomore, after going to one of their
          information sessions at the beginning of the school year. I'd been
          involved with the raising money for the foundation back at
          home, and I was really excited to see that Make a Wish had
          a branch at my University."
        </p>
      </div>

      <div id= "Student5">
        <figure>
          <!-- Image Source: Client's Camera -->
          <img id= "S_5_img" alt ="Student5" src = "images/student2.png"/>
          <figcaption> Erica Scott '20 </figcaption>
        </figure>
        <p id="S_5_txt"> "I joined as a freshman, and I have since loved being
          part of such a welcoming and hardworking group of people.
          I've made great friends, gained leadership experience, and was able to
          make a positive impact in the lives of others. You won't find a more
          encouraging and dedicated group of students on campus!"
        </p>
      </div>

    </div>

    <div class="line"></div>
  </div>
  <?php include("includes/footer.php");?>
</body>

</html>
