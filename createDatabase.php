<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "JelaSvijeta";


$conn = mysqli_connect($servername, $username, $password);
if(!$conn){
    die("Connection error: " . mysqli_connect_error());
}

$sql = "CREATE DATABASE IF NOT EXISTS JelaSvijeta";
if(mysqli_query($conn, $sql)){
    echo "Database created successfully";
}
else{
    echo "Error creating database: " . mysqli_error($conn);
}


$conn = mysqli_connect($servername, $username, $password, $database);


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



$sql = "CREATE TABLE IF NOT EXISTS MEALTRANSLATION(
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_meal INT,
    id_language INT,
    translation VARCHAR(100),
    FOREIGN KEY (id_meal) REFERENCES MEAL(id),
    FOREIGN KEY (id_language) REFERENCES LANGUAGE(id)
)";

if(mysqli_query($conn, $sql)){
    echo "<br>Table created successfully";
}
else{
    echo "Error creating table: " . mysqli_error($conn);
}



$sql = "CREATE TABLE IF NOT EXISTS INGREDIENTTRANSLATION(
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_ingredient INT,
    id_language INT,
    translation VARCHAR(100),
    FOREIGN KEY (id_ingredient) REFERENCES INGREDIENT(id),
    FOREIGN KEY (id_language) REFERENCES LANGUAGE(id)
)";

if(mysqli_query($conn, $sql)){
    echo "<br>Table created successfully";
}
else{
    echo "Error creating table: " . mysqli_error($conn);
}



$sql = "CREATE TABLE IF NOT EXISTS TAGTRANSLATION(
    id INT PRIMARY KEY AUTO_INCREMENT,
    tag_id INT,
    id_language INT,
    translation VARCHAR(100),
    FOREIGN KEY (tag_id) REFERENCES TAG(id),
    FOREIGN KEY (id_language) REFERENCES LANGUAGE(id)
)";

if(mysqli_query($conn, $sql)){
    echo "<br>Table created successfully";
}
else{
    echo "Error creating table: " . mysqli_error($conn);
}


$sql = "CREATE TABLE IF NOT EXISTS CATEGORYTRANSLATION(
    id INT PRIMARY KEY AUTO_INCREMENT,
    category_id INT,
    id_language INT,
    translation VARCHAR(100),
    FOREIGN KEY (category_id) REFERENCES CATEGORY(id),
    FOREIGN KEY (id_language) REFERENCES LANGUAGE(id)
)";

if(mysqli_query($conn, $sql)){
    echo "<br>Table created successfully";
}
else{
    echo "Error creating table: " . mysqli_error($conn);
}


$sql = "CREATE TABLE IF NOT EXISTS MEALTRANSLATION(
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_meal INT,
    id_language INT,
    translation VARCHAR(100),
    FOREIGN KEY (id_meal) REFERENCES MEAL(id),
    FOREIGN KEY (id_language) REFERENCES LANGUAGE(id)
)";

if(mysqli_query($conn, $sql)){
    echo "<br>Table created successfully";
}
else{
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);

?>
