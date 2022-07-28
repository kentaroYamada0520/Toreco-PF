<?php
//constファイルを読み込む
require_once '../conf/const.php';
//modelを読み込む
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'db.php';

session_start();

if (is_logined() === false) {
    redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);
$token = get_csrf_token();
$user_id = $user['user_id'];
$password = $user['password'];
$password_now = get_post('password_now');
$password_new = get_post('password_new');
$password_confirm = get_post('password_confirm');

if ($password === $password_now) {
    if ($password_new === $password_confirm) {
        edit_password($db, $password_new, $user_id);
        set_message('パスワードを変更しました。');
    }
} else {
    set_error('パスワードが違います。');
    redirect_to(PASSWORD_EDIT_URL);
}




include_once VIEW_PATH . 'mypage_view.php';
