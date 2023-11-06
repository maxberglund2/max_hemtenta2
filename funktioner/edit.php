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
        <form class="editForm" action="#" method="post">
            <table>
                <tr><th colspan="4">Alla Produkter</th><th>Välj</th></tr>
                <?php
                    include 'connection.php';

                    $sql = "SELECT * FROM products";
                    $result = $conn->query($sql);

                    

                    if ($result->num_rows > 0) {
                        // en while loop som går igenom tabblen
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["description"] . "</td>";
                            echo "<td>" . $row["price"] . "kr</td>";
                            echo "<td><img src='../" . $row["image"] . "' alt='" . $row["name"] . "'></td>";
                            echo "<td><input type='radio' name='delete[]' value='" . $row["id"] . "'></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "0 results";
                    }

                    $conn->close();
                ?>
            </table>
            <div class="btnMenu">
                <input type="text" placeholder="price" name="price" id="price" style="margin-top: 0;;">
                <input type="file" name="img" id="file"/>
                <input type="submit" value="Ändra">

                <a href="http://localhost/max_hemtenta2">Användargränssnitt</a>
                <a href="http://localhost/max_hemtenta2/funktioner/add.php">Lägg till produkt</a>
                <a href="http://localhost/max_hemtenta2/funktioner/read.php">Se alla produkter</a>
                <a href="http://localhost/max_hemtenta2/funktioner/edit.php" class="activeBtn">Ändra pris/bild på produkt</a>
                <a href="http://localhost/max_hemtenta2/funktioner/remove.php">Ta bort produkt</a>
            </div>
        </form>
        <?php
        ?>
    </div>
</body>
</html>