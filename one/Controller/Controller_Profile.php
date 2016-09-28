<?php

/** Контроллер страницы пользователя.*/
class Controller_Profile extends Controller_Base
{	
    private $object;
    private $form;
    public $content;
     
	/** Конструктор.*/
	function __construct()
	{
	   parent::__construct();
       $this->needLogin = true;
	}
	
	/** Виртуальный обработчик запроса.*/
	public function OnInput()
	{
        parent::OnInput();
        
        $user = $this->user;
        $action = new Model_Profile;
        //выбрали основные данные 
        $result = $action->select($user[0]['id_user']);
        
        // получаем возраст в годах
        $age = $this->Age($result[0]['day'], $result[0]['mounth'], $result[0]['year']);
        
        //получаем точный адресс
        $adress = $action->adress($user[0]['id_user']);
        
        $this->object = array();
        $this->object['name'] = $result[0]['login'];
        $this->object['age'] = $age;
        $this->object['mail'] = $result[0]['mail'];
        $this->object['phone'] = $result[0]['phone'];
        $this->object['country'] = $adress[0]['country'];
        $this->object['city'] = $adress[0]['city'];	
	}
	
	/** Виртуальный генератор HTML.*/
	public function OnOutput()
	{
	    $vars = array('object' => $this->object);
        $this->form = $this->View('profile.php', $vars);
        $this->content = array('content'=>$this->form);	
        parent::OnOutput();
	}
    
    /** Высчитывает точный возрасть пользователя*/
    private function Age($day, $month, $year)
    {
        $sec = 01; $min = 00; $hour = 00;
        //Теперь вычислим метку Unix для указанной даты
        $birthdate_unix = mktime($hour, $min, $sec, $month, $day, $year);
        //Вычислим метку unix для текущего момента
        $current_unix = time();
        //Просчитаем разность меток
        $period_unix=$current_unix - $birthdate_unix;
        // Получаем искомый возраст,измеряемый годами
        $age_in_years = floor($period_unix / (365*24*60*60));
        
        return  $age_in_years;
    }
}
?>