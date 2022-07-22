<!DOCTYPE html>
<html lang="ja">

<head>
    <?php include VIEW_PATH . 'templates/head.php'; ?>

    <title>出品アイテム詳細</title>
    <link rel="stylesheet" href="<?php print STYLESHEET_PATH .
                                        'item_detail.css'; ?>">
</head>

<body>
    <?php include VIEW_PATH . 'templates/header_logined.php'; ?>


    <h1>出品アイテム詳細</h1>
    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <div class="card mb-3" style="max-width: 1500px;">
        <div class="row g-0">
            <div class="col-md-3">
                <img class="card-img" src="<?php print IMAGE_PATH .
                                                $item['item_image']; ?>">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <p class="title">アイテム名：</p>
                    <p class="contents"><?php print h($item['item_name']); ?></h2>
                    <p class="title">価格：</p>
                    <p class="contents">¥<?php print h($item['item_price']); ?></p>
                    <P class="title">アイテムのカテゴリ：</p>
                    <p class="contents"><?php print h($item['category_name']); ?>
                    <P class="title">アイテムの状態：</p>
                    <p class="contents"><?php print h($item['status_name']); ?>
                    <P class="title">アイテム紹介：</p>
                    <p class="contents"><?php print h(
                                            $item['item_introduction']
                                        ); ?> </p>
                    <p class="title">トレードしたいアイテム：</p>
                    <p class="contents"><?php print h($item['trade_item_name']); ?></p>
                    <p class="title">出品者：</p>
                    <p class="contents"><?php print h($item['user_name']); ?>
                    <p class="title">発送元の地域：</p>
                    <p class="contents"><?php print h($item['item_address']); ?></p>
                    <p class="title">出荷までの日数：</p>
                    <p class="contents"><?php print h($item['shipping_date']); ?></p>

                    <form action="item_edit.php" method="post">
                        <input type="submit" id="link" value="アイテム編集" class="btn btn-primary btn-block">
                        <input type="hidden" name="item_id" value="<?php print h(
                                                                        $item['item_id']
                                                                    ); ?>">
                        <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
                    </form>

                    <form action="item_delete_process.php" method="post">
                        <input type="submit" id="link" value="アイテム削除" class="btn btn-danger btn-block">
                        <input type="hidden" name="item_id" value="<?php print h(
                                                                        $item['item_id']
                                                                    ); ?>">
                        <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
                    </form>



                </div>
            </div>
        </div>
    </div>
</body>

</html>