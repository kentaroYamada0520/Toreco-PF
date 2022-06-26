<?php
//constファイルを読み込む
require_once '../conf/const.php';
//modelを読み込む
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'db.php';

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
$questions = select_question($db);
$user_id = $user['user_id'];
$pay = get_payment($db, $user_id);

include_once VIEW_PATH . 'user_edit_view.php';
