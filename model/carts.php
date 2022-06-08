<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

//カート画面でアイテム表示するための情報取得
function get_user_cart($db, $sql, $user)
{
    $sql = "
    SELECT
      cart_info.cart_id,
      itemInfo.item_name,
      itemInfo.item_price,
      itemInfo.item_image,
      itemInfo.category_code,
      item_category.category_code,
      item_category.category_name
    FROM
      cart_info
    RIGHT JOIN
      itemInfo
    ON
      cart_info.item_id = itemInfo.item_id
    RIGHT JOIN
      item_category
    ON
      itemInfo.category_code = item_category.category_code
    WHERE
      cart_info.user_id = ?
  ";
    return fetch_all_query($db, $sql, [$user]);
}

function get_user_cart1($db, $sql, $user)
{
    $sql = "
  SELECT
    cart_info.cart_id,
    cart_info.user_id,
    cart_info.item_id,
    user.user_id,
    user.user_name,
    user.mail_address,
    itemInfo.item_id,
    itemInfo.item_name,
    itemInfo.item_price,
    itemInfo.item_image,
    itemInfo.category_code,
    itemInfo.shipping_code,
    item_category.category_code,
    item_category.category_name
  FROM
    cart_info
  RIGHT JOIN
    user
  ON
    cart_info.user_id = user.user_id
  RIGHT JOIN
    itemInfo
  ON
    cart_info.item_id = itemInfo.item_id
  RIGHT JOIN
    item_category
  ON
    itemInfo.category_code = item_category.category_code
  WHERE
    cart_info.user_id = ?
";
    return fetch_all_query($db, $sql, [$user]);
}

// $sql = "
//     SELECT
//       cart_info.cart_id,
//       cart_info.user_id,
//       cart_info.item_id,
//       user.user_id,
//       user.user_name,
//       user.mail_address,
//       itemInfo.item_id,
//       itemInfo.item_name,
//       itemInfo.item_price,
//       itemInfo.item_image,
//       itemInfo.category_code,
//       itemInfo.shipping_code,
//       item_category.category_code,
//       item_category.category_name,
//     FROM
//       cart_info
//     RIGHT JOIN
//       user
//     ON
//       cart_info.user_id = user.user_id
//     RIGHT JOIN
//       itemInfo
//     ON
//       cart_info.item_id = itemInfo.item_id
//     RIGHT JOIN
//       item_category
//     ON
//       itemInfo.category_code = item_category.category_code
//     WHERE
//       cart_info.user_id = ?
//   ";
//     return fetch_all_query($db, $sql, [$user]);

// function get_user_cart($db, $sql, $user)
// {
//     $sql = "
//     SELECT
//       cart_info.cart_id,
//       cart_info.item_id,
//       itemInfo.item_id,
//       itemInfo.user_id,
//       itemInfo.item_name,
//       itemInfo.item_price,
//       itemInfo.item_image,
//       itemInfo.category_code,
//       itemINfo.shipping_code,
//       user.user_id
//       user.user_name,
//       user.mail_address,
//       item_category.category_code,
//       item_category.category_name,
//       shipping.shipping_code
//     FROM
//       cart_infoS
//     RIGHT JOIN
//       itemInfo
//     ON
//       cart_info.item_id = itemInfo.item_id
//     RIGHT JOIN
//       item_category
//     ON
//       itemInfo.category_code = item_category.category_code
//     RIGHT JOIN
//       shipping
//     ON
//       itemInfo.shipping_code = shipping.shipping_code
//     RIGHT JOIN
//       userInfo
//     ON
//       itemInfo.user_id = user.user_id
//     WHERE
//       cart_info.user_id = ?
//   ";
//     return fetch_all_query($db, $sql, [$user]);
// }

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

function delete_cart($db, $sql, $cart_id)
{
    $sql = "
  DELETE
  FROM
   cart_info
  WHERE
   cart_id = ?
  ";
    return execute_query($db, $sql, [$cart_id]);
}

function get_item_id($db, $sql, $user_id)
{
    $sql = "
    SELECT
     item_id
    FROM
     cart_info
    WHERE
     user_id = ?
  ";
    return fetch_query($db, $sql, [$user_id]);
}

function purchase_confirm($db, $sql, $item_id)
{
    $sql = "
    UPDATE
     itemInfo
    SET
     flag = '1'
    WHERE
     item_id = ?
   ";
    return execute_query($db, $sql, [intval($item_id)]);
}

function purchase_cart($db, $sql, $user_id)
{
    $sql = "
    DELETE
    FROM
     cart_info
    WHERE
     user_id = ?
  ";
    return execute_query($db, $sql, [$user_id]);
}

function purchase_history($db, $sql, $user_id, $item_id)
{
    $sql = "
  INSERT INTO
    purchase_history(user_id,item_id,now)
 VALUES(?,?,NOW())
  ";
    return execute_query($db, $sql, [$user_id, intval($item_id)]);
}
