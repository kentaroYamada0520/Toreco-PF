<?php
//constファイルを読み込む
require_once '../conf/const.php';
//modelを読み込む
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'carts.php';

session_start();

if (is_logined() === false) {
    redirect_to(LOGIN_URL);
}

// if (is_valid_csrf_token($_GET['csrf_token']) === false) {
//     redirect_to(LOGIN_URL);
// }

$db = get_db_connect();
$user = get_login_user($db);
$token = get_csrf_token();
$user_id = $user['user_id'];
// $items = get_purchase_history($db, $user_id);
$amount = 10;
$result = intval('10', 16);
var_dump($result);

// var_dump($items);
// var_dump($user);

// var_dump($user);
// var_dump($user);

include_once VIEW_PATH . 'mypage_view.php';
