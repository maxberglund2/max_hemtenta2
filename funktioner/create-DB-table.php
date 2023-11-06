<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_app";

// Hitta en koppling
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// skapa databasen
$sql = "CREATE DATABASE crud_app";

if ($conn->query($sql) === TRUE) {
    // Koppla till databasen
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Skapa tabellen
    $sql = "CREATE TABLE products (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        description TEXT,
        price DOUBLE NOT NULL,
        image VARCHAR(255)
    )";

    if ($conn->query($sql) === TRUE) {
    } else {
        die("Error creating table: " . $conn->error);
    }
} else {
    die("Error creating database: " . $conn->error);
}

$conn->close();
?>
