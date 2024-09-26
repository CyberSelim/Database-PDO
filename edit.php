<?php
require 'database.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    $stmt = $pdo->prepare('SELECT * FROM media WHERE id = :id');
    $stmt->execute(['id' => $id]);
    $media = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($media) {
        $type = $media['type'];
    }
} else {
    echo "Geen ID opgegeven.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $rating = !empty($_POST['rating']) ? $_POST['rating'] : null;
        $seasons = !empty($_POST['seasons']) ? $_POST['seasons'] : null;
        $length_in_minutes = !empty($_POST['length_in_minutes']) ? $_POST['length_in_minutes'] : null;
        $released_at = !empty($_POST['released_at']) ? $_POST['released_at'] : null;

        $stmt = $pdo->prepare('UPDATE media SET title = :title, rating = :rating, summary = :summary, has_won_awards = :has_won_awards, seasons = :seasons, country = :country,
        spoken_in_language = :spoken_in_language, length_in_minutes = :length_in_minutes, released_at = :released_at, youtube_trailer_id = :youtube_trailer_id WHERE id = :id');

        $stmt->execute([
            'title' => $_POST['title'],
            'rating' => $rating,
            'summary' => $_POST['summary'],
            'has_won_awards' => isset($_POST['has_won_awards']) ? 1 : 0,
            'seasons' => $seasons,
            'country' => $_POST['country'],
            'spoken_in_language' => $_POST['spoken_in_language'],
            'length_in_minutes' => $length_in_minutes,
            'released_at' => $released_at,
            'youtube_trailer_id' => $_POST['youtube_trailer_id'] ?? null,
            'id' => $id
        ]);

        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        echo "Fout bij het bijwerken van de gegevens: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Media</title>
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
            width: 100%;
            max-width: 600px;
        }

        label, input, textarea {
            display: block;
            margin: 10px 0;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
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
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($media['id']); ?>">
        
        <label for="type">Type</label>
        <select name="type" id="type" required>
            <option value="movie" <?php echo $media['type'] === 'movie' ? 'selected' : ''; ?>>Film</option>
            <option value="series" <?php echo $media['type'] === 'series' ? 'selected' : ''; ?>>Serie</option>
        </select>

        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($media['title']); ?>" required>

        <label for="rating">Rating</label>
        <input type="number" name="rating" id="rating" value="<?php echo htmlspecialchars($media['rating']); ?>" step="0.1">

        <label for="summary">Summary</label>
        <textarea name="summary" id="summary" required><?php echo htmlspecialchars($media['summary']); ?></textarea>

        <label for="has_won_awards">Has Won Awards</label>
        <input type="number" name="has_won_awards" id="has_won_awards" value="<?php echo htmlspecialchars($media['has_won_awards']); ?>">

        <label for="seasons">Seasons</label>
        <input type="number" name="seasons" id="seasons" value="<?php echo htmlspecialchars($media['seasons']); ?>">

        <label for="country">Country</label>
        <input type="text" name="country" id="country" value="<?php echo htmlspecialchars($media['country']); ?>">

        <label for="spoken_in_language">Language</label>
        <select name="spoken_in_language" id="spoken_in_language">
            <option value="NL" <?php echo $media['spoken_in_language'] === 'NL' ? 'selected' : ''; ?>>Nederlands</option>
            <option value="EN" <?php echo $media['spoken_in_language'] === 'EN' ? 'selected' : ''; ?>>Engels</option>
        </select>

        <label for="length_in_minutes">Length</label>
        <input type="number" name="length_in_minutes" id="length_in_minutes" value="<?php echo htmlspecialchars($media['length_in_minutes']); ?>">

        <label for="released_at">Released At</label>
        <input type="date" name="released_at" id="released_at" value="<?php echo htmlspecialchars($media['released_at']); ?>">

        <label for="youtube_trailer_id">YouTube Trailer ID</label>
        <input type="text" name="youtube_trailer_id" id="youtube_trailer_id" value="<?php echo htmlspecialchars($media['youtube_trailer_id']); ?>">

        <input type="submit" value="Opslaan">
    </form>
</body>

</html>
