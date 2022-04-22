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
//var_dump($user);
//トークン生成1z
$token = get_csrf_token();
$search_name = get_post('search');
//var_dump($search_name);
if (get_post('search')) {
    //検索アイテム情報を取得
    $items = get_search_items($db, $search_name, $search_name);
} else {
    //全アイテム情報を取得
    $items = get_items($db);
}

//var_dump($items);

include_once VIEW_PATH . 'index_view.php';
