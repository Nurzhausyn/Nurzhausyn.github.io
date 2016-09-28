<? if (isset($object)) {?>
<fieldset>
    <h3><? echo $object['name']?></h3>
    <img class="" src="View/Images/leaf.jpg" alt="leaf" />
    <br /><br />
    <p> Возраст &nbsp;<? echo $object['age']?>. </p>
    <p> Эл.почта&nbsp; <? echo $object['mail']?>. </p>
    <p> Телефон &nbsp;<? echo $object['phone']?>. </p>
    <p> Город  &nbsp;<? echo $object['city']?>. </p>
    <p> Страна &nbsp; <? echo $object['country']?>. </p>
</fieldset>
<? }?>


