<?php

/** Контроллер страницы регистрации.*/
class Controller_Reg extends Controller_Base
{	
    private $must;
    private $form;
    public $content;
    
    
	/** Конструктор.*/
	function __construct()
	{
	   parent::__construct();
	}
	
	/** Виртуальный обработчик запроса.*/
	public function OnInput()
	{
        parent::OnInput();
        
    	if (isset($_GET['validationType']))
    	{
            $validator  = new Model_User;
            $validator->ValidatePHP();
    	} 	
	}
	
	/** Виртуальный генератор HTML.*/
	public function OnOutput()
	{
        $vars = array('must' => $this->must);
        $this->form = $this->View('formReg.php', $vars);
        $this->content = array('content' => $this->form);	
        parent::OnOutput();
	}
    
}
?>