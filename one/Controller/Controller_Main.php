<?php
 
/** ���������� �������� ��������.*/
class Controller_Main extends Controller_Base
{	    
	/** �����������.*/
	function __construct()
	{
	   parent::__construct();
	}
	
	/** ����������� ���������� �������.*/
	protected function OnInput()
	{
        parent::OnInput();
		
		$user = $this->user;
		 $action = new Model_Profile;
        //������� �������� ������ 
        $result = $action->select($user[0]['id_user']);
		 $adress = $action->adress($user[0]['id_user']);
		  $this->object = array();
          $this->object['name'] = $result[0]['login'];
	}
	
	/** ����������� ��������� HTML.*/
	protected function OnOutput()
	{
        $vars = array('object' => $this->object);
        $this->form = $this->View('', $vars);
        $this->content = array('content'=>$this->form);	
	    parent::OnOutput();
	}
}
?>