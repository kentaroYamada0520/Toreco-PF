<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

//カート画面でアイテム表示するための情報取得
function get_user_cart($db, $user_id)
{
    $sql = "
    SELECT
      item_id,
      itemInfo.item_name,
      itemInfo.item_price,
      itemInfo.item_image
    FROM
      cart_info
    JOIN
      itemInfo
    ON
      cart_info.item_id = itemInfo.item_id
    WHERE
      cart_info.user_id = 1
  ";
    return fetch_all_query($db, $sql, [$user_id]);
}

function insert_cart($db, $user_id, $item_id)
{
    $sql = "
    INSERT INTO
      cart_info(
        item_id
      )
    VALUES(?)
    WHERE
      user_id = ? 
  ";
    return execute_query($db, $sql, [$user_id, $item_id]);
}
