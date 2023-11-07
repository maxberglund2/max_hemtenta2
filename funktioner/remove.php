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

                    // tar allt från tabellen
                    $sql = "SELECT * FROM products";

                    // så länge som den finns mer tuples kommer if sattsen gå igenom
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // en while loop som går igenom tabblen beroende på antal tuples i DB
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
                        // om inte det finns några tuples (rader) i DB
                        echo "<tr><td>Inga produkter</td></tr>";
                    }

                    $conn->close();
                ?>
            </table>
            <!-- Ta bort knappen, och andra meny knappar -->
            <div class="btnMenu">
                <input type="submit" name="submit" value="Ta bort" style="background-color:red; margin-top: 0;">

                <a href="http://localhost/max_hemtenta2">Användargränssnitt</a>
                <a href="http://localhost/max_hemtenta2/funktioner/add.php">Lägg till produkt</a>
                <a href="http://localhost/max_hemtenta2/funktioner/read.php">Se alla produkter</a>
                <a href="http://localhost/max_hemtenta2/funktioner/edit.php">Ändra pris/bild på produkt</a>
                <a href="http://localhost/max_hemtenta2/funktioner/remove.php" class="activeBtn">Ta bort produkt</a>
            </div>
        </form>
        <?php
            // vid tryck av ta bort knapp ->
            if (isset($_POST['submit'])) {
                // om en radio button är vald
                if (isset($_POST['product'])) {
                    // tar radio "button's value"
                    $selectedProductId = $_POST['product'];
            
                    $newConn = new mysqli($servername, $username, $password, $dbname);
                    if ($newConn->connect_error) {
                    die("Connection failed: " . $newConn->connect_error);
                    }

                    // Tar bort produkten från tabellen
                    $newSql = "DELETE FROM products WHERE id = " . (int)$selectedProductId;
            
                    // om sql går igenom tar den mig till read.php
                    if ($newConn->query($newSql) === TRUE) {
                        header("Location: ./read.php");
                    } else {
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