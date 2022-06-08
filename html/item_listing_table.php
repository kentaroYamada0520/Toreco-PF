<?php
//constファイルを読み込む
require_once '../conf/const.php';
//modelを読み込む
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';

session_start();

//ログインしていなければログイン画面へ移動
if (is_logined() === false) {
    redirect_to(LOGIN_URL);
}

//データーベースへ接続
$db = get_db_connect();
//ログインユーザー情報取得
$user = get_login_user($db);
$user_id = $user['user_id'];
//var_dump($user);
//トークン生成1z
$token = get_csrf_token();
$search_name = get_post('search');
$items = get_user_items($db, $user_id);

include_once VIEW_PATH . 'item_listing_table_view.php';
