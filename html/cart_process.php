<?php
//constファイルを読み込む
require_once '../conf/const.php';
//modelを読み込む
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'carts.php';

session_start();

//ログイン済みであればホーム画面へ移動
if (is_logined() === true) {
    redirect_to(HOME_URL);
}

//POSTで送信されたトークンがセッションにセットされている値を異なる場合はログインページへリダイレクト
if (is_valid_csrf_token($_POST['csrf_token']) === false) {
    redirect_to(LOGIN_URL);
}

$item_id = get_post('item_id');
$user_id = get_post('user_id');
$db = get_db_connect();
var_dump($user_id);

// カートに追加
if (insert_cart($db, $user_id, $item_id)) {
    set_message('カートに商品を追加しました。');
    redirect_to('CART_URL');
} else {
    set_error('カートの更新に失敗しました。');
}

redirect_to(HOME_URL);
