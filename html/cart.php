<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'carts.php';
require_once MODEL_PATH . 'db.php';

session_start();

//ログイン済みであればホーム画面へ移動
if (is_logined() === false) {
    redirect_to(LOGIN_URL);
}

$db = get_db_connect();
$user_id = $_SESSION['1'];
$items = get_user_cart($db, $user_id);
var_dump($items);
//トークン生成
$token = get_csrf_token();
include_once VIEW_PATH . 'cart_view.php';
