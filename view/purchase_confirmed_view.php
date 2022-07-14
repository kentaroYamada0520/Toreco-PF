<!DOCTYPE html>
<html lang="ja">
<head>
<?php include VIEW_PATH . 'templates/head.php'; ?>
  
  <title>購入確認画面</title>
  <link rel="stylesheet" href="<?php print STYLESHEET_PATH . 'index.css'; ?>">
</head>

<body style="background-color:#f8f9fa;">
<?php include VIEW_PATH . 'templates/header_logined_other.php'; ?>
  <div class="container">
   <main>
    <div class="py-5 text-center">
      <h2>購入確認画面</h2>
      <?php include VIEW_PATH . 'templates/messages.php'; ?>
    </div>
    


    <div class="row g-5">
    <div class="col-md-5 col-lg-4 order-md-last">
      <h4 class="d-flex justify-content-between align-items-center md-3">
        <span class="text-primary">カート</span>
        <span class="badge bg-primary rounded-pill" style="color: #fff;"><?php print $max; ?></span>
      </h4>
      <ul class="list-group mb-3">
      <?php for ($i = 0; $i < $max; $i++) {
          $total += $pro_price[$i]; ?>
        <li class="list-group-item d-flex justify-content-between lh-sm">
          <div>
            <h6 class="my-0"><?php print $pro_name[$i]; ?></h6>
            <small class="text-muted"><?php print $pro_category[$i]; ?></small>
          </div>
         <span class="text-muted">￥<?php print $pro_price[$i]; ?>円</span>
        </li>
        <?php
      } ?>
        <li class="list-group-item d-flex justify-content-between">
          <span>合計</span>
          <strong>￥<?php print $total; ?>円</strong>
        </li>
      </ul>
    </div>



   
    <div class="col-md-7 col-lg-8">
      <h4 class="mb-3">請求先住所</h4>
      <form method="post" action="purchase_process.php" class="needs-validation" nobalidate>
       <div class="row g-3">
        <div class="col-sm-6" style="padding:10px;">
          <label for="real_name" class="form-label">名前</label>
          <p class="form-control" name="real_name" value="<?php print $real_name ?>"><?php print $real_name ?></p>
        </div>
        <div class="col-12">
          <label for="mail_address" class="form-label">メールアドレス</label>
          <p class="form-control" name="mail_address" value="<?php print $mail_address ?>"><?php print $mail_address ?></p>
        </div>
        <div class="col-12">
          <label for="address" class="form-label">住所</label>
          <p class="form-control" name="address" value="<?php print $address ?>"><?php print $address ?></p>
        </div>
        <hr class="my-4">
         <h4 class="mb-3"  style="padding:10px;">お支払方法</h4>
         <hr class="my-3">
           <?php if ($pay === false) { ?>
           <!-- <div class="d-block my-3" style="display:blocd!important";>
             <strong>クレジットカード</strong>
           </div> -->
           <div class="col-12">
             <h4>クレジットカード</h4>
           </div>

           <div class="row gy-3" style="padding:10px;">
               <div class="col-md-6"> 
                 <label for="cc-name" class="form-label">カードの名義</label>
                 <p class="form-control" name="cc_name" value="<?php print $cc_name ?>"><?php print $cc_name ?></p>
               </div>
               <div class="col-md-6">
                 <label for="cc-number" class="form-label">クレジットカード番号</label>
                 <p class="form-control" name="cc_number" value="<?php print $cc_number ?>"><?php print $cc_number ?></p>
                 <!-- <div class="invalid-feedback">クレジットカード番号を入力してください</div> -->
               </div>
               <div class="col-md-3">
                 <label for="cc-expiration" class="form-label">有効期限</label>
                 <p class="form-control" name="cc_expiration" value="<?php print $cc_expiration ?>"><?php print $cc_expiration ?></p>
                 <!-- <div class="invalid-feedback">有効期限を入力してください</div> -->
               </div>
               <div class="col-md-3">
                 <label for="cc-cvv" class="form-label">セキュリティコード</label>
                 <p class="form-control" name="cc_cvv" value="<?php print $cc_cvv ?>"><?php print $cc_cvv ?></p>
                 <!-- <div class="invalid-feedback">セキュリティコードを入力してください</div> -->
               </div>
           </div>
           <?php } else { ?>
            <!-- <div class="form-check">
             <input id="cash" name="payment_code" value="0" type="radio" class="form-check-input" required checked>
             <label class="form-check-label" for="cash">現金</label>
           </div>
           <div class="form-check">
             <input id="credit" name="payment_code" value="1" type="radio" class="form-check-input" requered>
             <label class="form-check-label" for="credit">クレジットカード</label>
           </div> -->
           <div class="col-12">
             <h4>現金</h4>
           </div>
           <?php } ?>

         </div>
           <hr class="my-4">
           <button class="w-100 btn btn-primary btn-lg" type="submit">精算を確定する</button>
           <input type="hidden" name="sum_price" value="<?php print $total; ?>">
      </form>
      <form method="post" action="purchase.php">
        <input type="submit" value="戻る"  class="btn btn-warning btn-block">
        <input type="hidden" name="flag" value="1">
      </form>
    </div>
    </div>

   </main>
  </div>


</body>