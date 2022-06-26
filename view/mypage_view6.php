<!DOCTYPE html>
<html lang="ja">
<head>
  <title>マイページ</title>
  <link rel="stylesheet" href="<?php print STYLESHEET_PATH . 'signup.css'; ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header_logined_other.php'; ?>
  <div class="container">
    <h1>ユーザー情報</h1>

    <?php include VIEW_PATH . 'templates/messages.php'; ?>

      <div class="form-group">
        <p>名前: </p>
        <h3 name="real_name"><?php print $user['real_name']; ?></h3>
      </div>
      <div class="form-group">
        <p>ユーザー名: </p>
        <h3 name="user_name"><?php print $user['user_name']; ?></h3>
      </div>
      <div class="form-group">
        <p>メールアドレス: </p>
        <h3 name="mail_address"><?php print $user['mail_address']; ?></h3>
      </div>
      <div class="form-group">
        <p>パスワード: </p>
        <h3 name="password">**************</h3>
      </div>
      <div class="form-group">
        <p>秘密の質問: </p>
        <h3 name="question_content"><?php print $user[
            'question_content'
        ]; ?></h3>
      </div>
      <div class="form-group">
        <p>秘密の質問の答え: </p>
        <h3 name="question_answer"><?php print $user['question_answer']; ?></h3>
      </div>
      <div class="form-group">
        <p>最寄り宅急便センター名: </p>
        <h3 name="address"><?php print $user['address']; ?></h3>
      </div>
      <div class="form-group">
        <p>支払方法: </p>
        <h3 name="payment"><?php print $user['payment']; ?></h3>
      </div>
      <div class="form-group">
        <p>自己紹介文: </p>
        <h3 name="user_introduction"><?php print $user[
            'user_introduction'
        ]; ?></h3>
      </div>

      <form method="post" action="user_edit.php">
        <input type="submit" value="ユーザー情報を編集する"class="btn btn-primary btn-block">
        <input type="hidden" value="<?php print $user_id; ?>">
        <input type="hidden" value="<?php print $token; ?>">
      </form>
  </div>
</body>
</html>