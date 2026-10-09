<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lab 09</title>
    <style>
        table, th, td {
            border: 1px solid #444;

            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <h1>Search Results</h1>
<?php
    require_once "settings.php";

    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);

    if (!$conn) {
        echo "<p>Database connection failure.</p>";
    } else {
        if (isset($_GET['model'])) {
            $model = mysqli_real_escape_string($conn, $_GET['model']);
            $sql = "SELECT car_id, make, model, price, yom FROM cars WHERE model LIKE '%$model%'";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                echo "<table border='1' cellpadding='5'>";
                echo "<tr><th>ID</th><th>Make</th><th>Model</th><th>Price</th><th>Year</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['car_id'] . "</td>";
                    echo "<td>" . $row['make'] . "</td>";
                    echo "<td>" . $row['model'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo "<td>" . $row['yom'] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "🚫 No matching cars found.";
            }
        } else {
            echo "Please enter a model to search.";
        }

        mysqli_close($conn);
    }
?>
    <p><a href="search_form.php">Search again</a></p>
</body>
</html>