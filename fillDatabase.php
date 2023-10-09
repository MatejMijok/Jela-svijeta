<?php
require_once 'C:\xampp\vendor\autoload.php';
$servername = "localhost";
$username = "root";
$password = "";
$database = "JelaSvijeta";

$faker = Faker\Factory::create();
$faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));
$faker->seed(675);

$conn = mysqli_connect($servername, $username, $password, $database);
if(!$conn){
    die("Connection error: " . mysqli_connect_error());
}


$sql = "INSERT INTO language (lang) VALUES ('en')";

if(mysqli_query($conn, $sql)){
    echo "<br>Value inserted successfully";
}
else{
    echo "Error inserting value: " . mysqli_error($conn);
}

$sql = "INSERT INTO language (lang) VALUES ('de')";

if(mysqli_query($conn, $sql)){
    echo "<br>Value inserted successfully";
}
else{
    echo "Error inserting value: " . mysqli_error($conn);
}


for($i = 1; $i<6; $i++){
$sql = "INSERT INTO meal (title, description, id_language) VALUES ('$faker->foodName', '$i. description', '1')";

if(mysqli_query($conn, $sql)){
    echo "<br>Value inserted successfully";
}
    else{
    echo "Error inserting value: " . mysqli_error($conn);
    }

$sql = "INSERT INTO ingredient (title, id_language, id_meal) VALUES ('$faker->vegetableName', '1', '$i')";

if(mysqli_query($conn, $sql)){
    echo "<br>Value inserted successfully";
}
else{
    echo "Error inserting value: " . mysqli_error($conn);
    }

$sql = "INSERT INTO tag (title, slug, id_language, id_meal) VALUES ('$i. tag title', 'title-$i', '1', '$i')";

if(mysqli_query($conn, $sql)){
        echo "<br>Value inserted successfully";
    }
        else{
        echo "Error inserting value: " . mysqli_error($conn);
        }       


$sql = "INSERT INTO category (title, slug, id_language, id_meal) VALUES ('$i. category title', 'title-$i', '1', '$i')";

if(mysqli_query($conn, $sql)){
        echo "<br>Value inserted successfully";
    }
        else{
        echo "Error inserting value: " . mysqli_error($conn);
        }          
    
}
    
?>