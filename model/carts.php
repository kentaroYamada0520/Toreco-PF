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
  return fetch_all_query($db, $sql, [$user_id]);
}


function add_flag($db, $sql, $items)
{
  foreach ($items as $item) {
    purchase_confirm($db, $sql, $item['item_id']);
  }
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

// function purchase_history($db, $sql, $user_id, $item_id)
// {
//     $sql = "
//   INSERT INTO
//     purchase_history(user_id,item_id,now)
//  VALUES(?,?,NOW())
//   ";
//     return execute_query($db, $sql, [$user_id, intval($item_id)]);
// }

function purchase_history($db, $sql, $user_id, $item_id, $my_purchase_id)
{
  $sql = "
  INSERT INTO
    purchase_history(user_id,item_id,my_purchase_id,now)
 VALUES(?,?,?,NOW())
  ";
  // var_dump($item_id);
  // var_dump($user_id);
  // $result = array_map('intval',$item_id);
  return execute_query($db, $sql, [$user_id, $item_id, $my_purchase_id]);
}

// function insert_purchase_history($db, $sql, $user_id, $item, $count){
//   for($i=0;$i<$count;$i++){
//     $item_id = $item[$i];
//     var_dump($item_id);
//     var_dump($user_id);
//     purchase_history($db, $sql, $user_id, $item_id);
//   }
// }

//var_dump()の結果、array { ["item_id"]=> int(10)}だったため、int(10)のみを取り出すコードを作成
// function insert_purchase_history($db, $sql, $user_id, $item)
// {
//   foreach ($item as $items) {
//     foreach ($items as $key => $item_id) {
//       purchase_history($db, $sql, $user_id, $item_id);
//     }
//   }
// }



function get_my_purchase_id($db, $sql, $user_id)
{
  $sql = "
    SELECT DISTINCT
     my_purchase_id
    FROM
     purchase_history
    WHERE
     my_purchase_id = (SELECT MAX(my_purchase_id) FROM purchase_history)
    AND
     user_id = ?
  ";
  return fetch_query($db, $sql, [$user_id]);
}


function insert_purchase_history($db, $sql, $user_id, $items, $my_purchase_id)
{
  foreach ($items as $item) {
    purchase_history($db, $sql, $user_id, $item['item_id'], $my_purchase_id);
  }
}

// function purchase_history($db, $sql, $item_id, $user_id)
// {
//     $sql = "
//   INSERT INTO
//     purchase_history(user_id,item_id)
//  VALUES(?,?)
//   ";
//     return execute_query($db, $sql, [intval($item_id), $user_id]);
// }

// function purchase_history($db, $sql, $user_id, $item_id)
// {
//     $sql = "
//   INSERT INTO
//     purchase_history(user_id,item_id,now)
//  VALUES(?,?,NOW())
//   ";
//     return execute_query($db, $sql, [$user_id, $item_id]);
// }

// function get_purchase_history($db, $user_id)
// {
//     $sql = "
//     SELECT
//      purchase_history.item_id,
//      itemInfo.item_id
//     FROM
//      purchase_history
//     JOIN
//      itemInfo
//     ON
//      purchase_history.item_id = itemInfo.item_id
//     WHERE
//      user_id = ?
//   ";
//     return fetch_query($db, $sql, [$user_id]);
// }

//
