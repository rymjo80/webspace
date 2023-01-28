<?php

function updateJSON($full_file, $new_data)
{
    $file = file_get_contents($full_file);
    $data = json_decode($file);
    if (is_array($data)) {
        array_push($data, $new_data);
        $jsonData = json_encode($data);
        echo $jsonData;
    } else {
        $jsonData = json_encode(array($new_data));
    }

    file_put_contents($full_file, $jsonData);
}

function getJSONData($filepath, $assoc)
{
    $user_file = $filepath;
    $file = file_get_contents($user_file);
    $data = json_decode($file, $assoc);
    return $data;
}

function getJournalEntries($number_of_entries)
{
    $count = 0;
    $journal = "";
    $data = getJSONData("files/" . $_SESSION['user'] . "-journal.json", true);
    if (is_array($data)) {
        $data_reverse = array_reverse($data);
        foreach ($data_reverse as $entry) {
            if ($entry[0] == "Journal") {
                $journal .= "<div class='card'>";
                $journal .= "<p class='journal-entry-date'>" . date("F j, Y g:i a", strtotime($entry[1])) . "</p>";
                $journal .= "<p>" . $entry[2] . "</p>";
                $journal .= "</div>";
                $count++;
            }
            if ($count == $number_of_entries) {
                return $journal;
            }
        }
        return $journal;
    }
    return "<div class='card'>Add an entry!</div>";
}

function getRecipeCard($recipeId)
{
    $recipe_str = "";
    $rec = explode("-", $recipeId);
    if ($rec[0] == "c")
        $recipes = getJSONData("files/community-recipes.json", true);
    else if ($rec[0] == "u") {
        $recipes = getJSONData("files/" . $_SESSION['user'] . "-recipes.json", true);
        if (is_array($recipes)) {
            $recipes = array_reverse($recipes);
        }
    }

    if (is_array($recipes)) {
        $recipe = $recipes[$rec[1]];
        $recipe_str .= "<div class='card'>";
        $recipe_str .= "<div class='recipe-card'>";
        $recipe_str .= "<div class='recipe-card-header'>";
        $recipe_str .= "<h3>" . $recipe['name'] . "</h3>";
        $recipe_str .= "<img src='" . $recipe['imageURL'] . "' alt='" . $recipe['name'] . "' />";
        $recipe_str .= "</div>";
        $recipe_str    .= "<div class='recipe-card-body'>";
        $recipe_str .= "<div class='ingredients'>";
        $recipe_str .= "<ul>";
        foreach ($recipe['ingredients'] as $ingredient) {
            $recipe_str .= "<li>" . $ingredient['quantity'] . " " . $ingredient['name']  . "</li>";
        }
        $recipe_str .= "</ul>";
        $recipe_str .= "</div>";
        $recipe_str .= "<div class='directions'>";
        $recipe_str .= "<ol>";
        foreach ($recipe['steps'] as $step) {
            $recipe_str .= "<li>$step</li>";
        }
        $recipe_str .= "</ol>";
        $recipe_str .= "</div>";
        $recipe_str .= "</div>";
        $recipe_str .= "</div>";
        $recipe_str .= "</div>";

        return $recipe_str;
    } else {
        return "<div class='card'>Add your first recipe!</div>";
    }
}

function getSmallRecipeCards($type)
{
    $count = 0;
    $small_recipes = "";
    if ($type == "comm") {
        $recipes = getJSONData("files/community-recipes.json", true);
        $code = "c";
    } else if ($type == "user") {
        $recipes = getJSONData("files/" . $_SESSION['user'] . "-recipes.json", true);
        if (is_array($recipes)) {
            $recipes = array_reverse($recipes);
        }
        $code = "u";
    }
    if (is_array($recipes) && count($recipes) > 0) {
        foreach ($recipes as $recipe) {
            $small_recipes .= "<a href='recipe.php?id=" . $code . "-" . $count . "'>";
            $small_recipes .= "<div class='card small-card'>";
            $small_recipes .= "<div class='recipe-card small-card'>";
            $small_recipes .= "<div class='recipe-card-header'>";
            $small_recipes .= "<h3>" . $recipe['name'] . "</h3>";
            $small_recipes .= "<img src='" . $recipe['imageURL'] . "' alt='" . $recipe['name'] . "' />";
            $small_recipes .= "</div>";
            $small_recipes .= "</div>";
            $small_recipes .= "</div>";
            $small_recipes .= "</a>";
            $count++;
        }
        return $small_recipes;
    } else {
        return "<div class='card'>Enter your first recipe!</div>";
    }
}

function getSmallRecipeCardBy($recipeId)
{
    $recipe_str = "";
    $rec = explode("-", $recipeId);
    if ($rec[0] == "c")
        $recipes = getJSONData("files/community-recipes.json", true);
    else if ($rec[0] == "u") {
        $recipes = getJSONData("files/" . $_SESSION['user'] . "-recipes.json", true);
        if (is_array($recipes)) {
            $recipes = array_reverse($recipes);
        }
    }

    if (is_array($recipes)) {
        $recipe = $recipes[$rec[1]];
        $recipe_str .= "<div class='card'>";
        $recipe_str .= "<div class='recipe-card'>";
        $recipe_str .= "<div class='recipe-card-header'>";
        $recipe_str .= "<h3>" . $recipe['name'] . "</h3>";
        $recipe_str .= "<img src='" . $recipe['imageURL'] . "' alt='" . $recipe['name'] . "' />";
        $recipe_str .= "</div>";
        $recipe_str .= "</div>";
        $recipe_str .= "</div>";

        return $recipe_str;
    } else {
        return "<div class='card'>Add your first recipe!</div>";
    }
}

function getStack($date, $card_size)
{
    $stacks = getJSONData("files/" . $_SESSION['user'] . "-stacks.json", true);
    $daily_stack = "<div class='card'><a href='my-recipes.php'>Add A Recipe Stack!</a></div>";
    if (is_array($stacks)) {
        $breakfast = array();
        $lunch = array();
        $dinner = array();
        foreach ($stacks as $stack) {
            if ($stack['date'] == $date) {
                if ($stack['meal'] == "breakfast") {
                    $breakfast[] = $stack['recipe-id'];
                } else if ($stack['meal'] == "lunch") {
                    $lunch[] = $stack['recipe-id'];
                } else if ($stack['meal'] == "dinner") {
                    $dinner[] = $stack['recipe-id'];
                }
                $daily_stack = "";
                if (is_array($breakfast)) {
                    $daily_stack .= getStringFromArray($breakfast, "Breakfast", $card_size);
                }
                if (is_array($lunch)) {
                    $daily_stack .= getStringFromArray($lunch, "Lunch", $card_size);
                }
                if (is_array($dinner)) {
                    $daily_stack .= getStringFromArray($dinner, "Dinner", $card_size);
                }
            }
        }
    }
    return $daily_stack;
}

function getStringFromArray($array, $array_name, $card_size)
{
    $string = "<div class='card'>" . $array_name . "</div>";
    if (is_array($array)) {
        foreach ($array as $item) {
            if ($card_size == "small") {
                $string .= getSmallRecipeCardBy($item);
            } else {
                $string .= getRecipeCard($item);
            }
        }
    }
    return $string;
}
