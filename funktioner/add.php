<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Add</title>
</head>
<body>
    <form class="btnMenu" enctype="multipart/form-data" action="#" method="post">
        <input type="text" placeholder="name" name="name" id="nme">
        <textarea name="description" id="description" cols="30" rows="10" placeholder="description"></textarea>
        <input type="text" placeholder="price" name="price" id="price">
        <input type="file" name="img" id="file"/>
        <input type="submit" value="Submit" name="Submit">
    </form>
</body>
</html>
<?php
    if(isset($_POST['Submit']))
    { 
        include 'connection.php';

        $name = $_POST["name"];
        $description = $_POST["description"];
        $price = $_POST["price"];
        $target_dir = "img/";
        $target_file = $target_dir . basename($_FILES["img"]["name"]);
        move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);

        $sql = "INSERT INTO products (name, description, price, image)
        VALUES ('$name', '$description', '$price', '$target_file')";

        if ($conn->query($sql) === TRUE) {
            header("Location: read.php");
            exit();
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
?>