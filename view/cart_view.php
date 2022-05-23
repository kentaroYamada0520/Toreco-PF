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
            <div class="col-3" style="border-style:solid; border-width:2px; height:450px;">
            <h3>カート内アイテム</h3>
         <table style="border-collapse:separate; border-spacing:10px;">
            <tr>
              <th>アイテム名</th>
              <th>小計</th>
            </tr>
            <?php for ($i = 0; $i < $max; $i++) {
                $total += $pro_price[$i]; ?>
         
            <tr>
              <td><?php print $pro_name[$i]; ?></td>
              <td>￥<?php print $pro_price[$i]; ?>円</td>
            </tr>
            <?php
            } ?>
          </table>
         <p>--------------------------------------</p>
         <h3>合計:￥<?php print $total; ?>円</h3>
         <form method="post">
           <input type="submit" action="" value="レジへ進む" name="<?php print $items[
               'item_id'
           ]; ?>" class="btn btn-primary btn-block">
         </form>
         <?php } ?>
       </div>
     </div>
   </div>
</body>
