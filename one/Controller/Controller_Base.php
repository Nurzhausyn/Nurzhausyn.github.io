<?php

/** Базовый класс контроллера.*/
abstract class Controller_Base
{
    private $start_time;	// время начала генерации страницы
    protected $needLogin;	// необходимость авторизации , чтобы закрыть неавторизованный доступ к странице 
                            // надо присвоить значение true в конструкторе котнроллера нужной страницы
    protected $user;		// авторизованный пользователь 

    /** Конструктор.*/
	function __construct()
	{
	   $this->needLogin = false;
	   $this->user = null;	 
	}
	
    /** Полная обработка HTTP запроса.*/
	public function Request()
	{
        $this->OnInput();
		$this->OnOutput();
	}
	
    /** Виртуальный обработчик запроса.  */
	protected function OnInput()
	{
	   // Очистка старых сессий и определение текущего пользователя.
		$action = new Model_Session;		
		$action->ClearSessions();		
		$this->user = $action->Get();

		// Перенаправление на страницу авторизации, если это необходимо.
		if ($this->user == null && $this->needLogin)
		{       	
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
        
        $this->start_time = microtime(true);
	}
	
	
    /** Виртуальный генератор HTML.*/	
	protected function OnOutput()
	{
	   // Основной шаблон всех страниц.		
		$page = $this->View('template.php', $this->content);				
		// Время обработки запроса.
        $time = microtime(true) - $this->start_time;        
        $page .= "<!-- Время генерации страницы: $time сек.-->";
        
		// Вывод HTML.
        echo $page;
	   
	}
	
    /** Генерация HTML шаблона в строку.*/
	protected function View($fileName, $vars = array())
	{
		$path = VIEW_LOCATION;
        foreach ($vars as $k => $v) 
		$$k = $v;
	
		ob_start(); 
		include "$path/$fileName"; 
		return ob_get_clean(); 	
	}	
}
