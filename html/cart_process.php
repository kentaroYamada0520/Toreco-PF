<?php
//constファイルを読み込む
require_once '../conf/const.php';
//modelを読み込む
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'carts.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'db.php';

session_start();

//ログイン済みであればホーム画面へ移動
if (is_logined() === false) {
    redirect_to(LOGIN_URL);
}

//POSTで送信されたトークンがセッションにセットされている値を異なる場合はログインページへリダイレクト
if (is_valid_csrf_token($_POST['csrf_token']) === false) {
    redirect_to(LOGIN_URL);
}

//データベースへ接続
$db = get_db_connect();
//ログインユーザー情報取得
$user = get_login_user($db);

$user_id = $user['user_id'];
$item_id = get_post('item_id');
$items = get_user_cart($db, $sql, $user['user_id']);
$max = count($items);
// $user_id = $user['user_id'];
// var_dump($user_id);

// カートに追加
// if (insert_cart($db, $item_id, $user_id)) {
//     set_message('カートに商品を追加しました。');
// } else {
//     set_error('カートの更新に失敗しました。');
// }

if ($max === 5) {
    set_error('カートがいっぱいです。');
    redirect_to(CART_URL);
}

if (add_cart($db, $user_id, $item_id, $cart)) {
    set_message('カートに追加しました。');
} else {
    set_error('このアイテムは既に追加されています。');
}

redirect_to(CART_URL);
