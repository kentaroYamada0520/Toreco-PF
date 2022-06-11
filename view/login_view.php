<!DOCTYPE html>
<html lang="ja">
<head>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>ログイン</title>
  <link rel="stylesheet" href="<?php print STYLESHEET_PATH . 'login.css'; ?>">
</head>
<body>
  <?php include VIEW_PATH . 'templates/header.php'; ?>
  <div class="container">
  <div style="padding: 50px; margin-right:auto; margin-left:auto; width:500px; margin-top:60px; margin-bottom: 10px; border: 1px solid #333333;">
    <h1 style="text-align:center; padding-bottom:20px">Toreco ログイン</h1>

    <?php include VIEW_PATH . 'templates/messages.php'; ?>
   
    <form method="post" action="login_process.php" class="login_form mx-auto">
      <div class="form-group">
      <table style="height:100px;">
        <tr style="padding:20px">
          <td nowrap><label for="mail"><span>メールアドレス：</span> </label></td>
        
          <!--mail_address = "ユーザが入力した値"--> 
          <td><input type="text" name="mail_address"  id="mail" class="form-control"></td>
        </tr>
        <tr>
             <td><label for="password">パスワード：</label></td>
             <td><input type="password" style="white-space:nowrap"  name="password" id="password" class="form-control"></td>
           </tr>
      </table>
      </div>
      <td>
      <center style="padding-bottom:10px">
     <br>    
      <input type="submit" value="ログイン" class="btn btn-primary">
      <input type="hidden" name="csrf_token" value="<?= $token ?>">
     </br> 
     </center>
    </td>
    </form>
    <center>
    <a href="<?php print PASSWORD_URL; ?>" style="text-align:center; ">パスワードを忘れた方はこちら</a>
    </center>
    <center>
    <a href="<?php print SIGNUP_URL; ?>" style="text-align:center; ">アカウント新規作成はこちら</a>
    </center>
   </div>
  </div>
</body>
</html> 