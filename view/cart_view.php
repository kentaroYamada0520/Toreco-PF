  <!DOCTYPE html>
<html lang="ja">
<head>
<?php include VIEW_PATH . 'templates/head.php'; ?>
  
  <title>カート画面</title>
  <link rel="stylesheet" href="<?php print STYLESHEET_PATH . 'index.css'; ?>">
</head>

<body>
<?php include VIEW_PATH . 'templates/header_logined_other.php'; ?>
    <h1 style="margin-left:20px">カート
    <?php if ($max === 0) { ?>
      <h3 style="margin-left:30px">アイテムがありません。</h3>
      <?php } else { ?>
    <h3>(アイテム点数：<?php print $max; ?>)</h3></h1>
    <?php include VIEW_PATH . 'templates/messages.php'; ?>
   <div class="container">
     <div class="row">
       <div class="col-9">
        <?php foreach ($items as $item) { ?>
          <table style="margin:10px">
            <td style="width: 16rem;">
          <img src="<?php print IMAGE_PATH .
              $item[
                  'item_image'
              ]; ?>" class="bd-placeholder-img card-img-top" width="100%" height="180" preserveAspectRatio="xMi dYMid slice" focusable="false" role="img"><rect fill="#868e96" width="100%" height="100%"/>
              </td>
              <td>
          <ul style="list-style:none">
            <li><h2><?php print $item['item_name']; ?></h2></li>
            <li><h3>￥<?php print $item['item_price']; ?></h3></li>
            <li><form action="delete_process.php" method="post">
              <input type="submit" value="削除" class="btn btn-danger">
              <input type="hidden" name="cart_id" value="<?php print $item[
                  'cart_id'
              ]; ?>">
               <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
            </form></li>
          </ul>
          </td>
          </table>
          <p>------------------------------------------------------------------------------------------------------------------------</p>
        <?php } ?>
       </div>
       <?php } ?>
       
      
      
       
       <?php if ($max === 0) { ?> 
          <?php } else { ?>
            <!-- <div class="col-3 border border-primary rounded border-7" style="height: 400px"> -->
            <div class="col-3">
            <h4 class="d-flex justify-content-between align-items-center md-3">
        <span class="text-primary">カート</span>
        <span class="badge bg-primary rounded-pill" style="color: #fff;"><?php print $max; ?></span>
      </h4>
      <ul class="list-group mb-3">
      <?php for ($i = 0; $i < $max; $i++) {
          $total += $pro_price[$i]; ?>
        <li class="list-group-item d-flex justify-content-between lh-sm">
          <div>
            <h6 class="my-0"><?php print $pro_name[$i]; ?></h6>
            <small class="text-muted"><?php print $pro_category[$i]; ?></small>
          </div>
         <span class="text-muted">￥<?php print $pro_price[$i]; ?>円</span>
        </li>
        <?php
      } ?>
        <li class="list-group-item d-flex justify-content-between">
          <span>合計</span>
          <strong>￥<?php print $total; ?>円</strong>
        </li>
      </ul>
         <form action="purchase.php" method="post">
           <input type="submit" value="レジへ進む"  class="btn btn-primary btn-block">
         </form>
         <?php } ?>
       </div>
     </div>
   </div>
</body>
