<?php

/** менеджер осуществляет аторизацию пользователей*/
class Model_Auth
{   
    private $sid;				// идентификатор текущей сессии
	private $uid;				// идентификатор текущего пользователя
    private $action;            // ссылка на драйвер
    
    /** Конструктор*/
    public function __construct()
    {
        $this->action = Model_Driver::Instance();
        
    }

	/** метод Выхода пользователя, страница авторизации также обеспечивает выход*/
    public function Logout()
	{        
        setcookie('login', '', time() - 1);
		setcookie('pass', '', time() - 1);
		unset($_COOKIE['login']);
		unset($_COOKIE['pass']);
		unset($_SESSION['sid']);		
		$this->sid = null;
		$this->uid = null;
	}    
     
   
    /** метод валидации при авторизации пользователя */
    public function auth($login, $password)
    {       
        // признак ошибки, если будет найдена ошибка, в переменную
        // будет записано значение 1.
        $errorsExist = 0;
        // сбросить флаг errors сессии   
        if (isset($_SESSION['errors']))
        {
            unset($_SESSION['errors']);
        }
         // по умолчанию все поля считаются правильными
        $_SESSION['errors']['Login'] = 'hidden';
        $_SESSION['errors']['Password'] = 'hidden';
        
        // проверить имя пользователя
        if (!$this->validateLogin($login))
        {
            $_SESSION['errors']['Login'] = 'error';
            $errorsExist = 1;
        }
    
        // проверить пароль
        if (!$this->validatePass($password))
        {
            $_SESSION['errors']['Password'] = 'error';
            $errorsExist = 1;
        }
    
        //если поля не пустые
        if ($errorsExist == 0)
        {
            $token  = $this->cryptPass($password);
            $t = "SELECT id_user FROM members WHERE login='%s' AND password='%s'";
            $query  = sprintf($t, mysql_real_escape_string($login), mysql_real_escape_string($token));
            $result = $this->action->Select($query);
            
            if(empty($result))
            {
                $errorsExist = 1;//нет такого пользователя
            }
            else
            {
               $errorsExist = 0;// правильно 
            }
        }
        
        //авторизация прошла успешно
        if ($errorsExist == 0)
        {
            //запомнить на сутки
            $expire = time() + 3600 * 24;
		    setcookie('login', $login, $expire);
		    setcookie('pass', $token, $expire);                
            	
		    
            // открываем сессию и запоминаем SID
            $link= new Model_Session;
		    $link->OpenSession($result[0]['id_user']);
            
            $path = VIEW_LOCATION;
            if($path == 'View/Rus')
            {
                $path = 'rus';
            }
            else
            {
                $path = 'eng';
            }
            
            header("Location: index.php?c=profile&lang=".$path);
	        die();  
        }
        else
        {
            $_SESSION['errors']['Login'] = 'error';
            $_SESSION['errors']['Password'] = 'error';
            // если были найдены ошибки
            
            $path = VIEW_LOCATION;
            if($path == 'View/Rus')
            {
                $path = 'rus';
            }
            else
            {
                $path = 'eng';
            }
            
            header("Location: index.php?c=auth&lang=".$path);
	        die();            
        }
          
    }
    

    /** метод проверяет поле Login*/
    private function validateLogin($value)
    {       
       if ($value == null) 
       {
           return 0; // не правильно        
       }
       
       return 1; //  правильно        
    }

  
    /** метод проверяет поле Pass*/
    private function validatePass($value)
    {        
        // обрезание пробелов вначале и сзади
        $value = trim($value);
        // поле не должно быть пустым
        if ($value)  return 1; // правильно  
        else  return 0; // не правильно
    }
    

    /** метод хеширования пароля*/
    private function cryptPass ($password)
    {         
        $salt1 = "qm&h*";
		$salt2 = "pg!@";
		$result = md5("$salt1$password$salt2");
        return $result;        
    }
       
    /** деструктор*/
    function __destruct()
    {
        
    }
        
}
