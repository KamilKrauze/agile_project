<label <?php
    $name = $ingr_row['IngredientName'];
    $id = $ingr_row['IngredientID'];
    $is_checked = in_array($id, $ingredients);
    if ($is_checked and $dontgrow) {
        echo "class='checked dont-grow'";
    }
    else if ($is_checked) {
        echo "class='checked'";
    }
    else if ($dontgrow) {
        echo "class='dont-grow'";
    }
?>>
    <input onChange="this.form.submit()" type="checkbox" name="ingredientSelection[]" value="<?php echo $id; ?>" 
    <?php if ($is_checked) echo "checked='checked'"; ?>><span><?php echo $name; ?></span>
</label>