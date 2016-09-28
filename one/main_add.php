<?php 
if($_POST["number"])
{$error="ошибка:";
$number=$_POST["number"];
$model=$_POST["model"];
$firm =$_POST["firm"];
$country=$_POST["country"];
if(strcmp((int)$number,$number))
{$error.="в строке номер вводяться только цифры <br>";}
else
{$link = mysql_connect("localhost", "coder","coder") or die("Could not connect");
mysql_query("set names cp1250");
mysql_select_db("dbkaznitu") or die("Could not select database");
$sql = "INSERT INTO manufacturer (number, model, firm, country) VALUES ('$number', '$model', '$firm','$country')";
$result = mysql_query($sql) or die("Query failed");
mysql_close($link);
Header("Location: success.php?i=1");}}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv=content-type content="text/html; charset=windows-1251">
<style>
.t2{
 font-size: 14px;
 color: black;
 font-family: Verdana, Helvetica, Arial;
 display:block;
 text-align: right;
 }
.t{
 font-size: 14px;
 color: red;
 font-family: Verdana, Helvetica, Arial;
 } </style>
 </head>
<body bgcolor="#EEDD82">
<br><br><br><br><br><br><br>
<center><h2>Производитель</h2></center>
<hr><hr>
<form action="manufacturer_add.php" method="post" name="frt" >
<table align="center">
<tr><td class="t2">Номер</td>
<td> <input type="text" size="6" maxlength="6" name="number" id="number" </td></tr> 
<tr><td class="t2">Модель</td>
<td> <input type="text" size="30" maxlength="30" name="model" id="model" </td></tr> 
<tr><td class="t2">Фирма</td>
<td> <input type="text" size="60" maxlength="60" name="firm" id="firm" </td></tr>
<tr><td class="t2">Страна</td>
<td> <input type="text" size="30" maxlength="30" name="country" id="country" </td></tr>
<tr><td colspan="2" align="center"><input type="submit"; name="enter"; value="ввести"; >
<br><br><button name="main_add" class="j-submit-report" 
onclick="window.location.href='index.php'">На главную</button></td></tr>
</table>
<hr><hr>
</body>
</html>
