<?php
    if ($ingr_row['AllergenID']) {
        $name = $ingr_row['AllergenName'];
        $id = "allergen" . $ingr_row['AllergenID'];
    } else {
        $name = $ingr_row['IngredientName'];
        $id = $ingr_row['IngredientID'];
    }

    $is_checked = in_array($id, $ingredients);

    $new_ingredients = $ingredients;

    if ($is_checked) {
        $new_ingredients = array_diff($new_ingredients, [$id]);
    } else {
        array_push($new_ingredients, $id);
    }
    $query_result = http_build_query(array_values($new_ingredients));
?>

<a 
<?php

if ($is_checked and $dontgrow) {
    echo "class='label checked dont-grow'";
} else if ($is_checked) {
    echo "class='label checked'";
} else if ($dontgrow) {
    echo "class='label dont-grow'";
} else {
    echo "class='label'";
}

echo ' href="' . $_SERVER['PHP_SELF'] . '?' . $query_result . '#for-you"';

?>
>
    <span><?php echo $name; ?></span>
</a>