<footer id= 'footer'>
  <div class="bottom">
    <nav>
      <ul>
        <li class="foot">
          <a href= 'http://wish.org/#sm.000jfsj2qscxfli11wt1gog57u2pg'>
            Make A Wish Foundation </a></li>
            <?php
            if ($current_user)
            {echo"<li class='foot'><a href= 'login.php'> Logout </a></li>";}
            else{echo"<li class='foot'><a href= 'login.php'> Login </a></li>";}
            ?>
            <li class="foot">
              <a href= 'https://www.facebook.com/makeawishcornell/'>
                <img class="icon" alt="MakeAWish Facebook page"
                src="images/social-facebook.png" /></a>
                <a href= 'https://www.instagram.com/makeawishcornell/'>
                  <img class="icon" alt="MakeAWish Instagram page"
                  src="images/social-insta.png" /></a>
                </li>
                <!-- Source of icons: cornellclubnyc.com -->
                <li class="source"> Source of icons: cornellclubnyc.com.</li>
              </ul>
            </nav>
          </div>
        </footer>
