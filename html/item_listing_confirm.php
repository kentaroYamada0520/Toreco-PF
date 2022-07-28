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

$user = get_login_user($db);
$user_id = $user['user_id'];
$image = get_file('item_image');
$name = get_post('item_name');
// $address = get_post('item_address');
$category = get_post('category_code');
// $payment = get_post('payment_designated_code');
$prices = get_post('item_price');
$price = (int)$prices;
$status = get_post('status_code');
$trade_item_name = get_post('trade_item_name');
$shipping = get_post('shipping_code');
$introduct = get_post('item_introduction');

$category_names = get_category_name($db, $category);
$category_name = $category_names['category_name'];
$status_names = get_status_name($db, $status);
$status_name = $status_names['status_name'];
// var_dump($name);
// var_dump($price);
var_dump($category_name);
var_dump($status_name);

var_dump($image);


set_session_item('item_image', 'item_name', 'category_code', 'item_price', 'status_code', 'trade_item_name', 'shipping_code', 'item_introduction',  $image, $name, $category, $price, $status, $trade_item_name, $shipping, $introduct);

include_once VIEW_PATH . 'item_listing_confirm_view.php';
