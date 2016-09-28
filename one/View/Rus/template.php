<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	<title></title>
	<meta http-equiv="content-type" content="application/xhtml+xml; charset=windows-1251" />
	<meta name="description" content="База данных компании Бек" />
	<meta name="keywords" content="Success in undertakings" />
	<meta name="author" content="Арманбетов Нуржаусын" />
	<link rel="stylesheet" type="text/css" href="View/style.css" />
    <script type="text/javascript" src="Script/validate.js"></script>
    <script type="text/javascript" src="Script/jquery-1.6.2.min.js"></script>
    <script type="text/javascript" src="Script/auth.js"></script>
</head>
<body>
<div id="wrapper">
<div id="header">
	<div id="toplinks">
		<a href="index.php?lang=eng">Eng</a> | <a href="index.php?lang=rus">Rus</a>	
	</div>
	<div id="title">
		<h1><a href="#"></a></h1>
	</div>
</div>
	<div id="menu">
		<ul>
			<li><a href="index.php?lang=rus">Главная</a></li>
			<li><a href="index.php?c=profile&lang=rus">Профиль</a></li>
			<li><a href="index.php?c=auth&lang=rus">Авторизация</a></li>
			<li><a href="index.php?c=reg&lang=rus">Регистрация</a></li>
		</ul>
	</div>
	<div align= "center" id="content">
		<div  id="main">
        <?php if(isset($content))
        {
            echo $content;
        }
        ?>
        		
		</div>
		<div id="right">
            
		</div>
		
	</div>
	<div class="clearbottom"></div>
	<div id="footer">
		<p>Copyright &copy; 2015 Nurzhan SatTimeby </p>
			
	</div>
</div>
</body>
</html>