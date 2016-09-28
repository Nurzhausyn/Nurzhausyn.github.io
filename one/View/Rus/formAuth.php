<fieldset>
      <legend class="txtFormLegend">Форма Авторизации</legend>
      <br />
      <form name="frmAuth" method="post" action="index.php?c=auth&lang=rus&act=form">
    
        <!-- Loin -->
        <label for="Login">Логин:</label>
        <input id="Login" name="Login" type="text"/>
        <span id="LoginFailed"
              class="<?php echo $_SESSION['errors']['Login'] ?>">
          Введите свой логин. 
        </span>
        <br />
        
        <!-- Password -->
        <label for="Password">Пароль:</label>
        <input id="Password" name="Password" type="password"/>
        <span id="PasswordFailed"
              class="<?php echo $_SESSION['errors']['Password'] ?>">
          Введите свой пароль.
        </span>
        <br /><br /><br />
    
        <!-- End of form -->
        <hr />
        <span class="txtSmall">Внимание: Все поля обязательны.</span>
        <br /><br />
        <input type="submit" name="submitbutton" value="Войти" 
               class="left button" />
      </form>
</fieldset>