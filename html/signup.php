<?php
//constファイルを読み込む
require_once '../conf/const.php';
//modelを読み込む
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'db.php';

session_start();


//ログイン済みであればホーム画面へ移動
if(is_logined() === true){
  redirect_to(HOME_URL);
}
//トークン生成
$token = get_csrf_token();
$db = get_db_connect();
$questions = select_question($db);

include_once VIEW_PATH . 'signup_view.php';




