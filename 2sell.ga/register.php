<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>login.php</title>
<link rel=stylesheet type="text/css" href="css/login.css">

</head>
<body>
<?php
session_start();  // 啟用交談期
$users_account = "";  $users_password = "";
$users_phone = "";  $users_photo = "";
$users_address = "";
// 取得表單欄位值
if ( isset($_POST["users_account"]) )
   $users_account = $_POST["users_account"];
if ( isset($_POST["users_password"]) )
   $users_password = $_POST["users_password"];
if ( isset($_POST["users_phone"]) )
   $users_phone = $_POST["users_phone"];
if ( isset($_POST["users_photo"]) )
   $users_photo = $_POST["users_photo"];
if ( isset($_POST["users_address"]) )
   $users_address = $_POST["users_address"];
   // 建立MySQL的資料庫連接
 include_once ('part/db.php');

   // 執行SQL


if ( isset($_POST["users_account"]) ){
   if($users_account != null && $users_password!= null )
   {

  $sql = "SELECT * FROM users where users_account = '$users_account'";
  $result = mysqli_query($link, $sql);
  $row = @mysqli_fetch_row($result);
if ( $row[1] == $users_account)
   {
   	echo '帳號重複，請洽管理員';
   }
else {

  $sql ="INSERT INTO users (users_account,users_password,users_phone,users_photo,users_address,users_money)
  VALUES ( '$users_account','$users_password','$users_phone','$users_photo','$users_address','0')";  //新增資料
  mysqli_query($link, $sql);
  echo "註冊成功三秒後轉跳到首頁";
  $_SESSION["login_session"] = true;
  $_SESSION["user"] = $users_account;
header('refresh: 3; url=index.php');
}

 }
 else{

   echo "請輸入帳戶與密碼";
 }
}


   mysqli_close($link); //關閉資料庫連結

   ?>


<body class="align">

  <div class="grid">
    <form action="register.php" method="post" class="form login">

      <div class="form__field">
        <label for="login__username"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#user"></use></svg><span class="hidden">Username</span></label>
        <input id="login__username" type="text" name="users_account" class="form__input" placeholder="帳號" required>
      </div>

      <div class="form__field">
        <label for="login__password"><svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lock"></use></svg><span class="hidden">Password</span></label>
        <input id="login__password" type="password" name="users_password" class="form__input" placeholder="密碼" required>
      </div>

      <div class="form__field">
        <input id="login__password" type="text" name="users_phone" class="form__input" placeholder="電話" required>
      </div>

      <div class="form__field">
        <input id="login__password" type="text" name="users_address" class="form__input" placeholder="地址" required>
      </div>

      <div class="form__field">
        <input type="submit" value="立即註冊">
      </div>

    </form>
    <p class="text--center">已經有帳號? <a href="login.php">立即登入</a> <svg class="icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="assets/images/icons.svg#arrow-right"></use></svg></p>


</div>

<svg xmlns="http://www.w3.org/2000/svg" class="icons"><symbol id="arrow-right" viewBox="0 0 1792 1792"><path d="M1600 960q0 54-37 91l-651 651q-39 37-91 37-51 0-90-37l-75-75q-38-38-38-91t38-91l293-293H245q-52 0-84.5-37.5T128 1024V896q0-53 32.5-90.5T245 768h704L656 474q-38-36-38-90t38-90l75-75q38-38 90-38 53 0 91 38l651 651q37 35 37 90z"/></symbol><symbol id="lock" viewBox="0 0 1792 1792"><path d="M640 768h512V576q0-106-75-181t-181-75-181 75-75 181v192zm832 96v576q0 40-28 68t-68 28H416q-40 0-68-28t-28-68V864q0-40 28-68t68-28h32V576q0-184 132-316t316-132 316 132 132 316v192h32q40 0 68 28t28 68z"/></symbol><symbol id="user" viewBox="0 0 1792 1792"><path d="M1600 1405q0 120-73 189.5t-194 69.5H459q-121 0-194-69.5T192 1405q0-53 3.5-103.5t14-109T236 1084t43-97.5 62-81 85.5-53.5T538 832q9 0 42 21.5t74.5 48 108 48T896 971t133.5-21.5 108-48 74.5-48 42-21.5q61 0 111.5 20t85.5 53.5 62 81 43 97.5 26.5 108.5 14 109 3.5 103.5zm-320-893q0 159-112.5 271.5T896 896 624.5 783.5 512 512t112.5-271.5T896 128t271.5 112.5T1280 512z"/></symbol></svg>


</body>
</html>
