<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'carts.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'user.php';

session_start();

if (is_logined() === false) {
    redirect_to(LOGIN_URL);
}

//データーベースへ接続
$db = get_db_connect();
//ログインユーザー情報取得
$user = get_login_user($db);
// var_dump($user);
//トークン生成
$token = get_csrf_token();

//特定のユーザIDを持つカートからアイテム情報を拾ってくる
$items = get_user_cart($db, $sql, $user['user_id']);
// var_dump($items);
$total = 0;
$max = count($items);

foreach ($items as $item) {
    $pro_price[] = $item['item_price'];
    $pro_name[] = $item['item_name'];
}

include_once VIEW_PATH . 'cart_view.php';
