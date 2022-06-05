<?php
//constファイルを読み込む
require_once '../conf/const.php';
//modelを読み込む
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';

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
$mail = get_post('mail_address');
$password = get_post('password');
$password_confirmation = get_post('password_confirmation');
$question_content = get_post('question_code');
$answer = get_post('question_answer');
$address = get_post('address');
$payment = get_post('payment');
$db = get_db_connect();

try {
    //ユーザー登録の条件にマッチしている確認
    $result = regist_user(
        $db,
        $real_name,
        $user_name,
        $mail_address,
        $password,
        $password_confirmation,
        $question_code,
        $question_answer,
        $address,
        $payment,
        $user_introduction
    );
    if ($result === false || $result2 === false) {
        set_error('ユーザー登録に失敗しました。');
        redirect_to(SIGNUP_URL);
        //falseなら処理がここで終了
    }
} catch (PDOException $e) {
    set_error('ユーザー登録に失敗しました。');
    redirect_to(SIGNUP_URL);
}
//falseでなかったら下の処理が行われる
set_message('ユーザー登録が完了しました。');

login_as($db, $mail_address, $password);

redirect_to(HOME_URL);
