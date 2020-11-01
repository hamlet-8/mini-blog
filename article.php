<?php
  require_once("includes/config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Блог IT_Минималиста!</title>
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
          <?php
            $article = mysqli_query($connection, "SELECT * FROM `articles` WHERE `id` = " . (int) $_GET['id']);

            if(mysqli_num_rows($article) <= 0) {
              ?>
                <div class="content-left__title">
                <h3>Статья не найдена!</h3>
              </div>
              <div class="block__content">

                <div class="full-text">
                  <div>
                    Запрашиваемая вами статья не существует!
                  </div>
                </div>
              </div>
              <?php
            }else {
              $article_row = mysqli_fetch_assoc($article);
              mysqli_query($connection, "UPDATE `articles` SET `views` = `views` + 1 WHERE `id` = " . (int) $article_row['id']);
              ?>
               
                <div class="content-left__title">
                <h3><?php echo $article_row['title']?></h3>
                <span><?php echo $article_row['views']?> просмотров</span>
              </div>
              <div class="block__content">
                <img src="/howdy-ho-3/static/images/<?php echo $article_row['img']?>">
                <div class="full-text">
                  <div>
                    <?php echo $article_row['text']?>
                  </div>
                </div>
              </div>
              <?php
            }
          ?>
            </div>
            <div class="content-left__block block">
            <div class="content-left__title">
              <h3>Комментарии к статье</h3>
              <a href="#comment-add-form">Добавить свой</a>
            </div>
              
              <div class="content-left__block-content block__content">
                <div class="content-left__articles-horizontal articles articles__vertical">
                <?php
                    $comments = mysqli_query($connection, "SELECT * FROM `comments` WHERE `articles_id` = " . (int) $article_row['id']  . "  ORDER BY `id` DESC");
                    if(mysqli_num_rows($comments) <= 0) {
                      echo 'Нет комментариев!';
                    }
                    while($comment = mysqli_fetch_assoc($comments)) {
                      ?>
                      <article class="article">
                        <div class="article__image" style="background-image: url(https://gravatar.com/avatar/<?php echo md5($comment['email'])?>?s=125);"></div>
                        <div class="article__info">
                          <a href="/howdy-ho-3/article.php?id=<?php echo $comment['articles_id']?>"><?php echo $comment['author']?></a>
                          <div class="article__info__preview"><?php echo strip_tags($comment['text']); ?></div>
                        </div>
                      </article>
                      <?php
                    }
                  ?>

                <!--   <article class="article">
                    <div class="article__image" style="background-image: url(https://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=125);"></div>
                    <div class="article__info">
                      <a href="#">Артём aka Snake</a>
                      <div class="article__info__meta">
                        <small>10 минут назад</small>
                      </div>
                      <div class="article__info__preview">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna ...</div>
                    </div>
                  </article> -->

                </div>
              </div>
            </div>

            <div class="block" id="comment-add-form">
            <div class="content-left__title">
              <h3>Добавить комментарий</h3>
            </div>
              <div class="block__content">
                <form novalidate class="form" method="POST" action="/howdy-ho-3/article.php?id=<?php echo (int) $article_row['id']?>#comment-add-form">
                <?php
                  if(isset($_POST['do_post'])) {
                    $errors = array();

                    if($_POST['name'] == '') {
                      $errors[] = 'Введите имя!';
                    }
                    if($_POST['nickname'] == '') {
                      $errors[] = 'Введите Никнейм!';
                    }
                    if($_POST['email'] == '') {
                      $errors[] = 'Введите email!';
                    }
                    if($_POST['text'] == '') {
                      $errors[] = 'Введите текст комментария!';
                    }
                    if(empty($errors)) {
                      mysqli_query($connection, "INSERT INTO `comments`  (`author`, `nickname`, `email`, `text`, `pubdate`, `articles_id`) 
                      VALUES ('".$_POST['name']."', '".$_POST['nickname']."', '".$_POST['email']."', '".$_POST['text']."', NOW(), '".$article_row['id']."')");
                      echo '<div style="color:green; font-weight:bold; margin-bottom: 10px">Комментарий успешно добавлен!</div>';
                    }else {
                      echo '<div style="color:red; font-weight:bold; margin-bottom: 10px">' . $errors[0] . '</div>';
                    }
                  }
                ?>
                  <div class="inputs">
                      <div>
                        <input type="text" required="" name="name" value="<?php if(isset($_POST['name'])) echo $_POST['name']?>" placeholder="Имя">
                      </div>
                      <div>
                        <input type="text" required="" name="nickname" value="<?php if(isset($_POST['nickname'])) echo $_POST['nickname']?>" placeholder="Никнейм">
                      </div>
                      <div>
                        <input type="text" required="" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']?>" placeholder="Email (не будет показан)">
                      </div>
                  </div>
                  <div class="textarea">
                    <textarea name="text" required="" placeholder="Текст комментария ..."><?php if(isset($_POST['text'])) echo $_POST['text']?></textarea>
                  </div>
                  <div class="submit-block">
                    <input type="submit" name="do_post" value="Добавить комментарий">
                  </div>
                </form>
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