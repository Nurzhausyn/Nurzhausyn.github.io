<?php
 
/** Контроллер главвной страницы.*/
class Controller_Main extends Controller_Base
{	    
	/** Конструктор.*/
	function __construct()
	{
	   parent::__construct();
	}
	
	/** Виртуальный обработчик запроса.*/
	protected function OnInput()
	{
        parent::OnInput();
		
		$user = $this->user;
		 $action = new Model_Profile;
        //выбрали основные данные 
        $result = $action->select($user[0]['id_user']);
		 $adress = $action->adress($user[0]['id_user']);
		  $this->object = array();
          $this->object['name'] = $result[0]['login'];
	}
	
	/** Виртуальный генератор HTML.*/
	protected function OnOutput()
	{
        $vars = array('object' => $this->object);
        $this->form = $this->View('', $vars);
        $this->content = array('content'=>$this->form);	
	    parent::OnOutput();
	}
}
?>