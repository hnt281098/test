<?php  foreach($roads as $key => $road){ ?>
    <option value="<?php echo trim($road['Road']['to']);?>"><?php echo trim($road['Road']['to']);?></option>
<?php } ?>