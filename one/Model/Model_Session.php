<?php

/** Менеджер сесии*/
class Model_Session           
{	
	private $sid;				// идентификатор текущей сессии
	private $uid;				// идентификатор текущего пользователя
	private $action;            // ссылка на драйвер
    
    /** Конструктор*/
    public function __construct()
    {
        $this->action = Model_Driver::Instance();
        $this->sid = null;
		$this->uid = null;   
    }

    	

	/** метод очищает неиспользуемые сессии*/
    public function ClearSessions()
	{
		$min = date('Y-m-d H:i:s', time() - 60 * 20); 			
		$t = "time_last < '%s'";
		$where = sprintf($t, $min);
        $this->action->Delete('sessions', $where);
	}
							

	/** метод возврощает пользователя*/
	public function Get($id_user = null)
	{	
		// Если id_user не указан, берем его по текущей сессии.
		if ($id_user == null)
        {
            $id_user = $this->GetUid();            
        }			
			
		if ($id_user == null)
        {
            return null;            
        }
					
		// А теперь просто возвращаем пользователя по id_user.
		$t = "SELECT * FROM members WHERE id_user = '%d'";
		$query = sprintf($t, $id_user[0]['id_user']);
        $result = $this->action->Select($query);
		return $result;		
	}
	
     /** метод возврощает пользователя по логину*/
	private function GetByLogin($login)
	{	
		$t = "SELECT * FROM members WHERE login = '%s'";
		$query = sprintf($t, mysql_real_escape_string($login));
        $result = $this->action->Select($query);
		return $result;		
	}
			

	/** метод возврощает id текущего пользователя*/
    private function GetUid()
	{	
		// Проверка кеша.
		if ($this->uid != null)
        {
            return $this->uid;            
        }
				
		// Берем по текущей сессии.
		$sid = $this->GetSid();
				
		if ($sid == null)
        {
            return null;           
        }
						
		$t = "SELECT id_user FROM sessions WHERE sid = '%s'";
		$query = sprintf($t, mysql_real_escape_string($sid));
		$result = $this->action->Select($query);
		return $result;	
				
		// Если сессию не нашли - значит пользователь не авторизован.
		if (empty($result))
        {
            return null;           
        }
				
		// Если нашли - запоминм ее.
		$this->uid = $result[0]['id_user'];
		return $this->uid;
	}


	/** метод открывает новую сесию*/
    public function OpenSession($id_user)
	{
		// генерируем SID
		$sid = $this->GenerateStr(10);
				
		// вставляем SID в БД
		$now = date('Y-m-d H:i:s'); 
		$object = array();
        $object['id_user'] = $id_user;
        $object['sid'] = $sid;
        $object['time_start'] = $now;
        $object['time_last'] = $now;
        $result = $this->action->Insert('sessions', $object);
	
		// регистрируем сессию в PHP сессии
		$_SESSION['sid'] = $sid;		
		// возвращаем SID
        return $sid;	
	}


	/** метод возвращает идентификатор текущей сессии*/
    private function GetSid()
	{
		// Проверка кеша.
		if ($this->sid != null)
        {
            return $this->sid;            
        }
			           	
        // Ищем SID в сессии.
        $sid = $_SESSION['sid'];
                   								
		// Если нашли, попробуем обновить time_last в базе. 
		// Заодно и проверим, есть ли сессия там.
		if ($sid != null)
		{
            $now = date('Y-m-d H:i:s');
            $object = array();
            $object['time_last'] = $now;
            $t = "sid = '%s'"; 
		    $where = sprintf($t, mysql_real_escape_string($sid)); 
            $result = $this->action->Update('sessions', $object, $where);
             
			if (!$result)
			{
                $t = " SELECT count(*) FROM sessions WHERE sid = '%s' ";
                $query = sprintf($t, mysql_real_escape_string($sid));
                $result = $this->action->Select($query);
                                		
                if (empty($result))
                {
                    $sid = null;    
                }
                			
			}		
		}		
		
		// Нет сессии? Ищем логин и md5(пароль) в куках.
		// Т.е. пробуем переподключиться.
		if ($sid == null && isset($_COOKIE['login']))
		{
            $user = $this->GetByLogin($_COOKIE['login']);
			
			if ($user != null && $user[0]['password'] == $_COOKIE['pass'])
				$sid = $this->OpenSession($user[0]['id_user']);
		}
		
		// Запоминаем в кеш.
		if ($sid != null)
        {
            $this->sid = $sid;            
        }
					
		// Возвращаем, наконец, SID.
		return $sid;		
	}	


	/** метод генерирует случайную последовательность*/
    private function GenerateStr($length = 10) 
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
		$code = "";
		$clen = strlen($chars) - 1;  

		while (strlen($code) < $length) 
            $code .= $chars[mt_rand(0, $clen)];  

		return $code;
	}


	/** деструктор*/
    function __destruct()
	{
	   
	}

}
  
