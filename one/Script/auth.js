/** ������� ���������� � ������� ���������� jquery
* ��� �������� ����� �� �������� �����������*/
$(document).ready(function() {
   $("#Login").blur(function(){
    if($(this).val() == 0)
    {
        $("#LoginFailed").addClass("error");   
    }
    else
    {
        $("#LoginFailed").addClass("hidden");   
    }
    });
      
   $("#Password").blur(function(){
    if($(this).val() == 0)
    {
        $("#PasswordFailed").addClass("error");   
    }
    else
    {
        $("#PasswordFailed").addClass("hidden"); 
    }
    });
});