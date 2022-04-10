<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>アイテム出品</title>
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined.php';
//  include '../html/item_listing.php';
?>

  <div class="container">
    <h1>アイテム出品</h1>

    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <form 
      method="POST" 
      action="item_listing_process.php" 
      enctype="multipart/form-data"
      class="add_item_form col-md-6">
      <div class="form-group">
        <label for="image">商品画像: </label>
        <input type="file" name="item_image" id="image" value="<?php if (
            !empty($_POST['image'])
        ) {
            print $_SESSION['image'];
        } ?>">
      </div>
      <div class="form-group">
        <label for="name">アイテム名: </label>
        <input class="form-control" type="text" name="item_name" id="name">
      </div>
      <div class="form-group">
        <label for="category">アイテムカテゴリー: </label>
        <select id="category" name="category_code">
        <option>選択してください</option>
        <?php foreach ($categories as $category) { ?>
          <option value="<?php print $category[
              'category_code'
          ]; ?>"><?php print $category['category_name']; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="address">商品発送元住所: </label>
        <input class="form-control" type="text" name="item_address" id="address">
      </div>
      <div class="form-group">
        <label for="payment">支払方法: 
        <input type="radio" class="form-control" name="payment_designated_code" value="1"  id="payment">現金のみ
        <input type="radio" class="form-control" name="payment_designated_code"  value="2" id="payment">クレジットカード
        </label>
      </div>
      <div class="form-group">
        <label for="price">希望価格: </label>
        <input type="tel" name="item_price" id="price">
      </div>
      <div class="form-group">
        <label for="status">アイテムの状態: </label>
        <select id="status" name="status_code">
        <option>選択してください</option>
        <?php foreach ($statuses as $status) { ?>
          <option value="<?php print $status[
              'status_code'
          ]; ?>"><?php print $status['status_name']; ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="introduct">アイテム説明: </label>
        <textarea class="form-control" name="item_introduction" id="name" rows="5"></textarea>
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
        <label for="name">トレードしたいアイテム名を記載: </label>
        <input class="form-control" type="text" name="trade_item_name" id="trade_item_name">
      </div>
      <div class="form-group">
        <label for="shipping">発送期間: </label>
        <select id="shipping" name="shipping_code">
          <option>選択してください</option>
          <?php foreach ($shippings as $shipping) { ?>
          <option value="<?php print $shipping[
              'shipping_code'
          ]; ?>"><?php print $shipping['shipping_date']; ?></option>
          <?php } ?>  
        </select>
      </div>
      <input type="submit" value="アイテムを出品する" class="btn btn-primary">
      <input type="hidden" name="csrf_token" value="<?= $token ?>">
    </form>
    