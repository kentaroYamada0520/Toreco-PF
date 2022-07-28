<?php
//constファイルを読み込む
require_once '../conf/const.php';
//modelを読み込む
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'db.php';

session_start();

//ログインしていなければログイン画面へ移動
if (is_logined() === false) {
    redirect_to(LOGIN_URL);
}
//データーベースへ接続
$db = get_db_connect();

//ログインユーザー情報取得
$user = get_login_user($db);
//トークン生成
$token = get_csrf_token();

$categories = select_item_category($db);
$shippings = select_shipping($db);
$statuses = select_status($db);


$user_id = $user['user_id'];
$image = get_session('item_image');
$name = get_session('item_name');
$address = get_session('item_address');
$item_category = get_session('category_code');
// $payment = get_post('payment_designated_code');
$price = get_session('item_price');
$item_status = get_session('status_code');
$trade_item_name = get_session('trade_item_name');
$item_shipping = get_session('shipping_code');
$introduct = get_session('item_introduction');
var_dump($image);

// var_dump($statuses);
//var_dump($categories);
include_once VIEW_PATH . 'item_listing_view.php';
