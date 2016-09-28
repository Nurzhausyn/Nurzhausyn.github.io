<script type="text/javascript">
<!--
var arr = [];
arr[1] = ["New York", "California", "Illinois", "Florida", "Pennsylvania"];
arr[2] = ["Astana", "Almaty", "Otar", "Karaganda", "Kokshetau"];
var val = [];
val[1] = ["1", "2", "3", "4", "5"];
val[2] = ["6", "7", "8", "9", "10"];

$(document).ready(function() {
   // Взаимосвязанные списки
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
      <legend class="txtFormLegend">New User Registration Form</legend>
      <br />
      <form name="frmRegistration" method="post" enctype="multipart/form-data"
            action="index.php?c=reg&validationType=php">        
        <!--Login -->
        <label for="txtLogin">Login:</label>
        <input id="txtLogin" name="txtLogin"  type="text" 
               onblur="validate(this.value, this.id)" 
               value="<?php echo $_SESSION['values']['txtLogin'] ?>" />
        <span id="txtLoginFailed"
              class="<?php echo $_SESSION['errors']['txtLogin'] ?>">
          Please enter your login. 
        </span>
        <br />
        
        <!-- Password -->
        <label for="txtPassword">Password:</label>
        <input id="txtPassword" name="txtPassword" type="password" 
               onblur="validate(this.value, this.id)" 
 
               value="<?php echo $_SESSION['values']['txtPassword'] ?>" />
        <span id="txtPasswordFailed"
              class="<?php echo $_SESSION['errors']['txtPassword'] ?>">
          Please enter your password.
        </span>
        <br />
    
        <!-- Birthday -->
        <label for="selBthMonth">Month:</label>
        
        <!-- Month -->
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
         
        <!-- Day -->
        <label for="txtBthDay">Day:</label>        
        <input type="text" name="txtBthDay" id="txtBthDay" maxlength="2" 
               size="2" 
               onblur="validate(this.value, this.id)" 
               value="<?php echo $_SESSION['values']['txtBthDay'] ?>" />          
         <br /> 
               
        <!-- Year -->
        <label for="txtBthYear">Year:</label> 
        <input type="text" name="txtBthYear" id="txtBthYear" maxlength="4" 
               size="2" onblur="validate(document.getElementById('selBthMonth').options[document.getElementById('selBthMonth').selectedIndex].value + '#' + document.getElementById('txtBthDay').value + '#' + this.value, this.id)" 
               value="<?php echo $_SESSION['values']['txtBthYear'] ?>" />
        
        <!-- Month, Day, Year validation -->
        <span id="selBthMonthFailed"
              class="<?php echo $_SESSION['errors']['selBthMonth'] ?>">
          Please select your birth month. 
        </span>
        <span id="txtBthDayFailed"
              class="<?php echo $_SESSION['errors']['txtBthDay'] ?>">
          Please enter your birth day. 
        </span>
        <span id="txtBthYearFailed"
              class="<?php echo $_SESSION['errors']['txtBthYear'] ?>">
          Please enter a valid date, or Only to persons older than 8
        </span>
        <br />
        
        <!-- Country -->
        <label for="country">Country:</label>
        <select id="country" size="1" name="country" onblur="validate(this.value, this.id)">
            <option value="0" selected> ******* </option>
            <option value="1">Usa</option>
            <option value="2">Kazakhstan</option>
        </select><br/>
        
        <!-- City -->
        <label for="city">City:</label>
        <select id="city" name="city" onblur="validate(this.value, this.id)" >
            <option value=""> ************* </option>
        </select><br/>
        
        <!-- Country, City validation -->
        <span id="countryFailed"
              class="<?php echo $_SESSION['errors']['country'] ?>">
          Please select your country. 
        </span>
        <span id="cityFailed"
              class="<?php echo $_SESSION['errors']['city'] ?>">
          Please select your city. 
        </span>
        
        
        
        <!-- Email -->
        <label for="txtEmail">E-mail:</label>
        <input id="txtEmail" name="txtEmail" type="text" 
               onblur="validate(this.value, this.id)" 
               value="<?php echo $_SESSION['values']['txtEmail'] ?>" />
        <span id="txtEmailFailed"
              class="<?php echo $_SESSION['errors']['txtEmail'] ?>">
          Invalid e-mail address.
        </span>
        <br />
        
        <!-- Phone number -->
        <label for="txtPhone">Phone number:</label>
        <input id="txtPhone" name="txtPhone" type="text" 
               onblur="validate(this.value, this.id)" 
               value="<?php echo $_SESSION['values']['txtPhone'] ?>" />
        <span id="txtPhoneFailed"
              class="<?php echo $_SESSION['errors']['txtPhone'] ?>">
          Please insert a valid US phone number (xxx-xxx-xxxx). 
        </span>
        <br />
          
          
        <br /><br /><br />
        <!-- Read terms checkbox -->
        <input type="checkbox" id="chkReadTerms" name="chkReadTerms" 
               onblur="validate(this.checked, this.id)" 
               <?php if ($_SESSION['values']['chkReadTerms'] == 'on') 
                     echo 'checked="checked"' ?> /> 
        I'm older than 8 years
        <span id="chkReadTermsFailed"
              class="<?php echo $_SESSION['errors']['chkReadTerms'] ?>">
          Please make sure you read the Terms of Use. 
        </span>
        
        <!-- End of form -->
        <hr />
        <span class="txtSmall">Note: All fields are required.</span>
        <br /><br />
        <input type="submit" name="submitbutton" value="Register" 
               class="left button" />
      </form>
</fieldset>