<!DOCTYPE html>
<html lang="ja">

<head>
    <title>アイテム削除</title>
    <link rel="stylesheet" href="<?php print STYLESHEET_PATH . 'signup.css'; ?>">
</head>

<body>
    <?php include VIEW_PATH . 'templates/header_logined_other.php'; ?>
    <main>
        <form method="post" action="item_delete_process.php">
            <input type="submit" value="削除する" class="btn btn-danger btn-block">
            <input type="hidden" value="<?php print $item_id; ?>">
            <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
        </form>
        <form method="post" action="item_listing_detail.php">
            <input type="submit" value="戻る" class="btn btn-warning btn-block">
            <input type="hidden" value="<?php print $item_id; ?>">
            <input type="hidden" name="csrf_token" value="<?php print $token; ?>">
        </form>
    </main>
</body>