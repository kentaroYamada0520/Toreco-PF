<?php
require_once MODEL_PATH . 'functions.php';
require_once MODEL_PATH . 'db.php';

// DB利用

function get_item($db, $item_id)
{
  $sql = "
    SELECT
      itemInfo.item_id,
      itemInfo.user_id,
      itemInfo.item_price,
      item_image,
      status.status_name,
      item_category.category_name,
      trade_item_name,
      itemInfo.created,
      item_address,
      item_introduction,
      item_name,
      user.user_name,
      shipping.shipping_date
    FROM
      itemInfo
    JOIN
      user
    ON
      itemInfo.user_id = user.user_id
    LEFT JOIN
      status
    ON
      itemInfo.status_code = status.status_code
    LEFT JOIN
      shipping
    ON 
      itemInfo.shipping_code = shipping.shipping_code
    LEFT JOIN
      item_category
    ON
     itemInfo.category_code = item_category.category_code
    WHERE
      item_id = ?
  ";

  return fetch_query($db, $sql, [$item_id]);
}



// function get_item($db, $item_id){
//   $sql = "
//     SELECT
//       itemInfo.item_id,
//       itemInfo.user_id,
//       item_image,
//       status_code,
//       trade_item_name,
//       itemInfo.created,
//       itemInfo.item_name AS item_name,
//       user.user_name
//     FROM
//       itemInfo
//     JOIN
//       user
//     ON
//       itemInfo.user_id = user.user_id
//     WHERE
//       item_id = ?
//   ";

//   return fetch_query($db, $sql, array($item_id));
// }

// function get_item($db, $item_id){
//   $sql = "
//     SELECT
//       items.item_id,
//       items.user_id,
//       image,
//       item_quality,
//       trade_item,
//       items.created,
//       items.name AS item_name,
//       users.name
//     FROM
//       items
//     JOIN
//       users
//     ON
//       items.user_id = users.user_id
//     WHERE
//       item_id = ?
//   ";

//   return fetch_query($db, $sql, array($item_id));
// }

// function get_items($db)
// {
//   $sql = '
//     SELECT
//       item_id, 
//       user_id,
//       item_name,
//       item_image,
//       status_code,
//       trade_item_name,
//       itemInfo.created
//     FROM
//       itemInfo
//     WHERE 
//       flag = "0"
//     ';

//   return fetch_all_query($db, $sql);
// }

function get_items($db)
{
  $sql = '
    SELECT
      item_id, 
      user_id,
      item_name,
      item_image,
      status_code,
      trade_item_name,
      itemInfo.created
    FROM
      itemInfo
    ';

  return fetch_all_query($db, $sql);
}

function get_user_items($db, $user_id)
{
  $sql = '
    SELECT
      item_id, 
      user_id,
      item_name,
      item_image,
      item_price,
      status_code,
      trade_item_name,
      itemInfo.created
    FROM
      itemInfo
    WHERE
      user_id = ?
    ';

  return fetch_all_query($db, $sql, [$user_id]);
}

// function get_items($db){
//   $sql = '
//     SELECT
//       item_id,
//       user_id,
//       name,
//       image,
//       item_quality,
//       trade_item,
//       items.created
//     FROM
//       items
//     ';

//   return fetch_all_query($db, $sql);
// }

// function get_search_items($db, $search_name)
// {
//     $search = '%' . preg_replace('/(?=[!_%])/', '!', $search_name) . '%';
//     $sql = '
//     SELECT
//       itemInfo.item_id,
//       itemInfo.user_id,
//       item_price,
//       item_name,
//       item_image,
//       status.status_name,
//       trade_item_name,
//       item_category.category_name,
//       shipping.shipping_date,
//       item_address,
//       item_introduction,
//       user.user_name,
//       itemInfo.created
//     FROM
//       itemInfo
//     LEFT JOIN
//       user
//     ON
//       itemInfo.user_id = user.user_id
//     LEFT JOIN
//       status
//     ON
//       itemInfo.status_code = status.status_code
//     LEFT JOIN
//       shipping
//     ON
//       itemInfo.shipping_code = shipping.shipping_code
//     LEFT JOIN
//       item_category
//     ON
//       itemInfo.category_code = item_category.category_code
//     WHERE item_introduction LIKE ?
//     OR item_name LIKE ?
//      ';

//     return fetch_all_query_search($db, $sql, [$search]);
// }

function get_search_items($db, $search_name, $search_name2)
{
  $search = '%' . preg_replace('/(?=[!_%])/', '!', $search_name) . '%';
  $search2 = '%' . preg_replace('/(?=[!_%])/', '!', $search_name2) . '%';
  //var_dump($search);
  $sql = '
    SELECT
      item_id, 
      user_id,
      item_name,
      item_image,
      item_introduction
    FROM
      itemInfo
    WHERE 
      item_introduction LIKE ?
    OR
      item_name LIKE ?
    AND
      flag = "0"
     ';

  return fetch_all_query_search($db, $sql, [$search, $search2]);
}

// function get_search_items($db, $search_name){
//   $search = '%' . preg_replace('/(?=[!_%])/', '!', $search_name) . '%';
//   $sql = '
//     SELECT
//       item_id,
//       user_id,
//       name,
//       image,
//       item_quality,
//       trade_item,
//       created
//     FROM
//       items
//     WHERE
//       name LIKE ?
//     ';

//   return fetch_all_query_search($db, $sql, array($search));
// }

function get_listing_items($db, $user_id)
{
  $sql = '
    SELECT
      item_id, 
      user_id,
      item_name,
      item_image,
      status_code,
      trade_item_name,
      created
    FROM
      items
    WHERE
      mial_address = ?
    ORDER BY
      created DESC
    ';

  return fetch_all_query($db, $sql, [$user_id]);
}

// function get_listing_items($db, $user_id){
//   $sql = '
//     SELECT
//       item_id,
//       user_id,
//       name,
//       image,
//       item_quality,
//       trade_item,
//       created
//     FROM
//       items
//     WHERE
//       user_id = ?
//     ORDER BY
//       created DESC
//     ';

//   return fetch_all_query($db, $sql, array($user_id));
// }

function get_all_listing_items($db)
{
  $sql = '
    SELECT
      item_id, 
      user_id,
      item_name,
      item_image,
      status_code,
      trade_item_name,
      created
    FROM
      items
    ORDER BY
      created DESC
    ';

  return fetch_all_query($db, $sql);
}

// function get_all_listing_items($db){
//   $sql = '
//     SELECT
//       item_id,
//       user_id,
//       name,
//       image,
//       item_quality,
//       trade_item,
//       created
//     FROM
//       items
//     ORDER BY
//       created DESC
//     ';

//   return fetch_all_query($db, $sql);
// }

function get_trade_items_check($db, $item_id, $trade_item_id)
{
  $sql = '
    SELECT
      request_id, 
      user_id,
      request_user_id,
      item_id,
      request_item_id
    FROM
      trade_requests
    WHERE
      item_id = ? AND request_item_id = ?
    ';

  return fetch_query($db, $sql, [$item_id, $trade_item_id]);
}

// function get_trade_items_check($db, $item_id, $trade_item_id){
//   $sql = '
//     SELECT
//       request_id,
//       user_id,
//       request_user_id,
//       item_id,
//       request_item_id
//     FROM
//       trade_requests
//     WHERE
//       item_id = ? AND request_item_id = ?
//     ';

//   return fetch_query($db, $sql, array($item_id, $trade_item_id));
// }

function get_trade_items($db, $user_id)
{
  $sql = '
    SELECT
      item_id, 
      user_id,
      item_name,
      item_image,
      status_code,
      trade_item_name,
      created
    FROM
      itemInfo
    WHERE
      user_id = ?
    ';

  return fetch_all_query($db, $sql, [$user_id]);
}

// function get_trade_items($db, $user_id){
//   $sql = '
//     SELECT
//       item_id,
//       user_id,
//       name,
//       image,
//       item_quality,
//       trade_item,
//       created
//     FROM
//       items
//     WHERE
//       user_id = ?
//     ';

//   return fetch_all_query($db, $sql, array($user_id));
// }

function delete_item($db, $item_id)
{
  $sql = "
    DELETE FROM
      itemInfo
    WHERE
      item_id = ?
    LIMIT 1
  ";

  return execute_query($db, $sql, [$item_id]);
}

// function delete_item($db, $item_id){
//   $sql = "
//     DELETE FROM
//       items
//     WHERE
//       item_id = ?
//     LIMIT 1
//   ";

//   return execute_query($db, $sql, array($item_id));
// }

function item_trade_request(
  $db,
  $user_id,
  $request_user_id,
  $item_id,
  $request_item_id
) {
  $sql = "
    INSERT INTO
      trade_requests(
        user_id,
        request_user_id,
        item_id,
        request_item_id
      )
    VALUES(?, ?, ?, ?);
  ";
  return execute_query($db, $sql, [
    $user_id,
    $request_user_id,
    $item_id,
    $request_item_id,
  ]);
}

//function insert_item($db, $user_id, $address, $filename, $name, $category, $payment, $price, $status, $trade_item_name, $shipping, $introduct){
function regist_item(
  $db,
  $image,
  $name,
  $category,
  $payment,
  $price,
  $status,
  $trade_item_name,
  $shipping,
  $introduct,
  $user_id
) {
  $filename = get_upload_filename($image);
  if (
    validate_item(
      $filename,
      $name,
      $category,
      $payment,
      $price,
      $status,
      $trade_item_name,
      $shipping,
      $introduct
    ) === false
  ) {
    return false;
  }
  return regist_item_transaction(
    $db,
    $user_id,
    $image,
    $name,
    $category,
    $payment,
    $price,
    $status,
    $trade_item_name,
    $shipping,
    $introduct,
    $filename
  );
}

function regist_item_transaction(
  $db,
  $user_id,
  $image,
  $name,
  $category,
  $payment,
  $price,
  $status_code,
  $trade_item_name,
  $shipping,
  $introduct,
  $filename
) {
  $db->beginTransaction();
  if (
    insert_item(
      $db,
      $user_id,
      $image,
      $name,
      $category,
      $payment,
      $price,
      $status_code,
      $trade_item_name,
      $shipping,
      $introduct,
      $filename
    ) &&
    save_image($image, $filename)
  ) {
    $db->commit();
    //ここまで行けたらアイテムが登録できたという文字列を出力するためにtrueを返す
    return true;
  }
  $db->rollback();
  return false;
}

//function insert_item($db, $user_id, $address, $filename, $name, $category, $payment, $price, $status, $trade_item_name, $shipping, $introduct){
function insert_item(
  $db,
  $user_id,
  $address,
  $name,
  $price,
  $category,
  $status,
  $shipping,
  $filename,
  $introduct,
  $trade_item_name,
  $payment
) {
  // $status_value = PERMITTED_STATUS[$status];
  $sql = "
    INSERT INTO
      itemInfo(
        user_id,
        item_address,
        item_name,
        item_price,
        category_code,
        status_code,
        shipping_code,
        item_image,
        item_introduction,
        trade_item_name,
        payment_designated_code,
        created
      )
     VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW());
  ";
  return execute_query($db, $sql, [
    $user_id,
    $address,
    $name,
    $price,
    $category,
    $status,
    $shipping,
    $filename,
    $introduct,
    $trade_item_name,
    $payment,
  ]);
}

function destroy_item($db, $item_id)
{
  $item = get_item($db, $item_id);
  if ($item === false) {
    return false;
  }
  $db->beginTransaction();
  if (
    delete_item($db, $item['item_id']) &&
    delete_image($item['item_image'])
  ) {
    $db->commit();
    return true;
  }
  $db->rollback();
  return false;
}

// 非DB

function validate_item(
  $filename,
  $name,
  $category,
  $payment,
  $price,
  $status,
  $trade_item_name,
  $shipping
) {
  $is_valid_item_filename = is_valid_item_filename($filename);
  $is_valid_item_name = is_valid_item_name($name);
  $is_valid_category = is_valid_category($category);
  $is_valid_payment = is_valid_payment($payment);
  $is_valid_price = is_valid_price($price);
  $is_valid_status = is_valid_status($status);
  $is_valid_item_trade_item_name = is_valid_item_trade_item_name(
    $trade_item_name
  );
  $is_valid_shipping = is_valid_shipping($shipping);

  return $is_valid_item_filename &&
    $is_valid_item_name &&
    $is_valid_category &&
    $is_valid_payment &&
    $is_valid_price &&
    $is_valid_status &&
    $is_valid_item_trade_item_name &&
    $is_valid_shipping;
}

function is_valid_item_filename($filename)
{
  $is_valid = true;
  if ($filename === '') {
    $is_valid = false;
  }
  return $is_valid;
}

function is_valid_item_name($name)
{
  $is_valid = true;
  if (
    is_valid_length($name, ITEM_NAME_LENGTH_MIN, ITEM_NAME_LENGTH_MAX) ===
    false
  ) {
    set_error(
      'アイテム名は' .
        ITEM_NAME_LENGTH_MIN .
        '文字以上、' .
        ITEM_NAME_LENGTH_MAX .
        '文字以内にしてください。'
    );
    $is_valid = false;
  }
  return $is_valid;
}

function is_valid_category($category)
{
  $is_valid = true;
  if ($category === '') {
    set_error('アイテムのカテゴリーを選択してください');
    $is_valid = false;
  }
  return $is_valid;
}

function is_valid_payment($payment)
{
  $is_valid = true;
  if ($payment === '') {
    set_error('支払方法を選択してください');
    $is_valid = false;
  }
  return $is_valid;
}

function is_valid_price($price)
{
  $is_valid = true;
  if (preg_match('/^[0-9]+$/', $price)) {
    $is_valid = true;
  } else {
    set_error('価格は半角数字で記入してください');
    $is_valid = false;
  }
  return $is_valid;
}

function is_valid_status($status)
{
  $is_valid = true;
  if ($status === '') {
    set_error('アイテム状態を選択してください');
    $is_valid = false;
  }
  return $is_valid;
}

function is_valid_item_trade_item_name($trade_item_name)
{
  $is_valid = true;
  if (
    is_valid_length(
      $trade_item_name,
      ITEM_NAME_LENGTH_MIN,
      ITEM_NAME_LENGTH_MAX
    ) === false
  ) {
    set_error(
      'トレードしたいアイテム名は' .
        ITEM_NAME_LENGTH_MIN .
        '文字以上、' .
        ITEM_NAME_LENGTH_MAX .
        '文字以内にしてください。'
    );
    $is_valid = false;
  }
  return $is_valid;
}

function is_valid_shipping($shipping)
{
  $is_valid = true;
  if ($shipping = '') {
    set_error('発送期間を選択してください');
    $is_valid = false;
  }
  return $is_valid;
}

function select_item_category($db)
{
  $sql = "
    SELECT *
    FROM
     item_category
  ";

  return fetch_all_query($db, $sql);
}

function select_shipping($db)
{
  $sql = "
    SELECT *
    FROM
     shipping
  ";

  return fetch_all_query($db, $sql);
}

function select_status($db)
{
  $sql = "
    SELECT *
    FROM
     status  
  ";

  return fetch_all_query($db, $sql);
}


function get_purchase_history($db, $sql, $user_id)
{
  $sql = "
   SELECT
    purchase_history.purchase_id,
    purchase_history.item_id, 
    purchase_history.now,
    purchase_history.my_purchase_id,
    itemInfo.item_name,
    itemInfo.item_price,
    itemInfo.item_image,
    itemInfo.user_id,
    user.user_name
   FROM
    purchase_history
   JOIN
    itemInfo
   ON
    purchase_history.item_id = itemInfo.item_id
   JOIN
    user
   ON
    itemInfo.user_id = user.user_id
   WHERE
    purchase_history.user_id = ?
  ";
  return fetch_all_query($db, $sql, [$user_id]);
}

// function show_purchase_history($db, $sql, $user_id, $times)
// {
//   foreach ($times as $time) {
//     get_purchase_history($db, $sql, $user_id, $time['now']);
//     // var_dump($times);
//   }
// }






function get_purchase_id($db, $sql, $user_id)
{
  $sql = "
   SELECT DISTINCT
    my_purchase_id,
    now
   FROM
    purchase_history
   WHERE
    user_id = ?
   ORDER BY now DESC
   limit 6
  ";
  return fetch_all_query($db, $sql, [$user_id]);
}
