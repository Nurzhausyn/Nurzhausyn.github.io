<?php

/** Контроллер страницы авторизации.*/
class Controller_Auth extends Controller_Base
{	
    private $form;
    public $content;
    
    
	/** Конструктор.*/
	function __construct()
	{
	   parent::__construct();
	}
	
	/** Виртуальный обработчик запроса.*/
	protected function OnInput()
	{
        parent::OnInput();
        
    	if (isset($_GET['act']))
    	{
            if(isset($_POST['Login']) && isset($_POST['Password']))
            {
                $login = $this->sanitizeString($_POST['Login']);
                $password = $this->sanitizeString($_POST['Password']);
                
                $action = new Model_Auth;
                $action->auth($login, $password);	
            }
    	}
		else
		{
	        //страница авторизации также являеться страницей выхода
            $action = new Model_Auth;
            $action->Logout();	
		}  	
	}
	
	/** Виртуальный генератор HTML.*/
	protected function OnOutput()
	{
	    $this->form = $this->View('formAuth.php');
        $this->content = array('content' => $this->form);	
        parent::OnOutput();
	}
    
    /** Метод проводит первичную обработку данных */
    private function sanitizeString($value)
    {
        $var = strip_tags($value);
	    $var = stripslashes($value);
	    return $value;
    }
}
