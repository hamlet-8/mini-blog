<?php
  require_once("../includes/config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Блог IT_Минималиста!</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>
<body>

  <div id="wrapper" class="wrapper">

    <?php include_once("../includes/header.php")?>

    <div id="content" class="content">
      <!-- <div class="container"> -->
        <!-- <div class="row"> -->
          <section class="content-left content__left">
            <div class="content-left__block block">
                <div class="content-left__title">
                <h3>Правообладателям</h3>
                </div>
                <div class="block__content">
                    <!-- <img src="../assets/images/post-image.jpg"> -->

                    <div class="full-text">
                       Текст о коперайтере ...
                    </div>
                    </div>
                </div>
          </section>

          <section class="content-right content__right">
            <?php include_once("../includes/sidebar.php")?>
          </section>
        <!-- </div> -->
      <!-- </div> -->
    </div>

    <?php include_once("../includes/footer.php")?>

  </div>

</body>
</html>