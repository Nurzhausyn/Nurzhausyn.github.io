<!DOCTYPE html PUBLIC>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title></title>
	<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
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
			<li><a href="index.php?lang=eng">Home</a></li>
			<li><a href="index.php?c=profile&lang=eng">Profile</a></li>
			<li><a href="index.php?c=auth&lang=eng">Authorization</a></li>
			<li><a href="index.php?c=reg&lang=eng">Registration</a></li>
		</ul>
	</div>
	<div align= "center" id="content">
		<div id="main">
		<hr />
     <?php if(isset($content))
	 { 
           echo $content;
         } ?>
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