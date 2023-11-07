<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Add</title>
</head>
<body>
    <div class="con">
        <form class="btnMenu" enctype="multipart/form-data" action="#" method="post">
            <input type="text" placeholder="Namn på produkten" name="name" id="name">
            <textarea name="description" id="description" cols="30" rows="10" placeholder="Beskrivning"></textarea>
            <input type="text" placeholder="Kostnad" name="price" id="price">
            <input type="file" name="img" id="file"/>
            <input type="submit" value="Skapa" name="Submit">
        </form>
        <div class="btnMenu">
            <a href="http://localhost/max_hemtenta2">Användargränssnitt</a>
            <a href="http://localhost/max_hemtenta2/funktioner/add.php" class="activeBtn">Lägg till produkt</a>
            <a href="http://localhost/max_hemtenta2/funktioner/read.php">Se alla produkter</a>
            <a href="http://localhost/max_hemtenta2/funktioner/edit.php">Ändra pris/bild på produkt</a>
            <a href="http://localhost/max_hemtenta2/funktioner/remove.php">Ta bort produkt</a>
        </div>
    </div>
</body>
</html>
<?php
    // När formulären körs
    if(isset($_POST['Submit']))
    { 
        include 'connection.php';

        // data från formulären
        $name = $_POST["name"];
        $description = $_POST["description"];
        $price = $_POST["price"];
        $target_dir = "img/";
        // tar bilden
        $target_file = $target_dir . basename($_FILES["img"]["name"]);
        move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);

        // lägger in i tabellen (DB)
        $sql = "INSERT INTO products (name, description, price, image)
        VALUES ('$name', '$description', '$price', '$target_file')";

        // om sql variabeln går igenom tar den mig till read.php
        if ($conn->query($sql) === TRUE) {
            header("Location: read.php");
            exit();
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
?>