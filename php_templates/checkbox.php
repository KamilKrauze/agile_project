<label <?php
    if (in_array($name, $ingredients) and $dontgrow) {
        echo "class='checked dont-grow'";
    }
    else if (in_array($name, $ingredients)) {
        echo "class='checked'";
    }
    else if ($dontgrow) {
        echo "class='dont-grow'";
    }
?>>
    <input onChange="this.form.submit()" type="checkbox" name="ingredientSelection[]" value="<?php echo $name; ?>" 
    <?php if (in_array($name, $ingredients)) echo "checked='checked'"; ?>><span><?php echo $name; ?></span>
</label>