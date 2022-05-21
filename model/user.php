<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

function get_user($db, $login_mail_address)
{
    $sql = "
    SELECT
      usr_id,
      user_address,
      real_name,
      user_name,
      password,
      question_answer,
      address,
      user_introduction,
      payment_designated_code,
      secret_question.question_content
    FROM
      user
    RIGHT JOIN
      secret_question
    ON
      user.question_code = secret_question.question_code
    WHERE
      mail_address = ?
    LIMIT 1
  ";

    return fetch_query($db, $sql, [$login_mail_address]);
}

function get_user_by_mail($db, $mail)
{
    //var_dump($db);
    $sql = "
    SELECT 
      user_id,
      mail_address,
      password,
      user_name
    FROM
      user
    WHERE
      mail_address = ?
    LIMIT 1
  ";

    return fetch_query($db, $sql, [$mail]);
}

function select_question($db)
{
    $sql = "
    SELECT *
    FROM
     secret_question
  ";

    return fetch_all_query($db, $sql);
}

//このメソッドでtrueが帰ってきたらログインできる
function login_as($db, $mail, $password)
{
    //dbにアクセスしてユーザ情報をとってくる
    //$userの中に配列形式で情報をとってくる
    $user = get_user_by_mail($db, $mail);
    if ($user === false || $user['password'] !== $password || $mail === false) {
        return false;
    }
    set_session_user_info(
        'mail_address',
        'user_name',
        $user['mail_address'],
        $user['user_name']
    );
    return $user;
}

function get_login_user($db)
{
    $login_mail_address = get_session('mail_address');
    return get_user($db, $login_mail_address);
}

function valid_mail($mail)
{
    $flag = false;
    $pattern =
        "|^[a-zA-Z0-9.!#$%&'*+=/?^_`{}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)*$|";
    if (preg_match($pattern, $mail)) {
        $flag = true;
    }
    return $flag;
}

// function valid_mail($mail)
// {
//     if (is_valid_mail($mail) === false) {
//         return false;
//     }
// }

// function is_valid_mail($mail)
// {
//     $mail = $_POST['mail_address'];
//     //var_dump($mail);
//     $pattern =
//         "/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)*$/";
//     if (preg_match($pattern, $mail)) {
//         return true;
//     } else {
//         echo '不正な形式のメールアドレスです。';
//         return false;
//         var_dump($mail);
//     }
// }

function regist_user(
    $db,
    $real_name,
    $user_name,
    $mail,
    $password,
    $password_confirmation,
    $question_code,
    $question_answer,
    $address,
    $user_introduction
) {
    if (
        is_valid_user(
            $db,
            $real_name,
            $user_name,
            $mail,
            $password,
            $password_confirmation,
            $question_code,
            $question_answer,
            $address,
            $user_introduction
        ) === false
    ) {
        return false;
    }
    //falseなら処理がここで終了
    //falseでなければ下の処理で入力値が登録される処理に進む
    return insert_user(
        $db,
        $real_name,
        $mail,
        $password,
        $question_code,
        $question_answer,
        $address,
        $user_introduction
    );
}

function is_admin($user)
{
    return $user['type'] === USER_TYPE_ADMIN;
}

function is_valid_user(
    $real_name,
    $user_name,
    $mail,
    $password,
    $password_confirmation,
    $question_code,
    $question_answer,
    $address,
    $user_introduction
) {
    // 短絡評価を避けるため一旦代入。
    $is_valid_user_name = is_valid_user_name($user_name);
    $is_valid_mail_address = is_valid_mail_address($mail);
    $is_valid_password = is_valid_password($password, $password_confirmation);
    return $is_valid_user_name && $is_valid_mail_address && $is_valid_password;
}

function is_valid_user_name($user_name)
{
    $is_valid = true;
    if (
        is_valid_length(
            $user_name,
            USER_NAME_LENGTH_MIN,
            USER_NAME_LENGTH_MAX
        ) === false
    ) {
        set_error(
            'ユーザー名は' .
                USER_NAME_LENGTH_MIN .
                '文字以上、' .
                USER_NAME_LENGTH_MAX .
                '文字以内にしてください。'
        );
        //$is_validにfalseが入って、is_valid_user_idがfalseになる
        $is_valid = false;
    }
}

//is_valid_mail_address($mail)にtrueかfalseを返したい
function is_valid_mail_address($mail)
{
    $is_valid = true;
    $mail = $_POST['mail_address'];
    //var_dump($mail);
    // $pattern =
    //     "/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)*$/";
    $pattern =
        "|^[a-zA-Z0-9.!#$%&'*+=/?^_`{}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)*$|";
    if (preg_match($pattern, $mail)) {
        $is_valid = true;
    } else {
        echo '不正な形式のメールアドレスです。';
        $is_valid = false;
    }
    return $is_valid;
}

//入力規則確認のメソッド
function is_valid_password($password, $password_confirmation)
{
    $is_valid = true;
    if (
        is_valid_length(
            $password,
            USER_PASSWORD_LENGTH_MIN,
            USER_PASSWORD_LENGTH_MAX
        ) === false
    ) {
        set_error(
            'パスワードは' .
                USER_PASSWORD_LENGTH_MIN .
                '文字以上、' .
                USER_PASSWORD_LENGTH_MAX .
                '文字以内にしてください。'
        );
        $is_valid = false;
    }
    if (is_alphanumeric($password) === false) {
        set_error('パスワードは半角英数字で入力してください。');
        $is_valid = false;
    }
    if ($password !== $password_confirmation) {
        set_error('パスワードがパスワード(確認用)と一致しません。');
        $is_valid = false;
    }
    return $is_valid;
}

function insert_user(
    $db,
    $real_name,
    $user_name,
    $mail,
    $password,
    $question_code,
    $question_answer,
    $address,
    $user_introduction
) {
    $sql = "
    INSERT INTO
      user(real_name,user_name,mail_address, password,question_code,question_answer,address,user_introduction, created)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW());
  ";

    return execute_query($db, $sql, [
        $real_name,
        $user_name,
        $mail,
        $password,
        $question_code,
        $question_answer,
        $address,
        $user_introduction,
    ]);
}
