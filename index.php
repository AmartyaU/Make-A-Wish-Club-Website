<?php
include('includes/init.php');

$current_page_id = "index";

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" type="text/css" href="styles/all.css" media="all" />
  <script src="scripts/jquery-3.2.1.min.js" type="text/javascript"> </script>

  <title>About Us</title>
</head>

<body>
  <div class="body">
    <div class= "banner">
      <h1 class="title"> Make A Wish At Cornell </h1>
    </div>

    <?php include("includes/header.php");?>


    <div id= "home_make_a_wish">
      <h2>  Make A Wish </h2>
      <p>Tens of thousands of volunteers, donors and supporters advance the
         Make-A-Wish® vision to grant the wish of every child diagnosed with a
         critical illness. In the United States and its territories, on average,
         a wish is granted every 34 minutes. We believe a wish experience can
         be a game-changer. This one belief guides us and inspires us to grant
         wishes that change the lives of the kids we serve.
       </p>
        </div>
        <div id="home_cornell_mission">
          <h2> Who We Are </h2>

          <p>Make-A-Wish at Cornell was founded in 2015 and organizes
             fundraisers every semester to raise money for Make-A-Wish of
             Central New York. Our goal every year is to raise enough funds to
             sponsor a wish kid and bring them to campus to meet our club!
          </p>


          </div>
          <!--slideshow source: https://www.w3schools.com/howto/howto_js_slideshow.asp -->
          <!-- slideshow image source: Client's Camera -->
          <div class="slideshow-container">

            <div class="mySlides fade">
              <div class="numbertext">1 / 3</div>
              <figure>
                <img class="slideshow-image" alt="MakeAWish"
                src="images/kid.jpg"/>
                <!-- source: Client's image -->
              </figure>
            </div>

            <div class="mySlides fade">
              <div class="numbertext">2 / 3</div>
              <figure>
                <img class="slideshow-image" alt="MakeAWish"
                src="images/group_pic.jpg"/>
                <!-- source: Client's image -->
              </figure>
            </div>

            <div class="mySlides fade">
              <div class="numbertext">3 / 3</div>
              <figure>
                <img class="slideshow-image" alt="MakeAWish"
                src="images/balloons.jpg"/>
                <!-- source: Client's image -->
              </figure>
            </div>

            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>


            <div id="dot">
              <span class="dot" onclick="currentSlide(1)"></span>
              <span class="dot" onclick="currentSlide(2)"></span>
              <span class="dot" onclick="currentSlide(3)"></span>
            </div>

            <script src="scripts/slideShow.js" type="text/javascript"> </script>
          </div>

          <div class="line"></div>
        </div>
        <?php include("includes/footer.php");?>
      </body>

      </html>
