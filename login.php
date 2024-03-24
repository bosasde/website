<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form_name']) && $_POST['form_name'] == 'loginform')
{
   $success_page = './index.html';
   $error_page = basename(__FILE__);
   $database = './usersdb.php';
   $crypt_pass = md5($_POST['password']);
   $found = false;
   $fullname = '';
   $session_timeout = 600;
   if(filesize($database) > 0)
   {
      $items = file($database, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
      foreach($items as $line)
      {
         list($username, $password, $email, $name, $active) = explode('|', trim($line));
         if ($username == $_POST['username'] && $active != "0" && $password == $crypt_pass)
         {
            $found = true;
            $fullname = $name;
         }
      }
   }
   if($found == false)
   {
      header('Location: '.$error_page);
      exit;
   }
   else
   {
      if (session_id() == "")
      {
         session_start();
      }
      $_SESSION['username'] = $_POST['username'];
      $_SESSION['fullname'] = $fullname;
      $_SESSION['expires_by'] = time() + $session_timeout;
      $_SESSION['expires_timeout'] = $session_timeout;
      $rememberme = isset($_POST['rememberme']) ? true : false;
      if ($rememberme)
      {
         setcookie('username', $_POST['username'], time() + 3600*24*30);
         setcookie('password', $_POST['password'], time() + 3600*24*30);
      }
      header('Location: '.$success_page);
      exit;
   }
}
$username = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
$password = isset($_COOKIE['password']) ? $_COOKIE['password'] : '';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Вход</title>
<link href="web.css" rel="stylesheet">
<link href="login.css" rel="stylesheet">
<script src="jquery-1.12.4.min.js"></script>
<script>
$(document).ready(function()
{
   $("a[href*='#PageHeader1']").click(function(event)
   {
      event.preventDefault();
      $('html, body').stop().animate({ scrollTop: $('#PageHeader1').offset().top }, 600, 'linear');
   });
});
</script>
</head>
<body>
<div id="PageHeader1" style="position:fixed;text-align:center;left:0;top:0;right:0;height:143px;z-index:7777;">
<div id="PageHeader1_Container" style="width:970px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
<a href="./index.html">
<picture id="wb_Picture1" style="position:absolute;left:0px;top:1px;width:154px;height:141px;z-index:6">
<img src="images/logo-removebg-preview.png" id="Picture1" alt="" srcset="">
</picture>
</a>
<img src="images/img0011.jpg" id="Banner1" alt="&#1048;&#1085;&#1090;&#1077;&#1088;&#1085;&#1077;&#1090; &#1084;&#1072;&#1075;&#1072;&#1079;&#1080;&#1085; &quot;&#1053;&#1072; &#1082;&#1088;&#1102;&#1095;&#1086;&#1082;&quot;" style="border-width:0;position:absolute;left:154px;top:0px;width:816px;height:142px;z-index:7;">
</div>
</div>
<div id="container">
<div id="wb_Shape1" style="position:absolute;left:0px;top:143px;width:970px;height:52px;z-index:0;">
<img src="images/img0012.png" id="Shape1" alt="" style="width:970px;height:52px;"></div>
<div id="wb_TextMenu1" style="position:absolute;left:0px;top:150px;width:720px;height:39px;z-index:1;">
<span><a href="./index.html">&#1043;&#1083;&#1072;&#1074;&#1085;&#1072;&#1103;</a></span><span><a href="./about.html">&#1054; &#1082;&#1086;&#1084;&#1087;&#1072;&#1085;&#1080;&#1080;</a></span><span><a href="">&#1053;&#1086;&#1074;&#1086;&#1089;&#1090;&#1080;</a></span><span><a href="">&#1050;&#1072;&#1082; &#1082;&#1091;&#1087;&#1080;&#1090;&#1100;</a></span><span><a href="">&#1044;&#1086;&#1089;&#1090;&#1072;&#1074;&#1082;&#1072;</a></span><span><a href="">&#1054;&#1087;&#1083;&#1072;&#1090;&#1072;</a></span><span><a href="">&#1050;&#1086;&#1085;&#1090;&#1072;&#1082;&#1090;&#1099;</a></span></div>
<div id="Layer1" style="position:absolute;text-align:center;left:91px;top:184px;width:879px;height:787px;z-index:2;">
<div id="Layer1_Container" style="width:879px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
</div>
</div>
<div id="NavigationBar1" style="position:absolute;left:740px;top:150px;width:208px;height:30px;z-index:3;">
<ul class="navbar">
<li><a href=""><img alt="" src="images/img0013_over.png" class="hover"><span><img alt="" src="images/img0013.png"></span></a></li>
<li><a href="./login.php"><img alt="" src="images/img0014_over.png" class="hover"><span><img alt="" src="images/img0014.png"></span></a></li>
</ul>
</div>
<hr id="Line1" style="position:absolute;left:1px;top:193px;width:969px;z-index:4;">
<div id="wb_TextMenu4" style="position:absolute;left:0px;top:210px;width:101px;height:224px;z-index:5;">
<span><a href="">&#1040;&#1082;&#1094;&#1080;&#1080;</a></span>
<span><a href="">&#1050;&#1072;&#1090;&#1091;&#1096;&#1082;&#1080;</a></span>
<span><a href="">&#1059;&#1076;&#1080;&#1083;&#1080;&#1097;&#1072;</a></span>
<span><a href="">&#1051;&#1077;&#1089;&#1082;&#1080;</a></span>
<span><a href="">&#1055;&#1088;&#1080;&#1084;&#1072;&#1085;&#1082;&#1072;</a></span>
</div>

<img src="images/img0006.jpg" id="Banner2" alt="&#1042;&#1093;&#1086;&#1076;" style="border-width:0;position:absolute;left:90px;top:208px;width:880px;height:68px;z-index:14;">
<div id="wb_Login1" style="position:absolute;left:387px;top:364px;width:268px;height:214px;z-index:15;">
<form name="loginform" method="post" accept-charset="UTF-8" action="<?php echo basename(__FILE__); ?>" id="loginform">
<input type="hidden" name="form_name" value="loginform">
<table id="Login1">
<tr>
   <td class="header">Авторизация</td>
</tr>
<tr>
   <td class="label"><label for="username">Имя</label></td>
</tr>
<tr>
   <td class="row"><input class="input" name="username" type="text" id="username" value="<?php echo $username; ?>"></td>
</tr>
<tr>
   <td class="label"><label for="password">Пароль</label></td>
</tr>
<tr>
   <td class="row"><input class="input" name="password" type="password" id="password" value="<?php echo $password; ?>"></td>
</tr>
<tr>
   <td class="row"><input id="rememberme" type="checkbox" name="rememberme"><label for="rememberme">Запомнить меня</label></td>
</tr>
<tr>
   <td style="text-align:center;vertical-align:bottom"><input class="button" type="submit" name="login" value="Вход" id="login"></td>
</tr>
</table>
</form>
</div>
</div>
<div id="PageFooter1" style="position:fixed;overflow:hidden;text-align:center;left:0;right:0;bottom:0;height:122px;z-index:16;">
<div id="PageFooter1_Container" style="width:970px;position:relative;margin-left:auto;margin-right:auto;text-align:left;">
<div id="wb_Heading1" style="position:absolute;left:250px;top:0px;width:155px;height:34px;z-index:9;">
<h1 id="Heading1">О компании</h1></div>
<div id="wb_TextMenu2" style="position:absolute;left:253px;top:36px;width:152px;height:86px;z-index:10;">
<span><a href="./about.html" class="style2">&#1054; &#1085;&#1072;&#1089;</a></span>
<span><a href="" class="style2">&#1053;&#1072;&#1096;&#1080; &#1084;&#1072;&#1075;&#1072;&#1079;&#1080;&#1085;&#1099;</a></span>
<span><a href="" class="style2">&#1050;&#1086;&#1085;&#1089;&#1091;&#1083;&#1100;&#1090;&#1072;&#1094;&#1080;&#1103;</a></span>
<span><a href="" class="style2">&#1053;&#1086;&#1074;&#1086;&#1089;&#1090;&#1080;</a></span>
</div>
<div id="wb_Heading2" style="position:absolute;left:467px;top:0px;width:253px;height:34px;z-index:11;">
<h1 id="Heading2">Доставка и оплата</h1></div>
<div id="wb_TextMenu3" style="position:absolute;left:467px;top:36px;width:152px;height:86px;z-index:12;">
<span><a href="" class="style2">&#1050;&#1072;&#1082; &#1082;&#1091;&#1087;&#1080;&#1090;&#1100;</a></span>
<span><a href="" class="style2">&#1044;&#1086;&#1089;&#1090;&#1072;&#1074;&#1082;&#1072;</a></span>
<span><a href="" class="style2">&#1054;&#1087;&#1083;&#1072;&#1090;&#1072;</a></span>
</div>
</div>
</div>
</body>
</html>