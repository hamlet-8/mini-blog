<?php
  require_once("includes/config.php");
  $articles = mysqli_query($connection, "SELECT * FROM `articles` ORDER BY `id` DESC LIMIT 10");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $config['title']?></title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
</head>
<body>

  <div id="wrapper" class="wrapper">

    <?php include_once("./includes/header.php")?>

    <div id="content" class="content">
      <!-- <div class="container"> -->
        <!-- <div class="row"> -->
          <section class="content-left content__left">

            <div class="content-left__block block">
              <div class="content-left__title">
                <h3>Новейшее_в_блоге</h3>
                <a href="/howdy-ho-3/articles.php">Все записи</a>
              </div>
              
              <div class="content-left__block-content block__content">
                <div class="content-left__articles-horizontal articles articles__horizontal">
                  
               
                <?php
                while($row_articles = mysqli_fetch_assoc($articles)) {
                  ?>
                  <article class="article">
                    <div class="article__image" style="background-image: url(static/images/<?php echo $row_articles['img']?>);"></div>
                    <div class="article__info">
                      <a href="/howdy-ho-3/article.php?id=<?php echo $row_articles['id']?>"><?php echo $row_articles['title']?></a>
                      <div class="article__info__meta">
                        <?php 
                          $art_cat = false;
                          foreach ($categories_arr as $cat) {
                            if($cat['id'] == $row_articles['categorie_id']) {
                              $art_cat = $cat;
                              break;
                            }
                          }
                        ?>
                        <small>Категория: <a href="/howdy-ho-3/articles.php?categorie=<?php echo $art_cat['id']?>"><?php echo $art_cat['title'] ?></a></small>
                      </div>
                      <div class="article__info__preview"><?php echo mb_substr(strip_tags($row_articles['text']), 0, 50, 'utf-8') . ' ...'; ?></div>
                    </div>
                  </article>
                  <?php
                }
              ?>

                </div>
              </div>
            </div>

            <div class="content-left__block block">
              <div class="content-left__title">
                <h3>Безопасность [Новейшее]</h3>
                <a href="/howdy-ho-3/articles.php?categorie=6">Все записи</a>
              </div>
              
              <div class="content-left__block-content block__content">
                <div class="content-left__articles-horizontal articles articles__horizontal">

                <?php
                $articles = mysqli_query($connection, "SELECT * FROM `articles` WHERE `categorie_id` = 6 ORDER BY `id` DESC LIMIT 10");

                while($row_articles = mysqli_fetch_assoc($articles)) {
                  ?>
                  <article class="article">
                    <div class="article__image" style="background-image: url(static/images/<?php echo $row_articles['img']?>);"></div>
                    <div class="article__info">
                      <a href="/howdy-ho-3/article.php?id=<?php echo $row_articles['id']?>"><?php echo $row_articles['title']?></a>
                      <div class="article__info__meta">
                        <?php 
                          $art_cat = false;
                          foreach ($categories_arr as $cat) {
                            if($cat['id'] == $row_articles['categorie_id']) {
                              $art_cat = $cat;
                              break;
                            }
                          }
                        ?>
                        <small>Категория: <a href="/howdy-ho-3/articles.php?categorie=<?php echo $art_cat['id']?>"><?php echo $art_cat['title'] ?></a></small>
                      </div>
                      <div class="article__info__preview"><?php echo mb_substr(strip_tags($row_articles['text']), 0, 50, 'utf-8') . ' ...'; ?></div>
                    </div>
                  </article>
                  <?php
                }
              ?>

                </div>
              </div>
            </div>

            <div class="content-left__block block">
              <div class="content-left__title">
                <h3>Программирование [Новейшее]</h3>
                <a href="/howdy-ho-3/articles.php?categorie=4">Все записи</a>
              </div>
              <div class="content-left__block-content block__content">
                <div class="content-left__articles-horizontal articles articles__horizontal">

                <?php
                $articles = mysqli_query($connection, "SELECT * FROM `articles` WHERE `categorie_id` = 4 ORDER BY `id` DESC LIMIT 10");

                while($row_articles = mysqli_fetch_assoc($articles)) {
                  ?>
                  <article class="article">
                    <div class="article__image" style="background-image: url(static/images/<?php echo $row_articles['img']?>);"></div>
                    <div class="article__info">
                      <a href="/howdy-ho-3/article.php?id=<?php echo $row_articles['id']?>"><?php echo $row_articles['title']?></a>
                      <div class="article__info__meta">
                        <?php 
                          $art_cat = false;
                          foreach ($categories_arr as $cat) {
                            if($cat['id'] == $row_articles['categorie_id']) {
                              $art_cat = $cat;
                              break;
                            }
                          }
                        ?>
                        <small>Категория: <a href="/howdy-ho-3/articles.php?categorie=<?php echo $art_cat['id']?>"><?php echo $art_cat['title'] ?></a></small>
                      </div>
                      <div class="article__info__preview"><?php echo mb_substr(strip_tags($row_articles['text']), 0, 50, 'utf-8') . ' ...'; ?></div>
                    </div>
                  </article>
                  <?php
                }
              ?>

                </div>
              </div>
            </div>
          </section>

          <section class="content-right content__right">
            <?php include_once("./includes/sidebar.php")?>
          </section>
        <!-- </div> -->
      <!-- </div> -->
    </div>

    <?php include_once("./includes/footer.php")?>
  </div>

</body>
</html>