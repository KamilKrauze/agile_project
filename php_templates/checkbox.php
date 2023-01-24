<label>
    <input onChange="this.form.submit()" type="checkbox" name="ingredientSelection[]" value="<?php echo $name; ?>" 
    <?php if (in_array($name, $ingredients)) echo "checked='checked'"; ?>><span><?php echo $name; ?></span>
</label>