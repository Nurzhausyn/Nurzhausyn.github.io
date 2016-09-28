<?php
/** сценарий который принимает запросы от js сценария,
 * отправляет их менеджеру который отвечает за обработку
 * и возврощает ответ в виде xml документа */
     
include_once('Model/Model_User.php');
include_once('Model/Model_Driver.php');
// Получаем данные
if (isset($_POST['inputValue']) && isset($_POST['fieldID']))
{
    $validator  = new Model_User;
    $response = 
   '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>' .
   '<response>' .
     '<result>' .
       $validator->ValidateAJAX($_POST['inputValue'], $_POST['fieldID']) .
     '</result>' .
     '<fieldid>' .
       $_POST['fieldID'] .  
     '</fieldid>' .
   '</response>'; 
  // generate the response
  if(ob_get_length()) ob_clean();
  header('Content-Type: text/xml');
  echo $response;
    
}

?>