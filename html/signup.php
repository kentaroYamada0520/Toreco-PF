<?php
//constファイルを読み込む
require_once '../conf/const.php';
//modelを読み込む
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'db.php';

session_start();


//ログイン済みであればホーム画面へ移動
if (is_logined() === true) {
  redirect_to(HOME_URL);
}
//トークン生成
$token = get_csrf_token();
$db = get_db_connect();
$questions = select_question($db);
// $pro_questions[] = $questions['question_code'];
$payments = select_payment($db);

// $real_name = get_post('real_name');
// $user_name = get_post('user_name');
// $mail_address = get_post('mail_address');
// $password = get_post('password');
// $password_confirmation = get_post('password_confirmation');
// $question_code = get_post('question_code');
// $question_answer = get_post('question_answer');
// $address = get_post('address');
// $payment = get_post('payment_code');
// $introduction = get_post('introduction');


$real_name = get_session('real_name');
$user_name = get_session('user_name');
$mail_address = get_session('mail');
$password = get_session('password');
$question_code = get_session('question_code');
$question_answer = get_session('question_answer');
$address = get_session('address');
$payment = get_session('payment_code');
$introduction = get_session('introduction');


var_dump($payment);

// var_dump($questions);

include_once VIEW_PATH . 'signup_view.php';
