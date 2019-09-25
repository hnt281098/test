<?php  foreach($roads as $key => $road){ ?>
    <option value="<?php echo $road['Road']['from'];?>"><?php echo trim($road['Road']['from']);?></option>
<?php } ?>