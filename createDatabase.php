<?php 
include 'functions.php';
$servername = "localhost";
$username = "root";
$password = "";


$database = "jelasvijeta";
$conn = databaseConnect($servername, $username, $password);
$conn = createDatabase($servername, $username, $password, $database);

createLanguage($conn);
createMeal($conn);
createTag($conn);
createIngredient($conn);
createCategory($conn);
createMealTranslation($conn);
createIngredientTranslation($conn);
createTagTranslation($conn);
createCategoryTranslation($conn);

disconnectDatabase($conn);
?>