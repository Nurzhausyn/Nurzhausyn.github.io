<?php

/** менеджер  осуществляет проверку данных и регистрирует новых пользователей*/
class Model_User
{
    private $action;// ссылка на драйвер
    
    /** Конструктор*/
    public function __construct()
    {
        $this->action = Model_Driver::Instance();
        
    }
            
    /** метод проверяет единственное значение данные получает по технологии AJAX
    * от сценария на стороне клиента написаного на js */
    public function ValidateAJAX($inputValue, $fieldID)
    {
        // уточнить, какое поле будет проверяться и выполнить проверку
        switch($fieldID)
        {
            
        // проверить правильность имени
            case 'txtLogin':
            return $this->validateLogin($inputValue);
            break;
        
       // проверить правильность фамилии
            case 'txtPassword':
                return $this->validatePass($inputValue);
                break;
        
      // проверить, выбран ли месяц рождения
           case 'selBthMonth':
               return $this->validateBirthMonth($inputValue);
               break;
                
      //проверить, выбран ли день рождения
           case 'txtBthDay':
              return $this->validateBirthDay($inputValue);
              break;       
        
      //проверить, выбран ли год рождения
           case 'txtBthYear':
              return $this->validateBirthYear($inputValue);
              break;
              
      //проверить, выбрана ли страна
           case 'country':
              return $this->validateCountry($inputValue);
              break; 
              
      //проверить, выбран ли город
           case 'city':
              return $this->validateCity($inputValue);
              break;                 
          
      //проверить, правильноть адресса эл. почты
           case 'txtEmail':
              return $this->validateEmail($inputValue);
              break;
      // проверить телефон
           case 'txtPhone':
              return $this->validatePhone($inputValue);
              break;       
              
      //проверить, принял ли пользователь условия
           case 'chkReadTerms':
              return $this->validateReadTerms($inputValue);
              break;        
          
      }
   }
     
    /** метод проверяет правильность заполнения всех полей формы*/
    public function ValidatePHP()
    {
        // признак ошибки, если будет найдена ошибка, в переменную
        // будет записано значение 1.
        $errorsExist = 0;
        // сбросить флаг errors сессии   
        if (isset($_SESSION['errors']))
        {
           unset($_SESSION['errors']); 
        }
           
        // по умолчанию все поля считаются правильными
        $_SESSION['errors']['txtLogin'] = 'hidden';
        $_SESSION['errors']['txtPassword'] = 'hidden';
        $_SESSION['errors']['selBthMonth'] = 'hidden';
        $_SESSION['errors']['txtBthDay'] = 'hidden';
        $_SESSION['errors']['txtBthYear'] = 'hidden';
        $_SESSION['errors']['country'] = 'hidden';
        $_SESSION['errors']['city'] = 'hidden';
        $_SESSION['errors']['txtEmail'] = 'hidden';
        $_SESSION['errors']['txtPhone'] = 'hidden';
        $_SESSION['errors']['chkReadTerms'] = 'hidden';
        $_SESSION['errors']['Login'] = 'hidden';
        $_SESSION['errors']['Password'] = 'hidden';
        $_SESSION['errors']['onlyEighteen'] = 'hidden';

        // проверить логин
        if (!$this->validateLogin($_POST['txtLogin']))
        {
            $_SESSION['errors']['txtUsername'] = 'error';
            $errorsExist = 1;
        }

        // проверить пароль
        if (!$this->validatePass($_POST['txtPassword']))
        {
            $_SESSION['errors']['txtName'] = 'error';
            $errorsExist = 1;
        }


        // проверить месяц рождения
        if (!$this->validateBirthMonth($_POST['selBthMonth']))
        {
            $_SESSION['errors']['selBthMonth'] = 'error';
            $errorsExist = 1;
        }

        // проверить день рождения
        if (!$this->validateBirthDay($_POST['txtBthDay']))
        {
            $_SESSION['errors']['txtBthDay'] = 'error';
            $errorsExist = 1;
        }

        // проверить дату рождения
        if (!$this->validateBirthYear($_POST['selBthMonth'] . '#' . 
                                      $_POST['txtBthDay'] . '#' . 
                                      $_POST['txtBthYear']))
        {
            $_SESSION['errors']['txtBthYear'] = 'error';
            $errorsExist = 1;
        }
         
        // проверить поле страна
        if (!$this->validateCountry($_POST['country']))
        {
            $_SESSION['errors']['country'] = 'error';
            $errorsExist = 2;
        }
        
        // проверить поле город
        if (!$this->validateCity($_POST['city']))
        {
            $_SESSION['errors']['city'] = 'error';
            $errorsExist = 2;
        }
        
        // проверить адрес эл. почты
        if (!$this->validateEmail($_POST['txtEmail']))
        {
            $_SESSION['errors']['txtEmail'] = 'error';
            $errorsExist = 1;
        }
        
        // проверить телефон
        if (!$this->validatePhone($_POST['txtPhone']))
        {
            $_SESSION['errors']['txtPhone'] = 'error';
            $errorsExist = 1;
        }


        // проверить принял пользователь условия или нет
        if (!isset($_POST['chkReadTerms']) || 
        !$this->validateReadTerms($_POST['chkReadTerms']))
        {
            $_SESSION['errors']['chkReadTerms'] = 'error';
            $_SESSION['values']['chkReadTerms'] = '';
            $errorsExist = 1;
        }
        
        // проверить проходит ли пользователь возрастное ограничение
        if (!$this->validateAge($_POST['txtBthDay'], $_POST['selBthMonth'],  $_POST['txtBthYear']))
        {
            $_SESSION['errors']['txtBthYear'] = 'error';
            $errorsExist = 2;
        }

        // если ошибок не обнаружено, зарегистрировать 
        // и отправить на страницу авторизации
        if ($errorsExist == 0)
        {
            $check = $_POST['chkReadTerms'];
            $phone = $_POST['txtPhone'];
            $mail = $_POST['txtEmail'];
            $year = $_POST['txtBthYear'];
            $day = $_POST['txtBthDay'];
            $country = $_POST['country'];
            $city = $_POST['city'];
            $month = $_POST['selBthMonth'];
            $password = $_POST['txtPassword'];
            $login = $_POST['txtLogin'];      
            $this->newUser($login, $password, $month, $day, $year, $country, $city, $mail, $phone);
            
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
        elseif($errorsExist == 1)
        {
            // если были найдены ошибки, сохранить данные
            // введенные пользователем
            foreach ($_POST as $key => $value)
            {
                $_SESSION['values'][$key] = $_POST[$key];
            }
            
            $path = VIEW_LOCATION;
            if($path == 'View/Rus')
            {
                $path = 'rus';
            }
            else
            {
                $path = 'eng';
            }
            
            header("Location: index.php?c=reg&lang=".$path);
	        die();
        }
        else
        {
            $_SESSION['values']['txtBthYear'] = '';
            $_SESSION['values']['city'] = '';
        }
        
    }

    /** метод добавляет нового пользователя и все данные о нем*/
    private function newUser($login, $password, $month, $day, $year, $country, $city, $mail, $phone)
    {        
        //таблица members
        $token = $this->cryptPass($password);
        $object = array();
        $object['login'] = $login;
        $object['password'] = $token;
        $id_user = $this->action->Insert('members', $object);
        
        // таблица birthday
        $object = array();
        $object['id_user'] = $id_user;
        $object['day'] = $day;
        $object['mounth'] = $month;
        $object['year'] = $year;
        $result = $this->action->Insert('birthday', $object);
        
        // таблица adress
        $object = array();
        $object['id_user'] = $id_user;
        $object['id_country'] = $country;
        $object['id_city'] = $city;
        $result = $this->action->Insert('adress', $object);
        
        // таблица link
        $object = array();
        $object['id_user'] = $id_user;
        $object['mail'] = $mail;
        $object['phone'] = $phone;
        $result = $this->action->Insert('link', $object);
               
    }
    
    /** метод проверяет имя пользователя*/
    private function validateLogin($value)
    {
        $value = $this->sanitizeString($value);
        
        // поле не должно быть пустым
        if ($value == null) return 0; // не правильно
        // проверить наличие такого пользователя в базе данных
        
        $t = "SELECT id_user FROM members WHERE login='%s' ";
        $query = sprintf($t, mysql_real_escape_string($value));
        $result = $this->action->Select($query);
        
        if(!empty($result))
        {
            return '0'; // не правильно
        }
        else
        {
           return '1'; // правильно 
        }
         
    }

    /** метод проверяет пароль*/
    private function validatePass($value)
    {
        $value = $this->sanitizeString($value);
        
        // удаление пробелов впереди и сзади
        $value = trim($value);
        // поле не должно быть пустым
        if ($value)
        {
           return 1; // правильно 
        }  
        else
        {
            return 0; // не правильно
        }  
    }
     
    /** метод проверяет месяц рождения*/
    private function validateBirthMonth($value)
    {
        $value = $this->sanitizeString($value);
        
        return ($value == '' || $value > 12 || $value < 1) ? 0 : 1;
    }
      
    /** метод проверяет  день рождения */
    private function validateBirthDay($value)
    {
        $value = $this->sanitizeString($value);
        
        return ($value == '' || $value > 31 || $value < 1) ? 0 : 1;
    }
    
    /** метод проверяет дату рождения */
    private function validateBirthYear($value)
    {
        $value = $this->sanitizeString($value);
        
        $date = explode('#', $value);  
        if (!$date[0]) return 0;
        if (!$date[1] || !is_numeric($date[1])) return 0;
        if (!$date[2] || !is_numeric($date[2])) return 0;
        return (checkdate($date[0], $date[1], $date[2])) ? 1 : 0;
    }

    /** метод проверяет разрешен ли доступ пользователю по возрастному ограничению*/
    private function validateAge($day, $month,  $year)
    {
        if($day =='')  $day = 0;  
        if($year =='') $year = 0;  

        $sec = 01; $min = 00; $hour = 00;
       //Теперь вычислим метку Unix для указанной даты
        $birthdate_unix = mktime($hour, $min, $sec, $month, $day, $year);
        //Вычислим метку unix для текущего момента
        $current_unix = time();
        //Просчитаем разность меток
        $period_unix=$current_unix - $birthdate_unix;
        // Получаем искомый возраст,измеряемый годами
        $age_in_years = floor($period_unix / (365*24*60*60));
       
        return ($age_in_years < 8)? 0 : 1;   
       
    }
    
    /** метод проверяет выбрана ли страна*/
    private function validateCountry($value)
    {
        $value = $this->sanitizeString($value);
        
        if ($value !=0)
        {
           return 1; // правильно 
        }  
        else
        {
            return 0; // не правильно
        }  
    }
    
    /** метод проверяет выбран ли город*/
    private function validateCity($value)
    {
        $value = $this->sanitizeString($value);
        
        if ($value !='')
        {
           return 1; // правильно 
        }  
        else
        {
            return 0; // не правильно
        }  
    }
    
    /** метод проверяет адрес электронной почты*/
    private function validateEmail($value)
    {
    
        $value = $this->sanitizeString($value);
        
        if ($value == "") return "0";
          else if (!((strpos($value, ".") > 0) &&
        	         (strpos($value, "@") > 0)) ||
        	         preg_match("/[^a-zA-Z0-9.@_-]/", $value))
          return "0";
        return "1";
    
    }
    
    /** проверка телефона*/
    private function validatePhone($value)
    {
        $value = $this->sanitizeString($value);
        
        // формат: ###-###-#### 
        if ($value == "") return "0";
        else  return (! preg_match_all("/([0-9]{3})-([0-9]{3})-([0-9]{3})/", $value, $test)) ? 0 : 1;
     
    }
    
    /** метод проверяет принял ли пользователь условия*/
    private function validateReadTerms($value)
    {        
        $value = $this->sanitizeString($value);
        
        // правильное значение 'true'
        return ($value == 'true' || $value == 'on') ? 1 : 0;
    }
    
    
    /** Метод проводит первичную обработку данных */
    private function sanitizeString($value)
    {
        $var = strip_tags($value);
	    $var = stripslashes($value);
	    return $value;
    }
    
    /** метод хеширования пароля*/
    private function cryptPass($pass)
    {
        $salt1 = "qm&h*";
		$salt2 = "pg!@";
		$result = md5("$salt1$pass$salt2");
        return $result;
    }    
                
         
    /** деструктор*/
    function __destruct()
    {
      
    }
        
}
