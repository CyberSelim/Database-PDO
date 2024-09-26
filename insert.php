
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    $title = $_POST['title'];
    $rating = isset($_POST['rating']) ? $_POST['rating'] : null;
    $summary = isset($_POST['summary']) ? $_POST['summary'] : null;
    $has_won_awards = isset($_POST['has_won_awards']) ? $_POST['has_won_awards'] : null;
    $seasons = isset($_POST['seasons']) ? $_POST['seasons'] : null;
    $country = isset($_POST['country']) ? $_POST['country'] : null;
    $spoken_in_language = isset($_POST['spoken_in_language']) ? $_POST['spoken_in_language'] : null;
    $length_in_minutes = isset($_POST['length_in_minutes']) ? $_POST['length_in_minutes'] : null;
    $released_at = isset($_POST['released_at']) ? $_POST['released_at'] : null;
    $youtube_trailer_id = isset($_POST['youtube_trailer_id']) ? $_POST['youtube_trailer_id'] : null;

    if (!in_array($type, ['film', 'serie'])) {
        die("Invalid type value");
    }

    try {
        $sql = "INSERT INTO media (type, title, rating, summary, has_won_awards, seasons, country, spoken_in_language, length_in_minutes, released_at, youtube_trailer_id)
                VALUES (:type, :title, :rating, :summary, :has_won_awards, :seasons, :country, :spoken_in_language, :length_in_minutes, :released_at, :youtube_trailer_id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':summary', $summary);
        $stmt->bindParam(':has_won_awards', $has_won_awards);
        $stmt->bindParam(':seasons', $seasons);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':spoken_in_language', $spoken_in_language);
        $stmt->bindParam(':length_in_minutes', $length_in_minutes);
        $stmt->bindParam(':released_at', $released_at);
        $stmt->bindParam(':youtube_trailer_id', $youtube_trailer_id);
        $stmt->execute();
        header("Location: index.php");
        exit();
    } catch (PDOException $err) {
        echo "Insert error: " . $err->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voeg Media Toe</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #000022;
            color: white;
        }

        form {
            background-color: #1e1e2e;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 600px;
        }

        label,
        input,
        textarea,
        select {
            display: block;
            margin: 10px 0;
        }

        input[type="text"],
        input[type="date"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <form method="POST" action="insert.php">
        <label for="type">Type:</label>
        <select name="type" id="type" required>
            <option value="film">Film</option>
            <option value="serie">Serie</option>
        </select>

        <label for="title">Title</label>
        <input type="text" name="title" id="title" required>

        <label for="rating">Rating</label>
        <input type="number" name="rating" id="rating" step="0.1">

        <label for="summary">summary</label>
        <textarea name="summary" id="summary"></textarea>

        <label for="has_won_awards">has_won_awards</label>
        <input type="checkbox" name="has_won_awards" id="has_won_awards" value="1">

        <label for="seasons">seasons</label>
        <input type="number" name="seasons" id="seasons">

        <label for="country">country</label>
        <input type="text" name="country" id="country">

        <label for="spoken_in_language">spoken_in_language</label>
        <input type="text" name="spoken_in_language" id="spoken_in_language">

        <label for="length_in_minutes">length_in_minutes</label>
        <input type="number" name="length_in_minutes" id="length_in_minutes">

        <label for="released_at">released_at</label>
        <input type="date" name="released_at" id="released_at">

        <label for="youtube_trailer_id">YouTube Trailer ID:</label>
        <input type="text" name="youtube_trailer_id" id="youtube_trailer_id">

        <input type="submit" value="update">
    </form>
    
</body>

</html>
