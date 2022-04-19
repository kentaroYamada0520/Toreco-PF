<?php
//constファイルを読み込む
require_once '../conf/const.php';
//modelを読み込む
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';

session_start();

//ログイン済みであればホーム画面へ移動
if (is_logined() === true) {
    redirect_to(HOME_URL);
}

//POSTで送信されたトークンがセッションにセットされている値を異なる場合はログインページへリダイレクト
if (is_valid_csrf_token($_POST['csrf_token']) === false) {
    redirect_to(LOGIN_URL);
}

$mail = get_post('mail_address');
$password = get_post('password');

//データーベースへ接続
$db = get_db_connect();
//ログイン処理
// var_dump($db);
$user = login_as($db, $mail, $password);

//var_dump($user);
if ($user === false) {
    set_error('ログインに失敗しました。');
    redirect_to(LOGIN_URL);
}
set_message('ログインしました。');

redirect_to(HOME_URL);
