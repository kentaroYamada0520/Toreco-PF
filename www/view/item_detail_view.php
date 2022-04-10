<!DOCTYPE html>
<html lang="ja">
    <head>
    <?php include VIEW_PATH . 'templates/head.php'; ?>
    
    <title>アイテム詳細</title>
    <link rel="stylesheet" href="<?php print STYLESHEET_PATH .
        'item_detail.css'; ?>">
    </head>
    <body>
    <?php include VIEW_PATH . 'templates/header_logined.php'; ?>
    <h1>アイテム詳細</h1>
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
            <p class="title">出品までの日数：</p>
            <p class="contents"><?php print h($item['shipping_date']); ?></p>
            
            


            <?php if ($trade_success_check > 0) { ?>
                <button type="button" class="btn btn-lg btn-secondary btn-block" disabled>トレード済みアイテム</button>
            <?php } elseif ($user['user_id'] === $item['user_id']) { ?>
                <button type="button" class="btn btn-lg btn-warning btn-block" disabled>トレードリクエスト送信</button>
            <?php } elseif ($detail === 'detail') { ?>
                <form action="trade_request.php" method="get">
                    <input type="submit" value="トレードリクエストへ戻る" class="btn btn-outline-info btn-block">
                    <input type="hidden" name="detail" value="detail">
                    <input type="hidden" name="csrf_token" value="<?= $token ?>">
                </form>
            <?php } else { ?>
                <form action="item_select.php" method="get">
                    <input type="submit" value="トレードリクエスト送信" class="btn btn-warning btn-block">
                    <input type="hidden" name="item_id" value="<?php print h(
                        $item['item_id']
                    ); ?>">
                    <input type="hidden" name="user_id" value="<?php print h(
                        $item['user_id']
                    ); ?>">
                    <input type="hidden" name="csrf_token" value="<?= $token ?>">
                </form>
            <?php } ?>
        </div>
        </div>
    </div>
    </div>
    </body>
</html>