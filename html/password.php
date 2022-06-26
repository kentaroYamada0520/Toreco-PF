<?php
//constファイルを読み込む
require_once '../conf/const.php';
//modelを読み込む
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'user.php';
require_once MODEL_PATH . 'db.php';

session_start();

$db = get_db_connect();
$questions = select_question($db);

include_once VIEW_PATH . 'password_view.php';
