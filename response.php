<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "JelaSvijeta";

$conn = mysqli_connect($servername, $username, $password, $database);


if (!$conn) {
    die("Connection error: " . mysqli_connect_error());
}

if (isset($_GET['lang'])) {
    $filterLang = $_GET['lang'];
} else {
    $filterLang = 'en';
}

if (isset($_GET['page'])) {
    $filterPage = intval($_GET['page']);
} else {
    $filterPage = 1;
}

if (isset($_GET['per_page'])) {
    $filterPerPage = intval($_GET['per_page']);
} else {
    $filterPerPage = 5;
}

if (isset($_GET['with'])) {
    $filterWith = $_GET['with'];

    $includeIngredients = strpos($filterWith, 'ingredients') !== false;
    $includeCategories = strpos($filterWith, 'category') !== false;
    $includeTags = strpos($filterWith, 'tags') !== false;

    $sql = "SELECT meal.id, COALESCE(mealtranslation.nameTranslation, meal.title) AS meal, description, status ";

    if ($includeIngredients) {
        $sql .= ", ingredient.id, COALESCE(ingredienttranslation.nameTranslation, ingredient.title) AS ingredient, ingredient.slug";
    }

    if ($includeCategories) {
        $sql .= ", category.id, COALESCE(categorytranslation.nameTranslation, category.title) AS category, category.slug AS categorySlug";
    }

    if ($includeTags) {
        $sql .= ",tag.id, COALESCE(tagtranslation.nameTranslation, tag.title) AS tag, tag.slug AS tagSlug";
    }

    $sql .= " FROM meal";

    $sql .= " LEFT JOIN mealtranslation ON meal.id = mealtranslation.id_meal 
              AND mealtranslation.id_language = (SELECT id FROM language WHERE lang = '$filterLang')";

    if ($includeIngredients) {
        $sql .= " LEFT JOIN ingredient ON meal.id = ingredient.id_meal";
        $sql .= " LEFT JOIN ingredienttranslation ON ingredient.id = ingredienttranslation.id_ingredient
                  AND ingredientTranslation.id_language = (SELECT id FROM language WHERE lang = '$filterLang')";
    
    }

    if ($includeCategories) {
        $sql .= " LEFT JOIN category ON meal.id = category.id_meal";
        $sql .= " LEFT JOIN categorytranslation ON category.id = categorytranslation.id_category
        AND categorytranslation.id_language = (SELECT id FROM language WHERE lang = '$filterLang')";
    }

    if ($includeTags) {
        $sql .= " LEFT JOIN tag ON meal.id = tag.id_meal";
        $sql .= " LEFT JOIN tagtranslation ON tag.id = tagtranslation.id_tag
        AND tagtranslation.id_language = (SELECT id FROM language WHERE lang = '$filterLang')";
    }

} else {
    $sql = "SELECT meal.id, COALESCE(mealtranslation.nameTranslation, meal.title) AS translation, description, status
            FROM meal
            LEFT JOIN mealtranslation ON meal.id = mealtranslation.id_meal
            AND mealtranslation.id_language = (SELECT id FROM language WHERE lang = '$filterLang')";
}




$result = mysqli_query($conn, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        $results = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $results[] = $row;
        }
    }
}


$json = json_encode($results, JSON_PRETTY_PRINT);
header('Content-Type: application/json');
echo $json;

mysqli_close($conn);
?>
