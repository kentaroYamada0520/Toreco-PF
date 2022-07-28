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

//POSTで送信されたトークンがセッションにセットされている値を異なる場合はログインページへリダイレクト
if (is_valid_csrf_token($_POST['csrf_token']) === false) {
    redirect_to(LOGIN_URL);
}

//ユーザー登録処理
$real_name = get_post('real_name');
$user_name = get_post('user_name');
$mail_address = get_post('mail_address');
$password = get_post('password');
$password_confirmation = get_post('password_confirmation');
$question_code = get_post('question_code');
$question_answer = get_post('question_answer');
$address = get_post('address');
$payment = get_post('payment_code');
$introduction = get_post('introduction');
$db = get_db_connect();
$token = get_csrf_token();

$payment_content = get_select_payment($db, $payment);
$question_content = get_select_question($db, $question_code);

// var_dump($payment);

// var_dump($mail_address);

set_session_signup('real_name', 'user_name', 'mail', 'password', 'question_code', 'question_answer', 'address', 'payment_code', 'introduction', $real_name, $user_name, $mail_address, $password, $question_code, $question_answer, $address, $payment, $introduction);

// $a = get_session('mail');
// var_dump($mail);
try {
    //ユーザー登録の条件にマッチしている確認
    $result = is_valid_user(
        $db,
        $user_name,
        $mail_address,
        $password,
        $password_confirmation,
        $question_code,
        $question_answer,
        $address,
        $payment
    );
    if ($result === false) {
        set_error('入力内容が正しくありません。1');
        redirect_to(SIGNUP_URL);
    }
    //falseなら処理がここで終了

} catch (PDOException $e) {
    set_error('入力内容が正しくありません。');
    redirect_to(SIGNUP_URL);
}


include_once VIEW_PATH . 'signup_confirm_view.php';
