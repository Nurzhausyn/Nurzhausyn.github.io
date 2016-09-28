<?php

/** �������� �����*/
class Model_Session           
{	
	private $sid;				// ������������� ������� ������
	private $uid;				// ������������� �������� ������������
	private $action;            // ������ �� �������
    
    /** �����������*/
    public function __construct()
    {
        $this->action = Model_Driver::Instance();
        $this->sid = null;
		$this->uid = null;   
    }

    	

	/** ����� ������� �������������� ������*/
    public function ClearSessions()
	{
		$min = date('Y-m-d H:i:s', time() - 60 * 20); 			
		$t = "time_last < '%s'";
		$where = sprintf($t, $min);
        $this->action->Delete('sessions', $where);
	}
							

	/** ����� ���������� ������������*/
	public function Get($id_user = null)
	{	
		// ���� id_user �� ������, ����� ��� �� ������� ������.
		if ($id_user == null)
        {
            $id_user = $this->GetUid();            
        }			
			
		if ($id_user == null)
        {
            return null;            
        }
					
		// � ������ ������ ���������� ������������ �� id_user.
		$t = "SELECT * FROM members WHERE id_user = '%d'";
		$query = sprintf($t, $id_user[0]['id_user']);
        $result = $this->action->Select($query);
		return $result;		
	}
	
     /** ����� ���������� ������������ �� ������*/
	private function GetByLogin($login)
	{	
		$t = "SELECT * FROM members WHERE login = '%s'";
		$query = sprintf($t, mysql_real_escape_string($login));
        $result = $this->action->Select($query);
		return $result;		
	}
			

	/** ����� ���������� id �������� ������������*/
    private function GetUid()
	{	
		// �������� ����.
		if ($this->uid != null)
        {
            return $this->uid;            
        }
				
		// ����� �� ������� ������.
		$sid = $this->GetSid();
				
		if ($sid == null)
        {
            return null;           
        }
						
		$t = "SELECT id_user FROM sessions WHERE sid = '%s'";
		$query = sprintf($t, mysql_real_escape_string($sid));
		$result = $this->action->Select($query);
		return $result;	
				
		// ���� ������ �� ����� - ������ ������������ �� �����������.
		if (empty($result))
        {
            return null;           
        }
				
		// ���� ����� - �������� ��.
		$this->uid = $result[0]['id_user'];
		return $this->uid;
	}


	/** ����� ��������� ����� �����*/
    public function OpenSession($id_user)
	{
		// ���������� SID
		$sid = $this->GenerateStr(10);
				
		// ��������� SID � ��
		$now = date('Y-m-d H:i:s'); 
		$object = array();
        $object['id_user'] = $id_user;
        $object['sid'] = $sid;
        $object['time_start'] = $now;
        $object['time_last'] = $now;
        $result = $this->action->Insert('sessions', $object);
	
		// ������������ ������ � PHP ������
		$_SESSION['sid'] = $sid;		
		// ���������� SID
        return $sid;	
	}


	/** ����� ���������� ������������� ������� ������*/
    private function GetSid()
	{
		// �������� ����.
		if ($this->sid != null)
        {
            return $this->sid;            
        }
			           	
        // ���� SID � ������.
        $sid = $_SESSION['sid'];
                   								
		// ���� �����, ��������� �������� time_last � ����. 
		// ������ � ��������, ���� �� ������ ���.
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
		
		// ��� ������? ���� ����� � md5(������) � �����.
		// �.�. ������� ����������������.
		if ($sid == null && isset($_COOKIE['login']))
		{
            $user = $this->GetByLogin($_COOKIE['login']);
			
			if ($user != null && $user[0]['password'] == $_COOKIE['pass'])
				$sid = $this->OpenSession($user[0]['id_user']);
		}
		
		// ���������� � ���.
		if ($sid != null)
        {
            $this->sid = $sid;            
        }
					
		// ����������, �������, SID.
		return $sid;		
	}	


	/** ����� ���������� ��������� ������������������*/
    private function GenerateStr($length = 10) 
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
		$code = "";
		$clen = strlen($chars) - 1;  

		while (strlen($code) < $length) 
            $code .= $chars[mt_rand(0, $clen)];  

		return $code;
	}


	/** ����������*/
    function __destruct()
	{
	   
	}

}
  
