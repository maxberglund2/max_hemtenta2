<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Produkter</title>
    <style>
    </style>
</head>
<body>
    <div class='con'>
        <table>
            <tr><th colspan='4'>Alla Produkter</th></tr>
            <?php
                include 'connection.php';

                $sql = "SELECT * FROM products";
                $result = $conn->query($sql);

                $table = "<div class='con'><table><tr><th colspan='4'>Products</th></tr>";

                if ($result->num_rows > 0) {
                    // en while loop som går igenom tabblen
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        echo "<td>" . $row["price"] . "kr</td>";
                        echo "<td><img src='../" . $row["image"] . "' alt='" . $row["name"] . "'></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td>0 results</td></tr>";
                }

                $conn->close();
            ?>
        </table>
        <div class="btnMenu">
            <a href="http://localhost/max_hemtenta2">Användargränssnitt</a>
            <a href="http://localhost/max_hemtenta2/funktioner/add.php">Lägg till produkt</a>
            <a href="http://localhost/max_hemtenta2/funktioner/read.php" class="activeBtn">Se alla produkter</a>
            <a href="http://localhost/max_hemtenta2/funktioner/edit.php">Ändra pris/bild på produkt</a>
            <a href="http://localhost/max_hemtenta2/funktioner/remove.php">Ta bort produkt</a>
        </div>
    <div>
</body>
</html>