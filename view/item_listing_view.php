<!DOCTYPE html>
<html lang="ja">

<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>アイテム出品</title>
</head>

<body>
  <?php include VIEW_PATH . 'templates/header_logined_other.php';
  //  include '../html/item_listing.php';
  ?>

  <div class="container">
    <div class="row justify-content-start">
      <div class="col-3"></div>
      <div class="col-6">
        <h1>アイテム出品</h1>

        <?php include VIEW_PATH . 'templates/messages.php'; ?>

        <form method="POST" action="item_listing_process.php" enctype="multipart/form-data" class="add_item_form col-md-6">

          <div class="form-group">
            <label for="name">アイテム名: </label>
            <input class="form-control" type="text" name="item_name" value="<?php print $name; ?>" id="name">
          </div>
          <div class="form-group">
            <label for="image">商品画像: </label>
            <input type="file" name="item_image" id="image" value="<?php $image; ?>">
          </div>
          <div class="form-group">
            <label for="category">アイテムカテゴリー: </label>
            <select id="category" name="category_code">
              <option value="">選択してください</option>
              <?php foreach ($categories as $category) {
                $category_code = $category['category_code'];
                $category_name = $category['category_name'];
                if ($category_code === $item_category) { ?>
                  <option value="<?php print $category_code; ?>" selected><?php print $category_name; ?></option>
                <?php } else { ?>
                  <option value="<?php print $category_code; ?>"><?php print $category_name; ?></option>
              <?php }
              } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="shipping">発送期間: </label><br>
            <select id="shipping" name="shipping_code">
              <option>選択してください</option>

              <?php
              foreach ($shippings as $shipping) {
                $shipping_code = $shipping['shipping_code'];
                $shipping_date = $shipping['shipping_date'];
                if ($shipping_code === $item_shipping) { ?>
                  <option value="<?php print $shipping_code; ?>" selected><?php print $shipping_date; ?></option>
                <?php } else { ?>
                  <option value="<?php print $shipping_code; ?>"><?php print $shipping_date; ?></option>
              <?php }
              } ?>


            </select>
          </div>
          <div class="form-group">
            <label for="price">希望価格: </label>
            <input type="number" value="<?php print $price; ?>" name="item_price" id="price">
          </div>
          <div class="form-group">
            <label for="status">アイテムの状態: </label>
            <select id="status" name="status_code">
              <option>選択してください</option>
              <?php foreach ($statuses as $status) {
                $status_code = $status['status_code'];
                $status_name = $status['status_name'];
                if ($status_code === $item_status) { ?>
                  <option value="<?php print $status_code; ?>" selected><?php print $status_name; ?></option>
                <?php } else { ?>
                  <option value="<?php print $status_code; ?>"><?php print $status_name; ?></option>
              <?php }
              } ?>
            </select>
          </div>
          <div class="form-group">
            <label for="introduct">アイテム説明: </label>
            <textarea class="form-control" name="item_introduction" id="name" rows="5"><?php print $introduct; ?></textarea>
          </div>



          <!-- <div class="form-group">
        <label for="quality">アイテムの状態: </label>
        <select class="form-control" name="status_code" id="quality">
          <option value=""></option>
          <option value="1">未開封</option>
          <option value="2">ほぼ新品</option>
          <option value="3">傷あり</option>
        </select>
      </div> -->
          <div class="form-group">
            <label for="name">トレードしたいアイテム: </label>
            <input class="form-control" type="text" name="trade_item_name" value="<?php print $trade_item_name; ?>" id="trade_item_name">
          </div>
          <input type="submit" value="アイテムを出品する" class="btn btn-primary btn-block">
          <input type="hidden" name="csrf_token" value="<?= $token ?>">
        </form>
      </div>
      <div class="col-3"></div>
    </div>
</body>