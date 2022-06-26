<?php
//constファイルを読み込む
require_once '../conf/const.php';
//modelを読み込む
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'db.php';

session_start();

$db = get_db_connect();
$mail = get_post('mail_address');
$question = get_post('question_code');
$question_content = get_post('question_content');
$answer = get_post('question_answer');
$password = $user['password'];
$result = conrirm_question($db, $mail, $question, $answer);
$title = 'メールアドレス確認';
$content = $result['password'];
$headers = 'From: from@example.com';

if ($result === false) {
    set_error('入力内容が違います。');
    redirect_to(PASSWORD_URL);
} else {
    // mb_send_mail($mail, $title, $content);
    mb_send_mail($mail, $title, $content, $headers);
    set_message('メールを送信しました。');
    redirect_to(LOGIN_URL);
}
