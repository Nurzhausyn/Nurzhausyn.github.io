<fieldset>
      <legend class="txtFormLegend">Authorisation Form</legend>
      <br />
      <form name="frmAuth" method="post" action="index.php?c=auth&act=form">
    
        <!-- Loin -->
        <label for="Login">Login:</label>
        <input id="Login" name="Login" type="text"/>
        <span id="LoginFailed"
              class="<?php echo $_SESSION['errors']['Login'] ?>">
          Please enter your login. 
        </span>
        <br />
        
        <!-- Password -->
        <label for="Password">Password:</label>
        <input id="Password" name="Password" type="password"/>
        <span id="PasswordFailed"
              class="<?php echo $_SESSION['errors']['Password'] ?>">
          Please enter your password.
        </span>
        <br /><br /><br />
    
        <!-- End of form -->
        <hr />
        <span class="txtSmall">Note: All fields are required.</span>
        <br /><br />
        <input type="submit" name="submitbutton" value="Submit" 
               class="left button" />
      </form>
</fieldset>