<?php
require_once '../conf/const.php';
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

session_start();

if (is_logined() === true) {
    redirect_to(HOME_URL);
}


$token = get_csrf_token();
$item_id = get_post('item_id');

$result = delete_item($db, $item_id);

if ($result === false) {
    set_error('削除に失敗しました。');
} else {
    set_message('アイテムを削除しました。');
    redirect_to(LISTING_TABLE_URL);
}
