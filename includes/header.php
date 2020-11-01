<header id="header" class="header">
      <div class="header__top">
        <!-- <div class="container"> -->
          <div class="header__top-logo">
            <h1><?php echo $config['title']?></h1>
          </div>
          <nav class="header__top-menu">
            <ul>
              <li><a href="/howdy-ho-3/index.php">Главная</a></li>
              <li><a href="/howdy-ho-3/pages/about_me.php">Обо мне</a></li>
              <li><a href="<?php $config['vk_url']?>" target="_blank">Я Вконтакте</a></li>
            </ul>
          </nav>
        <!-- </div> -->
      </div>

      <?php
        $categories = mysqli_query($connection, "SELECT * FROM `articles_categories`");
        $categories_arr = array();
        while($row_categories = mysqli_fetch_assoc($categories)) {
          $categories_arr[] = $row_categories;
        }
      ?>

      <div class="header__bottom">
        <!-- <div class="container"> -->
          <nav>
            <ul>
              <?php
              foreach ($categories_arr as $cat) {
                  ?>
                  <li><a href="/howdy-ho-3/articles.php?categorie=<?php echo $cat['id'];?>"><?php echo $cat['title'] ?></a></li>;
                  <?php
              }
              ?>
            </ul>
          </nav>
        <!-- </div> -->
      </div>
    </header>