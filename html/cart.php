<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'carts.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'user.php';

session_start();

//ログイン済みであればホーム画面へ移動
if (is_logined() === false) {
    redirect_to(LOGIN_URL);
}

//データーベースへ接続
$db = get_db_connect();
//ログインユーザー情報取得
$user = get_login_user($db);

$user_id = 1;
var_dump($user_id);

//特定のユーザIDを持つカートからアイテム情報を拾ってくる
$cart = get_user_cart($db, $user_id);
// var_dump($cart);
include_once VIEW_PATH . 'cart_view.php';
