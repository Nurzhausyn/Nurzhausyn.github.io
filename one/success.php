<html>
<HEAD>
<LINK href="main.css" type=text/css rel=stylesheet>
<META http-equiv=content-type content="text/html; charset=windows-1251"></HEAD>
<body bgcolor="#EEDD82">
<?php
$i=0;
$i=$_GET["i"];
if($i==1)
{$st="Данные успешно добавлены";}
if($i==2)
{$st="Записи успешно удалены";}
?>
<table border=0 width=100% >
<tr align=center><td>
<br><br><br><br><br><br><br><br>
<hr><hr>
<H4 class="big"><?php echo $st ?></H4>
<hr><hr><br><br>
<button name="main_add" class="j-submit-report"
 onclick="window.location.href='index.php'">На главную</button></td></tr></table>
</body>
</html>
