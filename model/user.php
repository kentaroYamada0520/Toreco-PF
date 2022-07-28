<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

function get_user($db, $login_mail_address)
{
    $sql = "
     SELECT
      user_id,
      mail_address,
      real_name,
      user_name,
      password,
      question_answer,
      address,
      user_introduction,
      user.question_code,
      user.payment_code AS user_pay,
      secret_question.question_code,
      payment.payment_code,
      secret_question.question_content,
      payment.payment
    FROM
      user
    JOIN
      secret_question 
    ON
      user.question_code = secret_question.question_code
    JOIN
      payment
    ON
      user.payment_code = payment.payment_code
    WHERE
      mail_address = ?
    ";

    return fetch_query($db, $sql, [$login_mail_address]);
}

function get_login_user($db)
{
    $login_mail_address = get_session('mail_address');
    return get_user($db, $login_mail_address);
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

function select_payment($db)
{
    $sql = "
     SELECT *
     FROM
      payment
    ";
    return fetch_all_query($db, $sql);
}

function get_select_payment($db, $payment)
{
    $sql = "
     SELECT
      payment
     FROM
      payment
     WHERE
      payment_code = ?
    ";
    return fetch_query($db, $sql, [$payment]);
}

function get_select_question($db, $question_code)
{
    $sql = "
     SELECT*
     FROM
      secret_question
     WHERE
      question_code = ?
    ";
    return fetch_query($db, $sql, [$question_code]);
}

function conrirm_question($db, $mail, $question, $answer)
{
    $sql = "
      SELECT
       password
      FROM
       user
      WHERE
       mail_address = ?
      AND
       question_code = ?
      AND
       question_answer = ?    
    ";
    return fetch_query($db, $sql, [$mail, $question, $answer]);
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
    $mail_address,
    $password,
    $password_confirmation,
    $question,
    $question_answer,
    $address,
    $payment,
    $introduction
) {
    if (
        is_valid_user(
            $db,
            $user_name,
            $mail_address,
            $password,
            $password_confirmation,
            $question,
            $question_answer,
            $address,
            $payment
        ) === false
    ) {
        return false;
    } else {
        //falseなら処理がここで終了
        //falseでなければ下の処理で入力値が登録される処理に進む
        return insert_user(
            $db,
            $real_name,
            $user_name,
            $mail_address,
            $password,
            $question,
            $question_answer,
            $address,
            $payment,
            $introduction
        );
    }
}

// function is_admin($user)
// {
//     return $user['type'] === USER_TYPE_ADMIN;
// }

function is_valid_user(
    $db,
    $user_name,
    $mail_address,
    $password,
    $password_confirmation,
    $question_code,
    $question_answer,
    $address,
    $payment
) {
    // 短絡評価を避けるため一旦代入。
    $is_valid_user_name = is_valid_user_name($user_name);
    $is_valid_mail_address = is_valid_mail_address($db, $mail_address);
    $is_valid_password = is_valid_password($password, $password_confirmation);
    $is_valid_question_code = is_valid_question($question_code);
    $is_valid_question_answer = is_valid_question_answers($question_answer);
    $is_valid_address = is_valid_addresss($address);
    $is_valid_payment = is_valid_payment($payment);
    return $is_valid_user_name && $is_valid_mail_address && $is_valid_password && $is_valid_question_code && $is_valid_question_answer && $is_valid_address && $is_valid_payment;
}

function is_valid_user_name($user_name)
{
    // $is_valid = true;
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
        return false;
        //$is_validにfalseが入って、is_valid_user_idがfalseになる
        // $is_valid = false;
    }
    return true;
}

function get_mail_address($db, $mail_address)
{
    $sql = "
     SELECT
      mail_address
     FROM
      user
     WHERE
      mail_address = ?
    ";
    return fetch_query($db, $sql, [$mail_address]);
}

// function is_valid_mail_address($db, $sql, $mail)
// {
//     $result = valid_mail_address($mail);
//     $result2 = get_mail_address($db, $sql, $mail);
//     if ($result === false || $result2 === false) {
//         return false;
//     } else {
//         return true;
//     }
// }

function is_valid_mail_address($db,  $mail_address)
{
    $is_valid = true;
    //var_dump($mail);
    // $pattern =
    //     "/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)*$/";
    $result = get_mail_address($db, $mail_address);
    $pattern =
        "|^[a-zA-Z0-9.!#$%&'*+=/?^_`{}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)*$|";
    if (empty($mail_address)) {
        set_error('メールアドレスを入力してください。');
    } else {
        if ($result !== false) {
            set_error('このメールアドレスは既に使用されています。');
            return false;
        }
        if (preg_match($pattern, $mail_address)) {
            $is_valid = true;
        } else {
            set_message('不正な形式のメールアドレスです。');
            $is_valid = false;
        }
    }

    return $is_valid;
}

//is_valid_mail_address($mail)にtrueかfalseを返したい
// function valid_mail_address($mail)
// {
//     $is_valid = true;
//     $mail = $_POST['mail_address'];
//     //var_dump($mail);
//     // $pattern =
//     //     "/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)*$/";
//     $pattern =
//         "|^[a-zA-Z0-9.!#$%&'*+=/?^_`{}~-]+@[a-zA-Z0-9-]+(?:.[a-zA-Z0-9-]+)*$|";
//     if (preg_match($pattern, $mail)) {
//         $is_valid = true;
//     } else {
//         echo '不正な形式のメールアドレスです。';
//         $is_valid = false;
//     }
//     return $is_valid;
// }

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

function is_valid_question($question_code)
{
    $is_valid = true;
    if (is_null($question_code)) {
        set_error('秘密の質問を選択してください');
        $is_valid = false;
    }
    return $is_valid;
}

function is_valid_question_answers($question_answer)
{
    $is_valid = true;
    if (empty($question_answer)) {
        set_error('秘密の質問の答えを入力してください');
        $is_valid = false;
    }
    return $is_valid;
}

function is_valid_addresss($address)
{
    $is_valid = true;
    if (empty($address)) {
        set_error('住所を入力してください。');
        $is_valid = false;
    }
    return $is_valid;
}

function is_valid_payment($payment)
{
    $is_valid = true;
    if ($payment === "") {
        set_error('支払方法を選択してください。');
        $is_valid = false;
    }
    return $is_valid;
}

// function redirect_to_signup()

function insert_user(
    $db,
    $real_name,
    $user_name,
    $mail_address,
    $password,
    $question,
    $question_answer,
    $address,
    $payment,
    $introduction
) {
    $sql = "
    INSERT INTO
      user(real_name,user_name,mail_address, password,question_code,question_answer,address,payment_code,user_introduction)
    VALUES (?, ?, ?, ?, ?, ?, ?,?, ?);
  ";

    return execute_query($db, $sql, [
        $real_name,
        $user_name,
        $mail_address,
        $password,
        $question,
        $question_answer,
        $address,
        $payment,
        $introduction
    ]);
}


function get_user_info($db, $user_id)
{
    $sql = "
     SELECT
      user.real_name,
      user.user_name,
      user.mail_address,
      user.password,
      secret_question.question_content,
      user.question_answer,
      user.address,
      user.payment,
      user.user_introduction
     FROM
      user
     JOIN
        secret_question
     ON
      user.question_code = secret_question.question_code
    WHERE
      user_id = ?
    ";
    return fetch_query($db, $sql, [$user_id]);
}

function get_payment($db, $user_id)
{
    $sql = "
    SELECT
      payment_code
    FROM
      user
    WHERE
      user_id = ?
    AND
      payment_code = 0
    ";
    return fetch_query($db, $sql, [$user_id]);
}

function edit_user(
    $db,
    $real_name,
    $user_name,
    $question_code,
    $question_answer,
    $address,
    $payment,
    $user_introduction,
    $user_id
) {
    $sql = "
        UPDATE
          user
        SET
          real_name = ?,
          user_name = ?,
          question_code = ?,
          question_answer = ?,
          address = ?,
          payment_code = ?,
          user_introduction = ?
        WHERE
          user_id = ?
        ";
    return execute_query($db, $sql, [
        $real_name,
        $user_name,
        $question_code,
        $question_answer,
        $address,
        $payment,
        $user_introduction,
        $user_id,
    ]);
}

function edit_check(
    $real_name,
    $user_name,
    $password,
    $question_code,
    $question_answer,
    $address,
    $payment
) {
    $check_real_name = check_real_name($real_name);
    $check_user_name = check_user_name($user_name);
    $check_password = check_password($password);
    $check_question_code = check_question_code($question_code);
    $check_question_answer = check_question_answer($question_answer);
    $check_address = check_address($address);
    $check_payment = check_payment($payment);

    if (
        $check_real_name === true &&
        $check_user_name === true &&
        $check_password === true &&
        $check_question_code === true &&
        $check_question_answer === true &&
        $check_address === true &&
        $check_payment === true
    ) {
        return true;
    } else {
        return false;
    }
}

function check_real_name($real_name)
{
    if ($real_name == !'') {
        return true;
    } else {
        return false;
    }
}

function check_user_name($user_name)
{
    if ($user_name == !'') {
        return true;
    } else {
        return false;
    }
}

function check_password($password)
{
    if ($password == !'') {
        return true;
    } else {
        return false;
    }
}

function check_question_code($question_code)
{
    if ($question_code == !'') {
        return true;
    } else {
        return false;
    }
}

function check_question_answer($question_answer)
{
    if ($question_answer == !'') {
        return true;
    } else {
        return false;
    }
}

function check_address($address)
{
    if ($address == !'') {
        return true;
    } else {
        return false;
    }
}

function check_payment($payment)
{
    if ($payment == !'') {
        return true;
    } else {
        return false;
    }
}

function update_user(
    $db,
    $real_name,
    $user_name,
    $question_code,
    $question_answer,
    $address,
    $payment,
    $user_introduction,
    $user_id
) {
    if (
        is_valid_update_user(
            $real_name,
            $user_name,
            $question_answer,
            $address
        ) === false
    ) {
        return false;
    }
    //falseなら処理がここで終了
    //falseでなければ下の処理で入力値が登録される処理に進む
    return edit_user(
        $db,
        $real_name,
        $user_name,
        $question_code,
        $question_answer,
        $address,
        $payment,
        $user_introduction,
        $user_id
    );
}

function is_valid_update_user(
    $real_name,
    $user_name,
    $question_answer,
    $address
) {
    // 短絡評価を避けるため一旦代入。
    $is_valid_real_name = is_valid_real_name($real_name);
    $is_valid_user_name = is_valid_user_names($user_name);
    $is_valid_question_answer = is_valid_question_answer($question_answer);
    $is_valid_address = is_valid_address($address);

    // return $is_valid_real_name &&
    //     $is_valid_address &&
    //     $is_valid_question_answer &&
    //     $is_valid_user_name &&
    //     $is_valid_password;
    if (
        $is_valid_real_name === true &&
        $is_valid_user_name === true &&
        $is_valid_question_answer === true &&
        $is_valid_address === true
    ) {
        return true;
    }
    return false;
}

function password_change(
    $password_now,
    $user,
    $password,
    $password_confirmation
) {
    if ($password_now === '') {
        $password = $user['password'];
        return true;
    } else {
        if ($password_now === $user['password']) {
            return is_valid_password($password, $password_confirmation);
        }
        set_error('パスワードが一致しません。');
        return false;
    }
}

function edit_password($db, $password_new, $user_id)
{
    $sql = "
     UPDATE
      user
     SET
      password = ?
     WHERE
      user_id = ?
    ";
    return execute_query($db, $sql, array($password_new, $user_id));
}

function is_valid_real_name($real_name)
{
    if ($real_name === '') {
        return false;
    }
    return true;
}

function is_valid_user_names($user_name)
{
    if ($user_name === '') {
        return false;
    }
    return true;
}

function is_valid_address($address)
{
    if ($address === '') {
        return false;
    }
    return true;
}

function is_valid_question_answer($question_answer)
{
    if ($question_answer === '') {
        return false;
    }
    return true;
}
