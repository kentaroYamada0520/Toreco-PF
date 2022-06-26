<?php
//constファイルを読み込む
require_once '../conf/const.php';
//modelを読み込む
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'db.php';

session_start();

$db = get_db_connect();
$real_name = GET_POST('real_name');
$user_name = GET_POST('user_name');
$question_code = GET_POST('question_code');
$question_answer = GET_POST('question_answer');
$address = GET_POST('address');
$payment = GET_POST('payment_code');
$user_introduction = GET_POST('user_introduction');
$password_now = GET_POST('password_now');
$password = GET_POST('password');
$password_confirmation = GET_POST('password_confirmation');
$user = get_login_user($db);
//下の箇所書き直し
$user_id = $user['user_id'];
// $check = edit_check(
//     $real_name,
//     $user_name,
//     $password,
//     $question_code,
//     $question_answer,
//     $address,
//     $payment
// );

try {
    $result = update_user(
        $db,
        $real_name,
        $user_name,
        $password_now,
        $password,
        $password_confirmation,
        $question_code,
        $question_answer,
        $address,
        $payment,
        $user_introduction,
        $user_id,
        $user
    );
    if ($result === false) {
        set_error('ユーザー登録に失敗しました。');
        redirect_to(USER_EDIT_URL);
    }
} catch (PDOException $e) {
    set_error('ユーザー登録に失敗しました。');
    redirect_to(USER_EDIT_URL);
}

set_message('ユーザー情報を更新しました。');
// if ($check === false) {
//     set_error('必須事項を入力してください。');
//     redirect_to(USER_EDIT_URL);
// }

// if (
//     edit_user(
//         $db,
//         $real_name,
//         $user_name,
//         $password,
//         $question_code,
//         $question_answer,
//         $address,
//         $payment,
//         $user_introduction,
//         $user_id
//     )
// ) {
//     set_message('ユーザー情報を更新しました。');
// } else {
//     set_error('更新に失敗しました。');
// }

// $user = get_login_user($db);
// $questions = select_question($db);
redirect_to(MYPAGE_URL);
