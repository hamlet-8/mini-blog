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
                <h3>Все статьи</h3>
              </div>
              
              <div class="content-left__block-content block__content">
                <div class="content-left__articles-horizontal articles articles__horizontal">
                  
               
                <?php
                    $per_page = 4;
                    $page = 1;

                    if (isset($_GET['page'])) {
                      $page = (int) $_GET['page'];
                    }

                    $total_count_q = mysqli_query($connection, "SELECT COUNT(`id`) AS `total_count` FROM `articles`");
                    $total_count = mysqli_fetch_assoc($total_count_q);
                    $total_count = $total_count['total_count'];

                    $total_pages = ceil($total_count / $per_page);
                    if ($page <= 1 || $page > $total_pages) {
                      $page = 1;
                    }

                    $offset = ($per_page * $page) - $per_page;
                    
                    $articles = mysqli_query($connection, "SELECT * FROM `articles` ORDER BY `id` DESC LIMIT $offset, $per_page");
                    $articles_exist = true;

                    if(mysqli_num_rows($articles) <= 0) {
                      echo "Статьи не существует!";
                      $articles_exist = false;
                    }
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
                <?php
                  if ($articles_exist == true) {
                    echo '<div class="paginator">';
                      if ($page > 1) {
                        echo '<a href="/howdy-ho-3/articles.php?page='.($page - 1).'">&laquo; Прошлая страница </a>';
                      }
                      if ($page < $total_pages) {
                        echo '<a href="/howdy-ho-3/articles.php?page='.($page + 1).'">Следующая страница &raquo;</a>';
                      }
                    echo '</div>';
                  }
                ?>
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