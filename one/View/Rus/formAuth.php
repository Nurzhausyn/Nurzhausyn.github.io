<fieldset>
      <legend class="txtFormLegend">����� �����������</legend>
      <br />
      <form name="frmAuth" method="post" action="index.php?c=auth&lang=rus&act=form">
    
        <!-- Loin -->
        <label for="Login">�����:</label>
        <input id="Login" name="Login" type="text"/>
        <span id="LoginFailed"
              class="<?php echo $_SESSION['errors']['Login'] ?>">
          ������� ���� �����. 
        </span>
        <br />
        
        <!-- Password -->
        <label for="Password">������:</label>
        <input id="Password" name="Password" type="password"/>
        <span id="PasswordFailed"
              class="<?php echo $_SESSION['errors']['Password'] ?>">
          ������� ���� ������.
        </span>
        <br /><br /><br />
    
        <!-- End of form -->
        <hr />
        <span class="txtSmall">��������: ��� ���� �����������.</span>
        <br /><br />
        <input type="submit" name="submitbutton" value="�����" 
               class="left button" />
      </form>
</fieldset>