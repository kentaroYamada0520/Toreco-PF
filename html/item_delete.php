<?php
require_once MODEL_PATH . 'functions.php';
require_once '../conf/const.php';

session_start();

if (is_logined() === true) {
    redirect_to(HOME_URL);
}

$token = get_csrf_token();
$item_id = get_post('item_id');

include_once VIEW_PATH . 'item_delete_view.php';
