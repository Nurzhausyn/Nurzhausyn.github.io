<?php if (isset($object)) {?>
<fieldset>
    <h3><?php echo $object['name']?></h3>
    <img class="" src="View/Images/leaf.jpg" alt="leaf" />
    <br /><br />
    <p> Age &nbsp;<?php echo $object['age']?>. </p>
    <p> Mail &nbsp;<?php echo $object['mail']?>. </p>
    <p> Phone &nbsp;<? echo $object['phone']?>. </p>
    <p> City  &nbsp;<?php echo $object['city']?>. </p>
    <p> Country &nbsp;<?php echo $object['country']?>. </p>
</fieldset>
<?php }?>


