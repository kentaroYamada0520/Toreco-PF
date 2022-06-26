<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'carts.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'db.php';
require_once MODEL_PATH . 'functions.php';

session_start();

//ログイン済みであればホーム画面へ移動
if (is_logined() === false) {
    redirect_to(LOGIN_URL);
}

//POSTで送信されたトークンがセッションにセットされている値を異なる場合はログインページへリダイレクト
if (is_valid_csrf_token($_POST['csrf_token']) === false) {
    redirect_to(LOGIN_URL);
}

//データーベースへ接続
$db = get_db_connect();
//ログインユーザー情報取得
// $user = get_login_user($db);
// $user_id = $user['user_id'];
// $item_id = get_post('item_id');
// $cart = get_cart($db, $user_id, $item_id);
// $cart_id = $cart['cart_id'];
$cart_id = get_post('cart_id');

if (delete_cart($db, $sql, $cart_id)) {
    set_message('アイテムを削除しました。');
} else {
    set_error('アイテムの削除に失敗しました。');
}

redirect_to(CART_URL);
