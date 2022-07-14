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
$items = get_user_cart1($db, $sql, $user['user_id']);
$user_id = $user['user_id'];
$pay = get_payment($db, $user_id);
$items = get_item_id($db, $sql, $user_id);
// $item_id = get_item_id($db, $sql, $user_id);
// $item_id = $items['item_id'];
$sum_price = get_post('sum_price');
$purchase_id = get_my_purchase_id($db, $sql, $user_id);
$my_purchase_id = $purchase_id['my_purchase_id'] + 1;

// var_dump($item_id);
// var_dump($user_id);
// $array = [1, 2, 3, 4, 5];
// var_dump($array[2]);
// var_dump($items);
// $count = count($item);
// var_dump($user_id);
var_dump($my_purchase_id);


try {
    $result = insert_purchase_history($db, $sql, $user_id, $items, $my_purchase_id);
    // $result = purchase_history($db, $sql, $user_id, $item_id);
    $result2 = add_flag($db, $sql, $items);
    // var_dump($item_id);
    // $result2 = purchase_history($db, $sql, $user_id, $item_id);
    $result3 = purchase_cart($db, $sql, $user_id);
    // $result3 = purchase_history($db, $sql, $user_id, $item_id);
    // $result3 = purchase_history($db, $sql, $user_id, $item_id);

    if ($result === false || $result2 === false || $result3 === false) {
        set_error('購入に失敗しました。');
        redirect_to(PURCHASE_URL);
    }
} catch (PDOException $e) {
    set_error('購入に失敗しました1');
    redirect_to(PURCHASE_URL);
}

$total = 0;
$max = count($items);
// var_dump($count);


foreach ($items as $item) {
    $pro_price[] = $item['item_price'];
    $pro_shipping[] = $item['shipping_code'];
    $pro_item_name[] = $item['item_name'];
    $pro_user_name[] = $item['user_name'];
    $pro_mail[] = $item['mail_address'];
}
include_once VIEW_PATH . 'purchase_confirm_view.php';
