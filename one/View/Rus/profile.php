<? if (isset($object)) {?>
<fieldset>
    <h3><? echo $object['name']?></h3>
    <img class="" src="View/Images/leaf.jpg" alt="leaf" />
    <br /><br />
    <p> ������� &nbsp;<? echo $object['age']?>. </p>
    <p> ��.�����&nbsp; <? echo $object['mail']?>. </p>
    <p> ������� &nbsp;<? echo $object['phone']?>. </p>
    <p> �����  &nbsp;<? echo $object['city']?>. </p>
    <p> ������ &nbsp; <? echo $object['country']?>. </p>
</fieldset>
<? }?>


