<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beheerderspagina</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            background-color: #000022;
            padding: 20px;
            color: white;
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
    <div class="container">
        <h1>Welkom op het netland beheerderspaneel</h1>

        <section>
            <h2>Series</h2>
            <table>
                <thead>
                    <tr>
                        <th>Titel</th>
                        <th>Rating</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $dbhost = "localhost";
                    $dbname = "netland";
                    $dbuser = "bit_academy";
                    $dbpass = "bit_academy";

                    try {
                        $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    } catch (PDOException $err) {
                        echo "Error: " . $err->getMessage();
                        exit();
                    }

                    try {
                        $sql = "SELECT title, rating FROM series";
                        $stmt = $conn->query($sql);

                        if ($stmt->rowCount() > 0) {
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr><td>" . htmlspecialchars($row["title"]) . "</td><td>" . htmlspecialchars($row["rating"]) . "</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2'>Geen series gevonden</td></tr>";
                        }
                    } catch (PDOException $err) {
                        echo "Query error: " . $err->getMessage();
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <section>
            <h2>Films</h2>
            <table>
                <thead>
                    <tr>
                        <th>Titel</th>
                        <th>Duur</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    try {
                        $sql = "SELECT id, titel, duur FROM films";
                        $stmt = $conn->query($sql);

                        if ($stmt->rowCount() > 0) {
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr><td><a href='detail_film.php?id=" . htmlspecialchars($row["id"]) . "'>" . htmlspecialchars($row["titel"]) . "</a></td><td>" . htmlspecialchars($row["duur"]) . " min</td></tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2'>Geen films gevonden</td></tr>";
                        }
                    } catch (PDOException $err) {
                        echo "Query error: " . $err->getMessage();
                    }

                    $conn = null;
                    ?>
                </tbody>
            </table>
        </section>
    </div>
</body>

</html>