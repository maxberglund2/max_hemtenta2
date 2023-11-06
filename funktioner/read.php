<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Read</title>
    <style>
    </style>
</head>
<body>
    <?php
        include 'connection.php';

        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        $table = "<div class='con'><table><tr><th colspan='4'>Products</th></tr>";

        if ($result->num_rows > 0) {
            // en while loop som går igenom tabblen
            while($row = $result->fetch_assoc()) {
                $table .= '<tr><td>' . $row["name"] . '</td><td>' . $row["description"] . '</td><td>' . $row["price"] . '</td><td><img src="../' . $row["image"] . '" alt="' . $row["name"] . '"></td></tr>';
            }
            echo $table .= '</table><div class="btnMenu"><a href="http://localhost/max_hemtenta2">Användargränssnitt</a><a href="http://localhost/max_hemtenta2/funktioner/add.php">Lägg till produkt</a><a href="http://localhost/max_hemtenta2/funktioner/edit.php">Ändra pris/bild på produkt</a><a href="http://localhost/max_hemtenta2/funktioner/remove.php">Ta bort produkt</a></div><div>';
        } else {
            echo "0 results";
        }

        $conn->close();
    ?>
</body>
</html>