<!DOCTYPE html>
<html lang="ja">
<head>
<?php include VIEW_PATH . 'templates/head.php'; ?>
  
  <title>購入完了画面</title>
  <link rel="stylesheet" href="<?php print STYLESHEET_PATH . 'index.css'; ?>">
</head>

<body style="background-color:#f8f9fa;">
<?php include VIEW_PATH . 'templates/header_logined_other.php'; ?>

<h1 class="text-center">購入が確定しました。</h1>
<hr class="my-6"></div>
<div class="text-left" style="padding-left:500px;">
<h3>支払金額：￥<?php print $sum_price; ?></h3>
<h3>支払方法：<?php if ($pay === false) { ?>
           <stron>クレジットカード</stron></h3>
           <?php } else { ?>
            <stron>現金</stron>
           <?php } ?>
<h5>詳細な発送日については下記発送者連絡先にてお問い合わせください。</h5>
</div>
<table class="table table-striped" style="margin-top:70px;">
   <thead>
       <th scope="col">#</th>
       <th scope="col">アイテム名</th>
       <th scope="col">発送予定日</th>
       <th scope="col">発送者名</th>
       <th scope="col">発送者連絡先</th>
   </thead>
   <tbody>
   <?php for ($i = 0; $i < $max; $i++) {
       $total += $pro_price[$i]; ?>
       <th scope="row"><?php print $i + 1; ?></th>
       <td><?php print $pro_item_name[$i]; ?></td>
       <?php if ($pro_shipping[$i] == 14) { ?>
       <td><?php print date(
           'Y年m月d日',
           strtotime("$pro_shipping[$i] day")
       ); ?>以降</td>
       <?php } else { ?>
        <td><?php print date(
            'Y年m月d日',
            strtotime("$pro_shipping[$i] day")
        ); ?></td>
       <?php } ?>
       <td><?php print $pro_user_name[$i]; ?></td>
       <td><?php print $pro_mail[$i]; ?></td>
   </tbody>
   <?php
   } ?>
</table>    

