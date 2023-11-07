<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Edit</title>
</head>
<body>
    <div class="con">
        <form class="editForm" enctype="multipart/form-data" action="#" method="post">
            <table>
                <tr><th colspan="4">Alla Produkter</th><th>Välj</th></tr>
                <?php
                    include 'connection.php';

                    // tar ALLT från tabellen
                    $sql = "SELECT * FROM products";

                    // så länge som den finns mer tuples kommer if sattsen gå igenom
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // en while loop som går igenom tabblen
                        while($row = $result->fetch_assoc()) {
                            // skappar tr, td taggar för tabellen i HTML (rader = tr)
                            echo "<tr>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["description"] . "</td>";
                            echo "<td>" . $row["price"] . "kr</td>";
                            echo "<td><img src=".$row["image"]." alt='" . $row["name"] . "'></td>";
                            // anger id från produkten till value för radio button
                            echo "<td><input type='radio' name='product' value='" . $row["id"] . "'></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td>Inga produkter</td></tr>";
                    }

                    $conn->close();
                ?>
            </table>
            <div class="btnMenu">
                <!-- formulär för förändringen -->
                <input type="text" placeholder="Kostnad" name="price" id="price" style="margin-top: 0;">
                <input type="file" name="img" id="file"/>
                <input type="submit" name="submit" value="Ändra">


                <a href="http://localhost/max_hemtenta2">Användargränssnitt</a>
                <a href="http://localhost/max_hemtenta2/funktioner/add.php">Lägg till produkt</a>
                <a href="http://localhost/max_hemtenta2/funktioner/read.php">Se alla produkter</a>
                <a href="http://localhost/max_hemtenta2/funktioner/edit.php" class="activeBtn">Ändra pris/bild på produkt</a>
                <a href="http://localhost/max_hemtenta2/funktioner/remove.php">Ta bort produkt</a>
            </div>
        </form>
        <?php

            if (isset($_POST['submit'])) {
                if (isset($_POST['product'])) {
                    $selectedProductId = $_POST['product'];

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "crud_app";
    
                    // en ny connection
                    $newConn = new mysqli($servername, $username, $password, $dbname);

                    if ($newConn->connect_error) {
                        die("Connection failed: " . $newConn->connect_error);
                    }

                    $price = $_POST["price"];

                    $file_uploaded = false;
                    $target_dir = "img/";
                    $target_file = $target_dir . basename($_FILES["img"]["name"]);
                    move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
                    
                    // kollar om file selector är tom
                    if (!$_FILES['img']['size'] == 0) {
                        $file_uploaded = true;
                    }

                    $newSql = "UPDATE products SET ";

                    if (!empty($price) && $file_uploaded) {
                        $newSql .= "price = '$price', image = '$target_file' ";
                    } elseif (empty($price) && $file_uploaded) {
                        $newSql .= "image = '$target_file' ";
                    } elseif (!empty($price) && !$file_uploaded) {
                        $newSql .= "price = '$price' ";
                    }

                    $newSql .= "WHERE id = " . (int)$selectedProductId;

                    // om sql går igneom tar den mig till read.php
                    if ($newConn->query($newSql) === TRUE) {
                        header("Location: ./read.php");
                        exit();
                    } else {
                        echo "Error: " . $newSql . "<br>" . $newConn->error;
                    }

                    $newConn->close();
                }
            }
        ?>
    </div>
</body>
</html>