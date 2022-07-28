<!DOCTYPE html>
<html lang="ja">

<head>
    <?php include VIEW_PATH . 'templates/head.php'; ?>
    <title>アイテム出品確認</title>
</head>

<body>
    <?php include VIEW_PATH . 'templates/header_logined_other.php';
    //  include '../html/item_listing.php';
    ?>

    <div class="container">
        <div class="row justify-content-start">
            <div class="col-3"></div>
            <div class="col-6">
                <h1>アイテム出品確認</h1>

                <?php include VIEW_PATH . 'templates/messages.php'; ?>

                <div class="form-group">
                    <label for="name">アイテム名: </label>
                    <p id="name" class="font-weight-bold"><?php print $name; ?></p>
                </div>



                <div class="form-group">
                    <label for="category">カテゴリー: </label>
                    <p id="category" class="font-weight-bold"><?php print $category_name; ?></p>
                </div>

                <div class="form-group">
                    <label for="shipping">発送期間: </label>
                    <p id="shipping" class="font-weight-bold"><?php print $shipping; ?>日</p>
                </div>

                <div class="form-group">
                    <label for="price">希望価格: </label>
                    <p id="price" class="font-weight-bold">￥<?php print $price; ?></p>
                </div>

                <div class="form-group">
                    <label for="introduct">アイテム説明: </label>
                    <p id="introduct" class="font-weight-bold"><?php print $introduct; ?></p>
                </div>

                <div class="form-group">
                    <label for="trade_item_name">トレードしたいアイテム: </label>
                    <p id="trade_item_name" class="font-weight-bold"><?php print $trade_item_name; ?></p>
                </div>

                <form action="item_listing_process.php" method="post">
                    <input type="submit" value="出品する" class="btn btn-primary btn-block">
                    <input type=" hidden" value="<?php print $image; ?>" name="item_image">
                    <input type="hidden" value="<?php print $name; ?>" name="item_name">
                    <input type="hidden" value="<?php print $category; ?>" name="category_code">
                    <input type="hidden" value="<?php print $price; ?>" name="item_price">
                    <input type="hidden" value="<?php print $status; ?>" name="status_code">
                    <input type="hidden" value="<?php print $trade_item_name; ?>" name="trade_item_name">
                    <input type="hidden" value="<?php print $shipping; ?>" name="shipping_code">
                    <input type="hidden" value="<?php print $introduct; ?>" name="introduct">
                </form>

            </div>
            <div class="col-3"></div>
        </div>
</body>