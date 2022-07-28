<!DOCTYPE html>
<html lang="ja">

<head>
  <title>マイページ</title>
  <link rel="stylesheet" href="<?php print STYLESHEET_PATH . 'signup.css'; ?>">
</head>

<body>
  <?php include VIEW_PATH . 'templates/header_logined_other.php'; ?>
  <div class="conteiner">
    <main>


      <div class="row g-5">
        <div class="col-md-5 col-lg-4 order-md-last">
          <h4 class="d-flex justify-content-between align-items-center md-3">
            <span class="text-primary">アカウント情報</span>
            <span class="badge bg-primary rounded-pill" style="color: #fff;"><?php print $max; ?></span>
          </h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-sm">
              <h6 class="my-0">名前：<?php print $user['real_name']; ?></h6>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-sm">
              <h6 class="my-0">ユーザー名：<?php print $user['user_name']; ?></h6>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-sm">
              <h6 class="my-0">メールアドレス：<?php print $user['mail_address']; ?></h6>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-sm">
              <h6 class="my-0">秘密の質問：<?php print $user['question_content']; ?></h6>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-sm">
              <h6 class="my-0">秘密の質問の答え：<?php print $user['question_answer']; ?></h6>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-sm">
              <h6 class="my-0">配送先住所：<?php print $user['address']; ?></h6>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-sm">
              <h6 class="my-0">支払方法：<?php print $user['payment']; ?></h6>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-sm">
              <h6 class="my-0">自己紹介：<?php print $user['user_introduction']; ?></h6>
            </li>
          </ul>
          <form method="post" action="user_edit.php">
            <input type="submit" value="アカウント情報を編集する" class="btn btn-primary btn-block">
            <input type="hidden" value="<?php print $user_id; ?>">
            <input type="hidden" value="<?php print $token; ?>">
          </form>
          <form method="post" action="user_edit_password.php">
            <input type="submit" value="パスワードを変更する" class="btn btn-primary btn-block">
            <input type="hidden" value="<?php print $user_id; ?>">
            <input type="hidden" value="<?php print $token; ?>">
          </form>
        </div>

        <div class="col-md-7 col-lg-8">
          <div class="py-5 text-center">
            <h2><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-laughing-fill" viewBox="0 0 16 16">
                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zM7 6.5c0 .501-.164.396-.415.235C6.42 6.629 6.218 6.5 6 6.5c-.218 0-.42.13-.585.235C5.164 6.896 5 7 5 6.5 5 5.672 5.448 5 6 5s1 .672 1 1.5zm5.331 3a1 1 0 0 1 0 1A4.998 4.998 0 0 1 8 13a4.998 4.998 0 0 1-4.33-2.5A1 1 0 0 1 4.535 9h6.93a1 1 0 0 1 .866.5zm-1.746-2.765C10.42 6.629 10.218 6.5 10 6.5c-.218 0-.42.13-.585.235C9.164 6.896 9 7 9 6.5c0-.828.448-1.5 1-1.5s1 .672 1 1.5c0 .501-.164.396-.415.235z" />
              </svg><?php print $user['user_name']; ?></h2>
            <?php include VIEW_PATH . 'templates/messages.php'; ?>
          </div>



        </div>
      </div>
    </main>
  </div>
</body>