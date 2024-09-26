<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netland Beheer - Media Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            background-color: #000022;
            padding: 20px;
            color: white;
        }

        h1, h2 {
            text-align: center;
        }

        table {
            width: 70%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #1e1e2e;
        }

        th, td {
            padding: 10px;
            border: 1px solid #000033;
            text-align: left;
        }

        th {
            background-color: #1e1e2e;
        }

        .summary {
            margin: 20px auto;
            margin-left: 30px;
            margin-right: 30px;
            border: 2px solid yellow;
            border-radius: 10px;
            padding: 10px;
            text-align: left;
            background-color: #1e1e2e;
        }

        .add-links {
            text-align: center;
            margin: 20px;
        }

        .add-links a {
            padding: 10px 20px;
            background-color: #0055ff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin: 0 10px;
            display: inline-block;
        }

        .add-links a:hover {
            background-color: #003bb5;
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

        if (isset($_GET['id']) && isset($_GET['type'])) {
            $id = $_GET['id'];
            $media_type = $_GET['type'];

            $query = "SELECT * FROM media WHERE id = :id AND type = :type";
            $statement = $conn->prepare($query);
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->bindParam(':type', $media_type, PDO::PARAM_STR);
            $statement->execute();

            $row = $statement->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                echo "<h2>" . htmlspecialchars($row["title"]) . "</h2>";
                echo "<table>";
                echo "<tr><th>Informatie</th><th>Detail</th></tr>";

                echo "<tr><td>Type</td><td>" . htmlspecialchars($row["type"]) . "</td></tr>";
                echo "<tr><td>Title</td><td>" . htmlspecialchars($row["title"]) . "</td></tr>";
                echo "<tr><td>Summary</td><td>" . htmlspecialchars($row["summary"]) . "</td></tr>";

               
                if ($media_type === 'movie') {
                    echo "<tr><td>Duration</td><td>" . htmlspecialchars($row["length_in_minutes"]) . " minutes</td></tr>";
                    echo "<tr><td>Release Date</td><td>" . htmlspecialchars($row["released_at"]) . "</td></tr>";
                    echo "<tr><td>Country</td><td>" . htmlspecialchars($row["country"]) . "</td></tr>";
                    echo "<tr><td>Youtube Trailer</td><td><a href='https://www.youtube.com/watch?v=" . htmlspecialchars($row["youtube_trailer_id"]) . "' target='_blank'>Bekijk Trailer</a></td></tr>";
                } elseif ($media_type === 'series') {
                    echo "<tr><td>Rating</td><td>" . htmlspecialchars($row["rating"]) . "</td></tr>";
                    echo "<tr><td>Seasons</td><td>" . htmlspecialchars($row["seasons"]) . "</td></tr>";
                    echo "<tr><td>Country</td><td>" . htmlspecialchars($row["country"]) . "</td></tr>";
                    echo "<tr><td>Language</td><td>" . htmlspecialchars($row["spoken_in_language"]) . "</td></tr>";
                    echo "<tr><td>Awards Won</td><td>" . htmlspecialchars($row["has_won_awards"]) . "</td></tr>";
                }
                echo "</table>";
            } else {
                echo "Geen media gevonden met dit ID.";
            }
        } 
    } catch (PDOException $e) {
        echo "Verbinding mislukt: " . $e->getMessage();
    }
    ?>

    <div class="add-links">
        <a href="index.php">back to index</a>
    </div>
</body>

</html>
