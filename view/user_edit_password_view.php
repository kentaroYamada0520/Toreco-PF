<!DOCTYPE html>
<html lang="ja">

<head>
    <title>パスワード変更</title>
    <link rel="stylesheet" href="<?php print STYLESHEET_PATH . 'signup.css'; ?>">
</head>

<body>
    <?php include VIEW_PATH . 'templates/header_logined_other.php'; ?>
    <div style="padding: 50px; margin-right:auto; margin-left:auto; width:500px; margin-top:60px; margin-bottom: 10px; border: 1px solid #333333;">
        <h1 style="text-align:center; padding-bottom:20px">パスワード変更</h1>

        <?php include VIEW_PATH . 'templates/messages.php'; ?>
        <form action="user_edit_password_process.php" method="post">
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-sm" style="border-width:0px;">
                    <h6 class="my-0">現在のパスワード：</h6>
                    <input type="password" name="password_now">
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm" style="border-width:0px;">
                    <h6 class="my-0">新しいパスワード：</h6>
                    <input type="password" name="password_new">
                </li>
                <li class="list-group-item d-flex justify-content-between lh-sm" style="border-width:0px;">
                    <h6 class="my-0">パスワード（確認用）：</h6>
                    <input type="password" name="password_confirm">
                </li>
                <input type="submit" value="パスワードを変更する" class="btn btn-primary">
                <input type="hidden" value="<?php print $token; ?>">
        </form>
    </div>


</body>