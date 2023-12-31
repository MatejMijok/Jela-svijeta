<?php

function createDatabase($servername, $username, $password, $database){
    $conn = mysqli_connect($servername, $username, $password, $database);
    $sql = "CREATE DATABASE IF NOT EXISTS $database";
    if(mysqli_query($conn, $sql)){
        echo "Database created successfully";
    }
    else{
        echo "Error creating database: " . mysqli_error($conn);
    }
    return $conn;
}

function databaseConnect($servername, $username, $password){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $conn = mysqli_connect($servername, $username, $password);
    if(!$conn){
        die("Connection error: " . mysqli_connect_error());
    }
    return $conn;
}



function createLanguage($conn){
    $sql = "CREATE TABLE IF NOT EXISTS LANGUAGE(
        id INT PRIMARY KEY AUTO_INCREMENT,
        lang VARCHAR(100) UNIQUE
    )";

    if(mysqli_query($conn, $sql)){
        echo "<br>Table created successfully";
    }
    else{
        echo "Error creating table: " . mysqli_error($conn);
    }
}

function createMeal($conn){
    $sql = "CREATE TABLE IF NOT EXISTS MEAL(
        id INT PRIMARY KEY AUTO_INCREMENT,
        title VARCHAR(100),
        description VARCHAR(100),
        status VARCHAR(10) DEFAULT 'CREATED',
        id_language INT,
        id_category INT,
        FOREIGN KEY (id_language) REFERENCES LANGUAGE(id)
    )";
    if(mysqli_query($conn, $sql)){
        echo "<br>Table created successfully";
    }
    else{
        echo "Error creating table: " . mysqli_error($conn);
    }
}


function createTag($conn){
    $sql = "CREATE TABLE IF NOT EXISTS TAG(
        id INT PRIMARY KEY AUTO_INCREMENT,
        title VARCHAR(100),
        slug VARCHAR(100),
        id_meal INT,
        id_language INT,
        FOREIGN KEY (id_meal) REFERENCES MEAL(id),
        FOREIGN KEY (id_language) REFERENCES LANGUAGE(id)
    )";

    if(mysqli_query($conn, $sql)){
        echo "<br>Table created successfully";
    }
    else{
        echo "Error creating table: " . mysqli_error($conn);
    }

}
function createIngredient($conn){
    $sql = "CREATE TABLE IF NOT EXISTS INGREDIENT(
        id INT PRIMARY KEY AUTO_INCREMENT,
        title VARCHAR(100),
        slug VARCHAR(100),
        id_language INT,
        id_meal int,
        FOREIGN KEY (id_meal) REFERENCES MEAL(id),
        FOREIGN KEY (id_language) REFERENCES LANGUAGE(id)
    )";

    if(mysqli_query($conn, $sql)){
        echo "<br>Table created successfully";
    }
    else{
        echo "Error creating table: " . mysqli_error($conn);
    }
}

function createCategory($conn){
    $sql = "CREATE TABLE IF NOT EXISTS CATEGORY(
            id INT PRIMARY KEY AUTO_INCREMENT,
            title VARCHAR(100),
            slug VARCHAR(100),
            id_language INT,
            id_meal int,
            FOREIGN KEY (id_meal) REFERENCES MEAL(id),
            FOREIGN KEY (id_language) REFERENCES LANGUAGE(id)
    )";

    if(mysqli_query($conn, $sql)){
        echo "<br>Table created successfully";
    }
    else{
        echo "Error creating table: " . mysqli_error($conn);
    }
}

function createMealTranslation($conn){
    $sql = "CREATE TABLE IF NOT EXISTS MEALTRANSLATION(
        id INT PRIMARY KEY AUTO_INCREMENT,
        id_meal INT,
        id_language INT,
        nameTranslation VARCHAR(100),
        descriptionTranslation VARCHAR(100),
        FOREIGN KEY (id_meal) REFERENCES MEAL(id),
        FOREIGN KEY (id_language) REFERENCES LANGUAGE(id)
    )";

    if(mysqli_query($conn, $sql)){
        echo "<br>Table created successfully";
    }
    else{
        echo "Error creating table: " . mysqli_error($conn);
    }
}

function createIngredientTranslation($conn){
    $sql = "CREATE TABLE IF NOT EXISTS INGREDIENTTRANSLATION(
        id INT PRIMARY KEY AUTO_INCREMENT,
        id_ingredient INT,
        id_language INT,
        nameTranslation VARCHAR(100),
        FOREIGN KEY (id_ingredient) REFERENCES INGREDIENT(id),
        FOREIGN KEY (id_language) REFERENCES LANGUAGE(id)
    )";

    if(mysqli_query($conn, $sql)){
        echo "<br>Table created successfully";
    }
    else{
        echo "Error creating table: " . mysqli_error($conn);
    }
}

function createTagTranslation($conn){
    $sql = "CREATE TABLE IF NOT EXISTS TAGTRANSLATION(
        id INT PRIMARY KEY AUTO_INCREMENT,
        id_tag INT,
        id_language INT,
        tagTranslation VARCHAR(100),
        FOREIGN KEY (id_tag) REFERENCES TAG(id),
        FOREIGN KEY (id_language) REFERENCES LANGUAGE(id)
    )";

    if(mysqli_query($conn, $sql)){
        echo "<br>Table created successfully";
    }
    else{
        echo "Error creating table: " . mysqli_error($conn);
    }
}

function createCategoryTranslation($conn){
    $sql = "CREATE TABLE IF NOT EXISTS CATEGORYTRANSLATION(
        id INT PRIMARY KEY AUTO_INCREMENT,
        id_category INT,
        id_language INT,
        nameTranslation VARCHAR(100),
        FOREIGN KEY (id_category) REFERENCES CATEGORY(id),
        FOREIGN KEY (id_language) REFERENCES LANGUAGE(id)
    )";

    if(mysqli_query($conn, $sql)){
        echo "<br>Table created successfully";
    }
    else{
        echo "Error creating table: " . mysqli_error($conn);
    }
}

function disconnectDatabase($conn){
    mysqli_close($conn);
}


?>
