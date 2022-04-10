<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>ログイン</title>
  <link rel="stylesheet" href="<?php print(STYLESHEET_PATH . 'login.css'); ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header.php'; ?>
  <div class="container">
    <h1>ログイン</h1>

    <?php include VIEW_PATH . 'templates/messages.php'; ?>

    <form method="post" action="login_process.php" class="login_form mx-auto">
      <div class="form-group">
        <label for="mail">メールアドレス: </label>
        <input type="text" name="mail_address" id="mail" class="form-control">
      </div>
      <div class="form-group">
        <label for="password">パスワード: </label>
        <input type="password" name="password" id="password" class="form-control">
      </div>
      <input type="submit" value="ログイン" class="btn btn-primary">
      <input type="hidden" name="csrf_token" value="<?=$token?>">
    </form>
  </div>
</body>
</html>