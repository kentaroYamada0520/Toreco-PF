<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8" />
		<script type="text/javascript" charset="UTF-8"></script>
  <?php include VIEW_PATH . 'templates/head.php'; ?>
  <title>パスワード忘れた場合の画面</title>
  <link rel="stylesheet" href="<?php print STYLESHEET_PATH . 'login.css'; ?>">
</head>

<body>
<?php include VIEW_PATH . 'templates/header.php'; ?>
  <div class="container">
  <div style="padding: 50px; margin-right:auto; margin-left:auto; width:500px; margin-top:60px; margin-bottom: 10px; border: 1px solid #333333;">
    <h1 style="text-align:center; padding-bottom:20px">パスワード送信</h1>

    <?php include VIEW_PATH . 'templates/messages.php'; ?>
   
    <form method="post" action="password_process.php" class="login_form mx-auto">
      <div class="form-group">
      <table style="height:100px;">
        <tr style="padding:20px">
          <td nowrap><label for="mail"><span>メールアドレス：</span> </label></td>
        
          <!--mail_address = "ユーザが入力した値"--> 
          <td><input type="text" name="mail_address"  id="mail" class="form-control"></td>
        </tr>
        <tr>
             <td><label for="question">秘密の質問：</label></td>
             <td><select name="question_code">
                 <?php foreach ($questions as $question) { ?>
                 <option value="<?php print $question[
                     'question_code'
                 ]; ?>"><?php print $question['question_content']; ?></option>
                 <?php } ?>
             </select></td>
           </tr>
           <tr>
             <td><label for="answer">質問の答え：</label></td>
             <td><input type="text" style="white-space:nowrap"  name="question_answer" id="answer" class="form-control"></td>
           </tr>
      </table>
      </div>
      <td>
      <center style="padding-bottom:10px">
     <br>    
      <input type="submit" value="送信" class="btn btn-primary">
      <input type="hidden" name="csrf_token" value="<?= $token ?>">
     </br> 
     </center>
    </td>
    </form>
   </div>
  </div>

</body>
</html> 