<script type="text/javascript">
<!--
var arr = [];
arr[1] = ["New York", "California", "Illinois", "Florida", "Pennsylvania"];
arr[2] = ["������", "������", "����", "���������", "��������"];
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
      <legend class="txtFormLegend">����� �����������</legend>
      <br />
      <form name="frmRegistration" method="post" enctype="multipart/form-data"
            action="index.php?c=reg&lang=rus&validationType=php">
      <!-- ����� -->
        <label for="txtLogin">�����:</label>
        <input id="txtLogin" name="txtLogin"  type="text" 
               onblur="validate(this.value, this.id)" 
               value="<?php echo $_SESSION['values']['txtLogin'] ?>" />
        <span id="txtLoginFailed"
              class="<?php echo $_SESSION['errors']['txtLogin'] ?>">
          ������� ���� �����. 
        </span>
        <br />
        
        <!-- ������ -->
        <label for="txtPassword">������:</label>
        <input id="txtPassword" name="txtPassword" type="password" 
               onblur="validate(this.value, this.id)" 
 
               value="<?php echo $_SESSION['values']['txtPassword'] ?>" />
        <span id="txtPasswordFailed"
              class="<?php echo $_SESSION['errors']['txtPassword'] ?>">
          ������� ���� ������.
        </span>
        <br />
    
        <!-- ���� �������� -->
        <label for="selBthMonth">�����:</label>
        
        <!-- ����� -->
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
         
        <!-- ���� -->
        <label for="txtBthDay">����:</label>        
        <input type="text" name="txtBthDay" id="txtBthDay" maxlength="2" 
               size="2" 
               onblur="validate(this.value, this.id)" 
               value="<?php echo $_SESSION['values']['txtBthDay'] ?>" />          
         <br /> 
               
        <!-- ��� -->
        <label for="txtBthYear">���:</label> 
        <input type="text" name="txtBthYear" id="txtBthYear" maxlength="4" 
               size="2" onblur="validate(document.getElementById('selBthMonth').options[document.getElementById('selBthMonth').selectedIndex].value + '#' + document.getElementById('txtBthDay').value + '#' + this.value, this.id)" 
               value="<?php echo $_SESSION['values']['txtBthYear'] ?>" />
        
        <!-- �����, ����, ��� -->
        <span id="selBthMonthFailed"
              class="<?php echo $_SESSION['errors']['selBthMonth'] ?>">
          �������� ����� ��������. 
        </span>
        <span id="txtBthDayFailed"
              class="<?php echo $_SESSION['errors']['txtBthDay'] ?>">
          �������� ���� ��������. 
        </span>
        <span id="txtBthYearFailed"
              class="<?php echo $_SESSION['errors']['txtBthYear'] ?>">
          �������� ��� �������� /  ������  ��� ����������������
        </span>
        <br />
        
        <!-- ������ -->
        <label for="country">������:</label>
        <select id="country" size="1" name="country" onblur="validate(this.value, this.id)">
            <option value="0" selected> ******* </option>
            <option value="1">Usa</option>
            <option value="2">���������</option>
        </select><br/>
        
        <!-- ����� -->
        <label for="city">�����:</label>
        <select id="city" name="city" onblur="validate(this.value, this.id)" >
            <option value=""> ************* </option>
        </select><br/>
        
        <!-- ������, ����� -->
        <span id="countryFailed"
              class="<?php echo $_SESSION['errors']['country'] ?>">
          �������� ������ ����������. 
        </span>
        <span id="cityFailed"
              class="<?php echo $_SESSION['errors']['city'] ?>">
          �������� ����� ����������. 
        </span>
        
        
        
        <!-- ���� -->
        <label for="txtEmail">��. �����:</label>
        <input id="txtEmail" name="txtEmail" type="text" 
               onblur="validate(this.value, this.id)" 
               value="<?php echo $_SESSION['values']['txtEmail'] ?>" />
        <span id="txtEmailFailed"
              class="<?php echo $_SESSION['errors']['txtEmail'] ?>">
          ������������ ������ ��. �����.
        </span>
        <br />
        
        <!-- ������� -->
        <label for="txtPhone">�������:</label>
        <input id="txtPhone" name="txtPhone" type="text" 
               onblur="validate(this.value, this.id)" 
               value="<?php echo $_SESSION['values']['txtPhone'] ?>" />
        <span id="txtPhoneFailed"
              class="<?php echo $_SESSION['errors']['txtPhone'] ?>">
          ������ ����� �������� � ����� (xxx-xxx-xxxx). 
        </span>
        <br />
          
          
        <br /><br /><br />
        <!-- ������������ �������� ������ -->
        <input type="checkbox" id="chkReadTerms" name="chkReadTerms" 
               onblur="validate(this.checked, this.id)" 
               <?php if ($_SESSION['values']['chkReadTerms'] == 'on') 
                     echo 'checked="checked"' ?> /> 
        � ������ 8 ���
        <span id="chkReadTermsFailed"
              class="<?php echo $_SESSION['errors']['chkReadTerms'] ?>">
          ����������� ��� �� ���������� �������. 
        </span>
        
        <!-- ����� �����-->
        <hr />
        <span class="txtSmall">��������: ��� ���� �����������.</span>
        <br /><br />
        <input type="submit" name="submitbutton" value="�����������" 
               class="left button" />
      </form>
</fieldset>