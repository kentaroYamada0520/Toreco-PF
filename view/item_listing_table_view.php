<!DOCTYPE html>
<html lang="ja">
<head>
<?php include VIEW_PATH . 'templates/head.php'; ?>
  
  <title>出品アイテム一覧</title>
  <link rel="stylesheet" href="<?php print STYLESHEET_PATH . 'index.css'; ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
  

  <div class="container" id="link">
    <h1>出品アイテム一覧</h1>
    <?php include VIEW_PATH . 'templates/messages.php'; ?>
    <div class="row" style="margin:10px">
    <?php foreach ($items as $item) { ?>  
      <div class="col-xl-3" style="margin-bottom:10px">
    <div class="card" style="width: 16rem;">
  <img src="<?php print IMAGE_PATH .
      $item[
          'item_image'
      ]; ?>" class="bd-placeholder-img card-img-top" width="100%" height="180" preserveAspectRatio="xMi dYMid slice" focusable="false" role="img"><rect fill="#868e96" width="100%" height="100%"/>
  <div class="card-body" for="link">
    
  <form action="item_listing_detail.php" method="get">      
    <input type="submit" id="link" value="<?php print h(
        $item['item_name']
    ); ?>"class="btn btn-primary btn-block">
                     <input type="hidden" name="item_id" value="<?php print h(
                         $item['item_id']
                     ); ?>">
                    <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
                  </form>
                  <!-- <label style="text:right;">￥<?php print $item[
                      'item_price'
                  ]; ?></label> -->
                  </div>               
  </div>
</div>
<?php } ?>
</div>
</body>
</html>
