<header>
  <div class="menu">
    <ul>
      <?php
      foreach($pages as $key => $value ) {
        if ($key == $current_page_id) {
          echo "<li><a id = 'current_page' href='" . $key . ".php'>".
          $value ."</a></li>";
        }
        else {
          echo "<li><a href='" . $key . ".php'>". $value ."</a></li>";
        }
      }
      ?>
    </ul>
  </div>
</header>
