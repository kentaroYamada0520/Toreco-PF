<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';

session_start();

if (is_logined() === false) {
    redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user = get_login_user($db);
$user_id = $user['user_id'];
$my_purchase_ids = get_purchase_id($db, $sql, $user_id);
$items = get_purchase_history($db, $sql, $user_id);
// $items = get_purchase_history($db, $sql, $user_id, $time);
$token = get_csrf_token();


// var_dump($db);
// var_dump($items);
// var_dump($user_id);
// var_dump($items);
// var_dump($times);
var_dump($user_id);

include_once VIEW_PATH . 'purchase_history_view.php';
