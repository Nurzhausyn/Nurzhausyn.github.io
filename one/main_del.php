<?php
if($_POST["number"])
{ $mass=$_POST["number"];
$i=0;
while($mass[$i])
{$link = mysql_connect("localhost", "coder","coder") or die("Could not connect");
mysql_select_db("dbkaznitu") or die("Could not select database");
$s1="DELETE FROM main WHERE number=$mass[$i]";
$result1 = mysql_query($s1) or die("Сбой запроса");
$i++;}
Header("Location: success.php?i=2");}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<HEAD>
<META http-equiv=content-type content="text/html; charset=windows-1251"></HEAD>
<body bgcolor="#EEDD82">
<br><br><br><br><br>
<center><h2>Общая информация</h2></center>
<hr><hr>
<form method="post" action="main_del.php">
<table align="center"border=0>
<tr align="center" bgcolor="#FFC125">
<td>Номер</td>
<td>Модель</td>
<td>Тип</td>
<td>Цена</td></tr>
<?php
$link = mysql_connect("localhost", "coder","coder") or die("Could not connect");
mysql_query("set names cp1250");
mysql_select_db("dbkaznitu") or die("Could not select database");
$query="SELECT * FROM main";
$result = mysql_query($query) or die("Query failed");
while ($line = mysql_fetch_row($result)) { 
print "<tr align=\"center\"><td>$line[0]</td>";
print "<td>$line[1]</td>";
print "<td>$line[2]</td>";
print "<td>$line[3]</td>";
print "<td>";
$v=$line[0];
 ?>
<input type=checkbox name=number[] value= "<?php echo $v ?>" > 
<?php
print "</td></tr>";}
?>
</table>
<br><center><input type=submit name="del" value=удалить>
<br><br><button name="main_add" class="j-submit-report"
 onclick="window.location.href='index.php'">На главную</button></center>
</form><hr><hr></body></html>
