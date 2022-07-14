<!DOCTYPE html>
<html lang="ja">

<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>

  <title>購入履歴</title>
  <link rel="stylesheet" href="<?php print STYLESHEET_PATH . 'index.css'; ?>">
</head>

<body>

  <?php include VIEW_PATH . 'templates/header_logined_other.php'; ?>


  <div class="row" style="margin:20px">
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <h2>購入履歴</h2>
      <?php foreach ($my_purchase_ids as $my_purchase_id) {
        $sum = 0;
        $result = array();
        if (empty($result)) {
        } else {
          $items = $result;
          $result = array();
        } ?>
        <div class="card text-dark bg-light" style="margin-top:20px;">
          <div class="row">
            <table class="table table-borderless table-sm" style="margin-left:20px; text-align:center;">
              <!-- <tr>
                <td></td>
                <td>アイテム名</td>
                <td>金額</td>
              </tr> -->
              <!-- <hr class=" mb-4"> -->
              <?php foreach ($items as $item) {
                if ($my_purchase_id['my_purchase_id'] !== $item['my_purchase_id']) {
                  array_push($result, $item);
                } else {
                  $sum += $item['item_price']; ?>
                  <tr>
                    <td>
                      <div class="card" style="width: 16rem; margin:20px;">
                        <img src="<?php print IMAGE_PATH .
                                    $item['item_image']; ?>" class="bd-placeholder-img card-img-top" width="100%" height="130" preserveAspectRatio="xMi dYMid slice" focusable="false" role="img">
                        <rect fill="#868e96" width="100%" height="100%" />
                      </div>
                    </td>
                    <td class="d-flex align-items-center" style="margin:50px;">
                      <form method="get" action="item_detail.php">
                        <input type="submit" value="<?php print $item['item_name']; ?>" class="btn btn-primary btn-block">
                        <input type="hidden" name='item_id' value="<?php print $item['item_id']; ?>">
                        <input type="hidden" name="csrf_token" value="<?= $token ?>">
                      </form>
                    </td>
                    <td>
                      <h2 style="margin:50px;">￥<?php print $item['item_price']; ?></h2>
                    </td>
                  </tr>
                <?php } ?>
              <?php } ?>
              <tr>
                <td>
                  <h4><?php print date('Y/m/d', strtotime($my_purchase_id['now'])); ?>購入</h4>
                </td>
                <td></td>
                <td>
                  <h3>合計￥<?php print $sum ?></h3>
                </td>

              </tr>
            </table>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</body>