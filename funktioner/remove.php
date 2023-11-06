<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Remove</title>
</head>
<body>
    <div class="con">
        <form class="editForm" enctype="multipart/form-data" action="#" method="post">
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
                            echo "<td><input type='radio' name='product' value='" . $row["id"] . "'></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td>0 results</td></tr>";
                    }

                    $conn->close();
                ?>
            </table>
            <div class="btnMenu">
                <input type="submit" name="submit" value="Remove" style="background-color:red;">


                <a href="http://localhost/max_hemtenta2">Användargränssnitt</a>
                <a href="http://localhost/max_hemtenta2/funktioner/add.php">Lägg till produkt</a>
                <a href="http://localhost/max_hemtenta2/funktioner/read.php">Se alla produkter</a>
                <a href="http://localhost/max_hemtenta2/funktioner/edit.php">Ändra pris/bild på produkt</a>
                <a href="http://localhost/max_hemtenta2/funktioner/remove.php" class="activeBtn">Ta bort produkt</a>
            </div>
        </form>
        <?php
            if (isset($_POST['submit'])) {
                if (isset($_POST['product'])) {
                    $selectedProductId = $_POST['product'];
            
                    $newConn = new mysqli($servername, $username, $password, $dbname);
                    if ($newConn->connect_error) {
                    die("Connection failed: " . $newConn->connect_error);
                    }
                    $newSql = "DELETE FROM products WHERE id = " . (int)$selectedProductId;
            
                    if (!$newConn->query($newSql) === TRUE) {
                        die( "Error deleting product: " . $newConn->error);
                    }
            
                    $conn->close();
                } else {
                    echo "No product selected for deletion.";
                }
            }
            
        ?>
    </div>
</body>
</html>