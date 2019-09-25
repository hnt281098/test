<?php  foreach($roads as $key => $road){ ?>
    <option value="<?php echo $road['Road']['to'];?>"><?php echo $road['Road']['to'];?></option>
<?php } ?>