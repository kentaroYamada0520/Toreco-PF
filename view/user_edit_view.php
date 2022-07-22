<!DOCTYPE html>
<html lang="ja">

<head>
  <title>ユーザー情報更新</title>
  <link rel="stylesheet" href="<?php print STYLESHEET_PATH . 'signup.css'; ?>">
</head>

<body>
  <?php include VIEW_PATH . 'templates/header_logined_other.php'; ?>
  <div class="container">
    <h1>アカウント情報更新</h1>

    <?php include VIEW_PATH . 'templates/messages.php'; ?>
    <form method="post" action="user_edit_process.php">
      <div class="form-group">
        <p>名前: </p>
        <input type="text" name="real_name" value="<?php print $user['real_name']; ?>">
      </div>
      <div class="form-group">
        <p>ユーザー名: </p>
        <input type="text" name="user_name" value="<?php print $user['user_name']; ?>">
      </div>
      <div class="form-group">
        <p>メールアドレス: </p>
        <h3 name="mail_address"><?php print $user['mail_address']; ?></h3>
      </div>
      <div class="form-group">
        <p>現在のパスワード: </p>
        <input type="password" name="password_now">
      </div>

      <div class="form-group">
        <p>新しいパスワード</p>
        <input type="password" name="password">
      </div>

      <div class="form-group">
        <p>パスワード確認</p>
        <input type="password" name="password_confirmation">
      </div>

      <div class="form-group">
        <p>支払方法</p>
        <?php if ($pay === false) { ?>
          <input type="radio" name="payment_code" value="0">現金
          <input type="radio" name="payment_code" value="1" checked>クレジットカード
        <?php } else { ?>
          <input type="radio" name="payment_code" value="0" checked>現金
          <input type="radio" name="payment_code" value="1">クレジットカード
        <?php } ?>
      </div>

      <div class="form-group">
        <p>秘密の質問: </p>
        <select name="question_code">
          <option value="<?php print $user['question_code']; ?>" selected><?php print $user['question_content']; ?> </option>
          <?php foreach ($questions as $question) { ?>
            <option value="<?php print $question['question_code']; ?>"><?php print $question['question_content']; ?></option>
          <?php } ?>
        </select>
      </div>

      <div class="form-group">
        <p>秘密の質問の答え: </p>
        <input type="text" name="question_answer" value="<?php print $user['question_answer']; ?>">
      </div>
      <div class="form-group">
        <p>最寄り宅急便センター住所: </p>
        <input type="text" name="address" value="<?php print $user['address']; ?>">
      </div>
      <div class="form-group">
        <p>自己紹介文: </p>
        <input type="textarea" name="user_introduction" value="<?php print $user['user_introduction']; ?>">
      </div>



      <button type="submit" class="btn btn-primary btn-block">変更する</button>
      <input type="hidden" value="<?php print $user_id; ?>">
      <input type="hidden" value="<?php print $token; ?>">
    </form>
  </div>
</body>

</html>