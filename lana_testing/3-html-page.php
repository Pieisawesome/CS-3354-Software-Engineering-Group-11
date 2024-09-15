<!DOCTYPE html>
<html>
  <head>
    <title>Products Demo Page</title>

    <!-- (A) CSS & JS -->
    <link href="4-style.css" rel="stylesheet">
    <script src="5-script.js"></script>
  </head>
  <body>
    <!-- (B) BOOKS LIST -->
    <div id="books"><?php
      require "2-products.php";
      foreach ($products as $p) { ?>
      <div class="bookWrap" data-id="<?=$p["product_id"]?>">
        <img class="bookImg" src="book.png">
        <div class="bookTitle"><?=$p["product_name"]?></div>
        <div class="bookDesc"><?=$p["product_description"]?></div>
      </div>
      <?php }
    ?></div>
  </body>
</html>