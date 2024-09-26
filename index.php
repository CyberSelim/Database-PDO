<?php
session_start();
if (!isset($_SESSION['loggedInUser'])) {
    header('Location: login.php');
    exit();
}
?>

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
        .logout-link {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .logout-link a {
            color: white;
            text-decoration: none;
            font-size: 18px;
            padding: 10px 20px;
            background-color: transparent;
            border: 1px solid white;
            border-radius: 4px;
        }
        .logout-link a:hover {
            background-color: #1e1e2e;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logout-link">
            <a href="logout.php">Logout</a>
        </div>
        <h1>Welcome on Netland</h1>
        <div class="add-links">
            <a href="insert.php">Add Your Media</a>
        </div>
        <section>
            <h2>Media</h2>
            <table>
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Title</th>
                        <th>Rating</th>
                        <th>Detail</th>
                        <th>Edit</th>
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
                        $sql = "SELECT id, type, title, rating FROM media ORDER BY rating";
                        $stmt = $conn->query($sql);
                        if ($stmt->rowCount() > 0) {
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>
                                    <td>" . htmlspecialchars($row["type"]) . "</td>
                                    <td>" . htmlspecialchars($row["title"]) . "</td>
                                    <td>" . htmlspecialchars($row["rating"]) . "</td>
                                    <td><a href='detail.php?id=" . htmlspecialchars($row["id"]) . "&type=" . htmlspecialchars($row["type"]) . "'>Detail</a></td>
                                    <td><a href='edit.php?id=" . htmlspecialchars($row["id"]) . "&type=" . htmlspecialchars($row["type"]) . "'>Edit</a></td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>Geen media gevonden</td></tr>";
                        }
                    } catch (PDOException $err) {
                        echo "Query error: " . $err->getMessage();
                    }
                    $conn = null;
                    ?>
                </tbody>
            </table>
            <div>
                <h3>Dit geldt voor series (`type`, `title`, `rating`, `summary`, `has_won_awards`, `seasons`, `country`, `spoken_in_language`).
                     Dit voor films (`type`, `title`, `length_in_minutes`, `released_at`, `country`, `youtube_trailer_id`, `summary`).</h3>
            </div>
        </section>
    </div>
</body>
</html>
