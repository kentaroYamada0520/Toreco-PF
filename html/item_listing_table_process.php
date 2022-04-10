<?php
//constファイルを読み込む
require_once '../conf/const.php';
//modelを読み込む
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'item.php';
require_once MODEL_PATH . 'trade_request.php';

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

$item_code = $_POST["item_code"];
$request_item_code = $_POST["item_code"];

//アイテム一覧で削除を押した際の処理
if(destroy_item($db, $item_code) === true){
  delete_trade_request($db, $item_code, $request_item_code);
  set_message('アイテムを削除しました。');
}else {
  set_error('商品の削除に失敗しました。');
}

redirect_to(LISTING_TABLE_URL);
