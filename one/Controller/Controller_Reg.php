<?php

/** ���������� �������� �����������.*/
class Controller_Reg extends Controller_Base
{	
    private $must;
    private $form;
    public $content;
    
    
	/** �����������.*/
	function __construct()
	{
	   parent::__construct();
	}
	
	/** ����������� ���������� �������.*/
	public function OnInput()
	{
        parent::OnInput();
        
    	if (isset($_GET['validationType']))
    	{
            $validator  = new Model_User;
            $validator->ValidatePHP();
    	} 	
	}
	
	/** ����������� ��������� HTML.*/
	public function OnOutput()
	{
        $vars = array('must' => $this->must);
        $this->form = $this->View('formReg.php', $vars);
        $this->content = array('content' => $this->form);	
        parent::OnOutput();
	}
    
}
?>