<!DOCTYPE html>
<html lang="ja">

<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <?php require_once MODEL_PATH . 'db.php'; ?>
  <title>サインアップ</title>
  <link rel="stylesheet" href="<?php print STYLESHEET_PATH . 'signup.css'; ?>">
</head>

<body>
  <?php include VIEW_PATH . 'templates/header.php'; ?>
  <div class="container">
    <h1>ユーザー登録</h1>

    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <form method="post" action="signup_confirm.php" class="signup_form mx-auto">
      <div class="form-group">
        <label for="real_name">名前（姓・名）: </label>
        <input type="text" name="real_name" value="<?php print $real_name; ?>" id="real_name" class="form-control">
      </div>
      <div class="form-group">
        <label for="user_name">ユーザー名（半角英数字）: </label>
        <input type="text" name="user_name" value="<?php print $user_name; ?>" id="user_name" class="form-control">
      </div>
      <div class="form-group">
        <label for="mail">メールアドレス: </label>
        <!-- <input type="text" name="user_id" id="user_id" class="form-control"> -->
        <input type="text" name="mail_address" value="<?php print $mail_address; ?>" id="mail" class="form-control">
      </div>
      <div class="form-group">
        <label for="password">パスワード: </label>
        <input type="password" name="password" value="<?php print $password; ?>" id="password" class="form-control">
      </div>
      <div class="form-group">
        <label for="password_confirmation">パスワード（確認用）: </label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
      </div>
      <div class="form-group">
        <label for="question">秘密の質問</label>
        <select id="question" name="question_code">
          <option>選択してください</option>
          <?php foreach ($questions as $question) { ?>
            <option value="<?php print $question['question_code']; ?>" <?php $pro_question = $question['question_code'];
                                                                        if ($question_code === "$pro_question") {
                                                                          print "selected";
                                                                        } ?>> <?php print $question['question_content']; ?></option>
          <?php } ?>
        </select>

      </div>
      <div class="form-group">
        <label for="answer">秘密の質問答え: </label>
        <input type="text" name="question_answer" value="<?php print $question_answer; ?>" id="answer" class="form-control">
      </div>
      <div class="form-group">
        <label for="address">配送先住所: </label>
        <input type="text" name="address" id="address" value="<?php print $address; ?>" class="form-control">
      </div>
      <div class="form-group">
        <label for="payment">支払方法: </label>



        <?php if ($payment === "0") { ?>
          <input type="radio" value="0" name="payment_code" checked><label>現金</label>
          <input type="radio" value="1" name="payment_code"><label>クレジットカード</label>
        <?php } elseif ($payment === "1") { ?>
          <input type="radio" value="0" name="payment_code"><label>現金</label>
          <input type="radio" value="1" name="payment_code" checked><label>クレジットカード</label>
        <?php } else { ?>
          <input type="radio" value="0" name="payment_code"><label>現金a</label>
          <input type="radio" value="1" name="payment_code"><label>クレジットカードa</label>
        <?php } ?>
      </div>
      <div class="form-group">
        <label for="textarea">自己紹介文: </label>
        <textarea name="introduction" id="textarea" class="form-control" rows="6"><?php print $introduction; ?></textarea>
      </div>
      <input type="submit" value="確認画面へ" class="btn btn-primary">
      <input type="hidden" name="csrf_token" value="<?= $token ?>">
    </form>
  </div>
</body>

</html>