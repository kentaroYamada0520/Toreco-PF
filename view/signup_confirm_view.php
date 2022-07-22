<!DOCTYPE html>
<html lang="ja">

<head>
    <?php include VIEW_PATH . 'templates/head.php'; ?>
    <title>サインアップ確認</title>
    <link rel="stylesheet" href="<?php print STYLESHEET_PATH . 'signup.css'; ?>">
</head>

<body>
    <?php include VIEW_PATH . 'templates/header.php'; ?>
    <div class="container">
        <h1>登録確認</h1>

        <?php include VIEW_PATH . 'templates/messages.php'; ?>

        <form method="post" action="signup_process.php" class="signup_form mx-auto">
            <div class="form-group">
                <label for="real_name">名前（姓・名）: </label>
                <p name="real_name" id="real_name" class="font-weight-bold"><?php print $real_name; ?></p>
            </div>
            <div class="form-group">
                <label for="user_name">ユーザー名（半角英数字）: </label>
                <p name="user_name" id="user_name" class="font-weight-bold"><?php print $user_name; ?></p>
            </div>
            <div class="form-group">
                <label for="mail">メールアドレス: </label>
                <!-- <input type="text" name="user_id" id="user_id" class="form-control"> -->
                <p name="mail_address" id="mail" class="font-weight-bold"><?php print $mail_address; ?></p>
            </div>
            <div class="form-group">
                <label for="password">パスワード: </label>
                <p name="password" id="password" class="font-weight-bold"><?php print $password; ?></p>
            </div>
            <div class="form-group">
                <label for="question">秘密の質問</label>
                <p name="question_code" class="font-weight-bold" id="question" value="<?php print $question_content['question_content']; ?>"><?php print $question_content['question_content']; ?></p>
            </div>
            <div class=" form-group">
                <label for="answer">秘密の質問答え: </label>
                <p name="question_answer" class="font-weight-bold" id="answer"><?php print $question_answer; ?></p>
            </div>
            <div class="form-group">
                <label for="address">配送先住所: </label>
                <p name="address" id="address" class="font-weight-bold"><?php print $address; ?></p>
            </div>
            <div class="form-group">
                <label for="payment">支払方法: </label>
                <p name="payment_code" id="payment" class="font-weight-bold" value="<?php print $payment; ?>"><?php print $payment_content['payment']; ?></p>
            </div>
            <div class="form-group">
                <label for="introduction">自己紹介文: </label>
                <p name="introduction" id="introduction" class="font-weight-bold"><?php print $introduction; ?></p>
            </div>
            <input type="submit" value="確認画面へ" class="btn btn-primary">
            <input type="hidden" name="csrf_token" value="<?= $token ?>">
            <input type="hidden" name="real_name" value="<?php print $real_name; ?>">
            <input type="hidden" name="user_name" value="<?php print $user_name; ?>">
            <input type="hidden" name="mail_address" value="<?php print $mail_address; ?>">
            <input type="hidden" name="password" value="<?php print $password; ?>">
            <input type="hidden" name="question_code" value="<?php print $question_code; ?>">
            <input type="hidden" name="question_answer" value="<?php print $question_answer; ?>">
            <input type="hidden" name="address" value="<?php print $address; ?>">
            <input type="hidden" name="payment_code" value="<?php print $payment; ?>">
            <input type="hidden" name="introduction" value="<?php print $introduction; ?>">
        </form>
        <form method="post" action="signup.php" class="signup_form mx-auto">
            <input type="submit" value="入力に戻る" class="btn btn-warning">
            <input type="hidden" name="real_name" value="<?php print $real_name; ?>">
            <input type="hidden" name="user_name" value="<?php print $user_name; ?>">
            <input type="hidden" name="mail_address" value="<?php print $mail_address; ?>">
            <input type="hidden" name="question_code" value="<?php print $question_code; ?>">
            <input type="hidden" name="question_answer" value="<?php print $question_answer; ?>">
            <input type="hidden" name="address" value="<?php print $address; ?>">
            <input type="hidden" name="payment_code" value="<?php print $payment; ?>">
            <input type="hidden" name="introduction" value="<?php print $introduction; ?>">
        </form>
    </div>
</body>

</html>