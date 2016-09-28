<script type="text/javascript">
<!--
var arr = [];
arr[1] = ["New York", "California", "Illinois", "Florida", "Pennsylvania"];
arr[2] = ["Астана", "Алматы", "Отар", "Караганда", "Кокшетау"];
var val = [];
val[1] = ["1", "2", "3", "4", "5"];
val[2] = ["6", "7", "8", "9", "10"];

$(document).ready(function() {
   $("#country").change(function() {
      var index = this.value;
      var count = arr[index].length;
      var el = $("#city").get(0);
      el.length = count;
      for (i=0; i<count; i++) {
         el.options[i].value = val[index][i];
         el.options[i].text = arr[index][i];
      }
   });
     
});
//-->
</script>
<fieldset>
      <legend class="txtFormLegend">Форма Регистрации</legend>
      <br />
      <form name="frmRegistration" method="post" enctype="multipart/form-data"
            action="index.php?c=reg&lang=rus&validationType=php">
      <!-- Логин -->
        <label for="txtLogin">Логин:</label>
        <input id="txtLogin" name="txtLogin"  type="text" 
               onblur="validate(this.value, this.id)" 
               value="<?php echo $_SESSION['values']['txtLogin'] ?>" />
        <span id="txtLoginFailed"
              class="<?php echo $_SESSION['errors']['txtLogin'] ?>">
          Введите свой логин. 
        </span>
        <br />
        
        <!-- Пароль -->
        <label for="txtPassword">Пароль:</label>
        <input id="txtPassword" name="txtPassword" type="password" 
               onblur="validate(this.value, this.id)" 
 
               value="<?php echo $_SESSION['values']['txtPassword'] ?>" />
        <span id="txtPasswordFailed"
              class="<?php echo $_SESSION['errors']['txtPassword'] ?>">
          Введите свой пароль.
        </span>
        <br />
    
        <!-- Дата рождения -->
        <label for="selBthMonth">Месяц:</label>
        
        <!-- Месяц -->
        <select name="selBthMonth" id="selBthMonth" onblur="validate(this.value, this.id)">
                <option value="0">[Select]</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
        </select>
         <br />
         
        <!-- День -->
        <label for="txtBthDay">День:</label>        
        <input type="text" name="txtBthDay" id="txtBthDay" maxlength="2" 
               size="2" 
               onblur="validate(this.value, this.id)" 
               value="<?php echo $_SESSION['values']['txtBthDay'] ?>" />          
         <br /> 
               
        <!-- Год -->
        <label for="txtBthYear">Год:</label> 
        <input type="text" name="txtBthYear" id="txtBthYear" maxlength="4" 
               size="2" onblur="validate(document.getElementById('selBthMonth').options[document.getElementById('selBthMonth').selectedIndex].value + '#' + document.getElementById('txtBthDay').value + '#' + this.value, this.id)" 
               value="<?php echo $_SESSION['values']['txtBthYear'] ?>" />
        
        <!-- Месяц, День, Год -->
        <span id="selBthMonthFailed"
              class="<?php echo $_SESSION['errors']['selBthMonth'] ?>">
          Выберите месяц рождения. 
        </span>
        <span id="txtBthDayFailed"
              class="<?php echo $_SESSION['errors']['txtBthDay'] ?>">
          Выберите день рождения. 
        </span>
        <span id="txtBthYearFailed"
              class="<?php echo $_SESSION['errors']['txtBthYear'] ?>">
          Выберите год рождения /  Только  для совершеннолетних
        </span>
        <br />
        
        <!-- Страна -->
        <label for="country">Страна:</label>
        <select id="country" size="1" name="country" onblur="validate(this.value, this.id)">
            <option value="0" selected> ******* </option>
            <option value="1">Usa</option>
            <option value="2">Казахстан</option>
        </select><br/>
        
        <!-- Город -->
        <label for="city">Город:</label>
        <select id="city" name="city" onblur="validate(this.value, this.id)" >
            <option value=""> ************* </option>
        </select><br/>
        
        <!-- Страна, Город -->
        <span id="countryFailed"
              class="<?php echo $_SESSION['errors']['country'] ?>">
          Выберите страну проживания. 
        </span>
        <span id="cityFailed"
              class="<?php echo $_SESSION['errors']['city'] ?>">
          Выберите город проживания. 
        </span>
        
        
        
        <!-- Мейл -->
        <label for="txtEmail">Эл. почта:</label>
        <input id="txtEmail" name="txtEmail" type="text" 
               onblur="validate(this.value, this.id)" 
               value="<?php echo $_SESSION['values']['txtEmail'] ?>" />
        <span id="txtEmailFailed"
              class="<?php echo $_SESSION['errors']['txtEmail'] ?>">
          Неправильный адресс эл. почты.
        </span>
        <br />
        
        <!-- Телефон -->
        <label for="txtPhone">Телефон:</label>
        <input id="txtPhone" name="txtPhone" type="text" 
               onblur="validate(this.value, this.id)" 
               value="<?php echo $_SESSION['values']['txtPhone'] ?>" />
        <span id="txtPhoneFailed"
              class="<?php echo $_SESSION['errors']['txtPhone'] ?>">
          Введит номер телефона в форме (xxx-xxx-xxxx). 
        </span>
        <br />
          
          
        <br /><br /><br />
        <!-- Подтверждени принятия правил -->
        <input type="checkbox" id="chkReadTerms" name="chkReadTerms" 
               onblur="validate(this.checked, this.id)" 
               <?php if ($_SESSION['values']['chkReadTerms'] == 'on') 
                     echo 'checked="checked"' ?> /> 
        Я старше 8 лет
        <span id="chkReadTermsFailed"
              class="<?php echo $_SESSION['errors']['chkReadTerms'] ?>">
          Подтвердите что вы принимаете условия. 
        </span>
        
        <!-- Конец формы-->
        <hr />
        <span class="txtSmall">Внимание: Все поля обязательны.</span>
        <br /><br />
        <input type="submit" name="submitbutton" value="Регистрация" 
               class="left button" />
      </form>
</fieldset>