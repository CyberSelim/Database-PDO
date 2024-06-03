<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netland Beheer - Film Details</title>
    <style>
        body {
            text-align: center;
            background-color: black;
            color: white;
        }

        table {
            border-collapse: collapse;
            width: 25%;
            margin: 20px auto;
            background-color: grey;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: grey;
            text-align: center;
        }

        .summary {
            margin: 20px auto;
            margin-left: 30px;
            margin-right: 30px;
            border: 2px solid yellow;
            border-radius: 10px;
            padding: 10px;
            text-align: left;
        }
    </style>
</head>

<body>
    <?php
    $servername = "localhost";
    $username = "bit_academy";
    $password = "bit_academy";
    $database = "netland";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_GET['id'])) {
            $movie_id = $_GET['id'];

            $query = "SELECT * FROM films WHERE id = :movie_id";
            $statement = $conn->prepare($query);
            $statement->bindParam(':movie_id', $movie_id);
            $statement->execute();

            $row = $statement->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                echo "<h2>" . $row["titel"] . "</h2>";

                echo "<table>";
                echo "<tr><th>Informatie</th><th>Informatie</th></tr>";
                echo "<tr><td>Datum van uitkomst</td><td>" . $row["datum_van_uitkomst"] . "</td></tr>";
                echo "<tr><td>Land van uitkomst</td><td>" . $row["land_van_uitkomst"] . "</td></tr>";
                echo "<tr><td>Duur</td><td>" . $row["duur"] . ' minuten ' . "</td></tr>";
                echo "</table>";

                echo "<h3>Beschrijving:</h3>";
                echo "<div class='summary'>";
                echo "<p>" . $row["omschrijving"] . "</p>";
                echo "</div>";
                echo "<br>";
            } else {
                echo "Geen film gevonden met dit ID.";
            }
        } else {
            echo "Geen film geselecteerd.";
        }
    } catch (PDOException $e) {
        echo "Verbinding mislukt: " . $e->getMessage();
    }
    ?>


    <br>
    <a href="index.php">Terug naar overzicht</a>
</body>

</html>