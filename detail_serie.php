<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netland Beheer - Serie Details</title>
    <style>
        body {
            text-align: center;
            background-color: black;
            color: white;
            background-color: #000022;
        }


        h1,
        h2 {
            text-align: center;
        }

        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #1e1e2e;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #000033;
            text-align: left;
        }

        th {
            background-color: #1e1e2e;
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
            $serie_id = $_GET['id'];

            $query = "SELECT * FROM series WHERE id = :serie_id";
            $statement = $conn->prepare($query);
            $statement->bindParam(':serie_id', $serie_id);
            $statement->execute();

            $row = $statement->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                echo "<h2>" . htmlspecialchars($row["title"]) . "</h2>";

                echo "<table>";
                echo "<tr><th>Informatie</th><th>Informatie</th></tr>";
                echo "<tr><td>Rating</td><td>" . htmlspecialchars($row["rating"]) . "</td></tr>";
                echo "<tr><td>Beschrijving</td><td>" . htmlspecialchars($row["description"]) . "</td></tr>";
                echo "<tr><td>Seizoenen</td><td>" . htmlspecialchars($row["seasons"]) . "</td></tr>";
                echo "<tr><td>Land</td><td>" . htmlspecialchars($row["country"]) . "</td></tr>";
                echo "<tr><td>Taal</td><td>" . htmlspecialchars($row["language"]) . "</td></tr>";
                echo "</table>";
            } else {
                echo "Geen serie gevonden met dit ID.";
            }
        } else {
            echo "Geen serie geselecteerd.";
        }
    } catch (PDOException $e) {
        echo "Verbinding mislukt: " . $e->getMessage();
    }
    ?>

    <br>
    <a href="index.php">Terug naar overzicht</a>
</body>

</html>
