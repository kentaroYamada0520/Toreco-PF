  <!DOCTYPE html>
<html lang="ja">
<head>
<?php include VIEW_PATH . 'templates/head.php'; ?>
  
  <title>カート画面</title>
  <link rel="stylesheet" href="<?php print STYLESHEET_PATH . 'index.css'; ?>">
</head>
<body>
<?php include VIEW_PATH . 'templates/header_logined.php'; ?>
    <h1>カート</h1>
    <div class="row">
      <?php foreach ($items as $item) { ?>
       <div class="col">
         <div class="picture">
           <img src="<?php print $item['item_image']; ?>">
         </div>
         <div class="body">
           <h5><?php print $item['item_name']; ?></h5>
           <p><?php print $item['item_price']; ?></p>
         </div>
       </div>
       <?php } ?>
    </div>
</body>
