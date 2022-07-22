<?php

function dd($var)
{
    var_dump($var);
    exit();
}

function redirect_to($url)
{
    header('Location: ' . $url);
    exit();
}

function get_get($name)
{
    if (isset($_GET[$name]) === true) {
        return $_GET[$name];
    }
    return '';
}

// function get_get($mail){
//   if(isset($_GET[$mail]) === true){
//     return $_GET[$mail];
//   };
//   return '';
// }

function get_post($name)
{
    if (isset($_POST[$name]) === true) {
        return $_POST[$name];
    }
    return '';
}

// function get_post($mail){
//   if(isset($_POST[$mail]) === true){
//     return $_POST[$mail];
//   };
//   return '';
// }

function get_file($name)
{
    if (isset($_FILES[$name]) === true) {
        return $_FILES[$name];
    }
    return [];
}

function get_session($name)
{
    if (isset($_SESSION[$name]) === true) {
        return $_SESSION[$name];
    }
    return '';
}

// function get_session($mail){
//   if(isset($_SESSION[$mail]) === true){
//     return $_SESSION[$mail];
//   };
//   return '';
// }

function set_session($mail, $value)
{
    $_SESSION[$mail] = $value;
}

// function set_session($mail, $value){
//   $_SESSION[$mail] = $value;
// }

function set_session_user_info($mail, $user_name, $value_mail, $value_uname)
{
    //dd($mail+ $user_name+ $value_mail+ $value_uname);
    $_SESSION[$mail] = $value_mail;
    $_SESSION[$user_name] = $value_uname;
}

function set_session_signup($real_name, $user_name, $mail, $password, $question_code, $question_answer, $address, $payment, $introduction, $value_real_name, $value_user_name, $value_mail, $value_password, $value_question_code, $value_question_answer, $value_address, $value_payment, $value_introduction)
{
    $_SESSION[$real_name] = $value_real_name;
    $_SESSION[$user_name] = $value_user_name;
    $_SESSION[$mail] = $value_mail;
    $_SESSION[$password] = $value_password;
    $_SESSION[$question_code] = $value_question_code;
    $_SESSION[$question_answer] = $value_question_answer;
    $_SESSION[$address] = $value_address;
    $SESSION[$payment] = $value_payment;
    $_SESSION[$introduction] = $value_introduction;
}

function set_error($error)
{
    $_SESSION['__errors'][] = $error;
}

function get_errors()
{
    $errors = get_session('__errors');
    if ($errors === '') {
        return [];
    }
    set_session('__errors', []);
    return $errors;
}

function has_error()
{
    return isset($_SESSION['__errors']) && count($_SESSION['__errors']) !== 0;
}

function set_message($message)
{
    $_SESSION['__messages'][] = $message;
}

function get_messages()
{
    $messages = get_session('__messages');
    if ($messages === '') {
        return [];
    }
    set_session('__messages', []);
    return $messages;
}

//比較演算子　!==

function is_logined()
{
    return get_session('mail_address') !== '';
}

function get_upload_filename($file)
{
    if (is_valid_upload_image($file) === false) {
        return '';
    }
    $mimetype = exif_imagetype($file['tmp_name']);
    $ext = PERMITTED_IMAGE_TYPES[$mimetype];
    return get_random_string() . '.' . $ext;
}

//var_dump($mimetype);

function get_random_string($length = 20)
{
    return substr(base_convert(hash('sha256', uniqid()), 16, 36), 0, $length);
}

function save_image($image, $filename)
{
    return move_uploaded_file($image['tmp_name'], IMAGE_DIR . $filename);
}

function delete_image($filename)
{
    if (file_exists(IMAGE_DIR . $filename) === true) {
        unlink(IMAGE_DIR . $filename);
        return true;
    }
    return false;
}

function is_valid_length(
    $string,
    $minimum_length,
    $maximum_length = PHP_INT_MAX
) {
    $length = mb_strlen($string);
    return $minimum_length <= $length && $length <= $maximum_length;
}

function is_alphanumeric($string)
{
    return is_valid_format($string, REGEXP_ALPHANUMERIC);
}

function is_valid_format($string, $format)
{
    return preg_match($format, $string) === 1;
}

function is_valid_upload_image($image)
{
    if (is_uploaded_file($image['tmp_name']) === false) {
        set_error('ファイル形式が不正です。');
        return false;
    }
    $mimetype = exif_imagetype($image['tmp_name']);
    // if (isset(PERMITTED_IMAGE_TYPES[$mimetype]) === false) {
    //     set_error(
    //         'ファイル形式は' .
    //             implode('、', PERMITTED_IMAGE_TYPES) .
    //             'のみ利用可能です。'
    //     );
    //     return false;
    // }
    return true;
}

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// トークンの生成
function get_csrf_token()
{
    // get_random_string()はユーザー定義関数。
    $token = get_random_string(30);
    // set_session()はユーザー定義関数。
    set_session('csrf_token', $token);
    return $token;
}

// トークンのチェック
function is_valid_csrf_token($token)
{
    if ($token === '') {
        return false;
    }
    // get_session()はユーザー定義関数
    return $token === get_session('csrf_token');
}
