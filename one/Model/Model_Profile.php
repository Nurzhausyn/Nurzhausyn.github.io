<?php
 
/** �������� �������� ������������*/
class Model_Profile
{   
    private $action;            // ������ �� �������
    
    /** �����������*/
    public function __construct()
    {
        $this->action = Model_Driver::Instance();
        
    }

    /** ����� �������� ��� ������ � ������������� ��� ����������� �� � ������� */
    public function select($id_user)
    {
        // � ������ ������ ���������� ������ ������������ �� id_user.
		$t = "SELECT members.login, 
                     birthday.day, birthday.mounth, birthday.year,
                     link.phone, link.mail
              FROM members 
              LEFT JOIN birthday ON members.id_user = birthday.id_user
              LEFT JOIN link ON members.id_user = link.id_user
              WHERE members.id_user = '%d'";
		$query = sprintf($t, $id_user);
        $result = $this->action->Select($query);
		return $result;  
    } 
     
    public function adress($id_user)
    {
        $t="SELECT country.name as country, city.name as city
            FROM adress
            JOIN country ON adress.id_country=country.id_country
            JOIN city ON adress.id_city=city.id_city
            WHERE adress.id_user='%d'";
            
        $query = sprintf($t, $id_user);
        $result = $this->action->Select($query);
        return $result; 
    }
       
    /** ����������*/
    function __destruct()
    {
        
    }
        
}
