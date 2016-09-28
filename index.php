<?php 
/** Единая точка входа на сайт. 
 *  Определяться фукция автолоад.
 *  Контроллер выбираеться по параметру вызова,
 *  прописываеться путь к папке View в зависимости
 *  от выбора языка пользователем.
 */
   
require_once ('model/startup.php');

function __autoload($className) 
{ 
    $pos = strpos($className, "_");
    $dir = substr($className, 0, $pos); //название папки где искать файл 
    //объявления классов в соответствующих файлах 
    include_once($dir.'/'.$className.'.php');
}

if(isset($_GET['lang']))
{
    //выбор пользоваетелем языка
    switch ($_GET['lang'])
    {
        case 'rus':
        	define("VIEW_LOCATION", "View/Rus");
        	break;
        case 'eng':    
            define("VIEW_LOCATION", "View");
    }
    
}
else
{
    define("VIEW_LOCATION", "View");   
}

if (isset($_GET['c']))
{
    // Выбор контроллера.
    switch ($_GET['c'])
    {
    case 'profile':
    	$controller = new Controller_Profile();
    	break;
    case 'auth':
    	$controller = new Controller_Auth();
    	break;
    case 'reg':
    	$controller = new Controller_Reg();
    	break;            
    	
    }
}
else
{
    $controller = new Controller_Main();  
}

// Обработка запроса.
$controller->Request();
?>