<?php
//constファイルを読み込む
require_once '../conf/const.php';
//modelを読み込む
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';

session_start();

//ログインしていなければログイン画面へ移動
if(is_logined() === false){
  redirect_to(LOGIN_URL);
}

//POSTで送信されたトークンがセッションにセットされている値を異なる場合はログインページへリダイレクト
if(is_valid_csrf_token($_POST['csrf_token']) === FALSE){
  redirect_to(LOGIN_URL);
}

//データーベースへ接続
$db = get_db_connect();
//ログインユーザー情報取得
$user = get_login_user($db);

//商品追加処理
//$user_id = $_SESSION['user_id'];
$user_id = $user['user_id'];
$image = get_file('item_image');
$name = get_post('item_name');
$address = get_post('item_address');
$category = get_post('category_code');
$payment = get_post('payment_designated_code');
$price = get_post('item_price');
$status = get_post('status_code');
$trade_item_name = get_post('trade_item_name');
$shipping = get_post('shipping_code');
$introduct = get_post('item_introduction');

//var_dump($category);
//アイテムを出品
if(regist_item($db, $image, $name, $address, $category, $payment, $price, $status, $trade_item_name, $shipping, $introduct, $user['user_id'])){
  set_message('アイテムを登録しました。');
}else {
  set_error('アイテムの登録に失敗しました。');
}
//var_dump($shipping);

redirect_to(LISTING_URL);
