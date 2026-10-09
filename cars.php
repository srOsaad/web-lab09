<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Lab 09 - list of used cars from the exhibition_db database">
    <title>Lab 09</title>
    <style>
        table, th, td {
            border: 1px solid #444;

            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <h1>Cars for Sale</h1>
<?php
    // fetching 
    require_once "settings.php";

    $dbconn = @mysqli_connect($host, $user, $pwd, $sql_db);

    if ($dbconn) {
        $query = "SELECT car_id, make, model, price, yom FROM cars";
        $result = mysqli_query($dbconn, $query);

        if (!$result) {
            echo "<p>Something went wrong with the query.</p>";
        } elseif (mysqli_num_rows($result) > 0) {
            // Task 7: table headings first, then one row per record
            echo "<table>";
            echo "<tr>";
            echo "<th>Car ID</th>";
            echo "<th>Make</th>";
            echo "<th>Model</th>";
            echo "<th>Price</th>";
            echo "<th>Year</th>";
            echo "</tr>";

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
            mysqli_free_result($result);
        } else {
            echo "<p>There are no cars to display.</p>";
        }

        mysqli_close($dbconn);
    }
    else {
        echo "<p>Unable to connect to the db.</p>";
    }
?>
</body>
</html>
