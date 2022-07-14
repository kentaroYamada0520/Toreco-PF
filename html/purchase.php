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

$db = get_db_connect();
$user = get_login_user($db);
$token = get_csrf_token();
$items = get_user_cart($db, $sql, $user['user_id']);
$user_id = $user['user_id'];
$pay = get_payment($db, $user_id);
// var_dump($items);

//購入確認画面から戻るときの値保存
$real_name = get_post('real_name');
$mail_address = get_post('mail_address');   
$address = get_post('address');
$cc_name = get_post('cc_name');
$cc_number = get_post('cc_number');
$cc_expiration = get_post('cc_expiration');
$cc_cvv = get_post('cc_cvv');
$flag = get_post('flag');

$total = 0;
$max = count($items);

foreach ($items as $item) {
    $pro_price[] = $item['item_price'];
    $pro_name[] = $item['item_name'];
    $pro_category[] = $item['category_name'];
}

include_once VIEW_PATH . 'purchase_view.php';
