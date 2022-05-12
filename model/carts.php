<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

//カート画面でアイテム表示するための情報取得
function get_user_cart($db, $user_id)
{
    $sql = "
    SELECT
      item_info.user_id,
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
      cart_info.user_id = ?
  ";
    return fetch_all_query($db, $sql, [$user_id]);
}

function get_cart($db, $user_id, $item_id)
{
    $sql = "
    SELECT
      cart_id
    FROM
      cart_info
    WHERE
     user_id = ?
    AND
     item_id = ?
  ";
    return fetch_query($db, $sql, [$user_id, $item_id]);
}

function create_cart($db, $user_id, $item_id)
{
    $sql = "
  INSERT INTO
   cart_info(user_id,item_id)
  VALUES(?,?);
  ";
    return execute_query($db, $sql, [$user_id, $item_id]);
}

function add_cart($db, $user_id, $item_id, $cart)
{
    $cart = get_cart($db, $user_id, $item_id);
    if ($cart === false) {
        return create_cart($db, $user_id, $item_id);
    }
}
