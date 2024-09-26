<?php
session_start();

if (isset($_SESSION['loggedInUser'])) {
    header('Location: index.php');
    exit();
}

$host = 'localhost';
$db = 'netland';
$user = 'bit_academy';
$pass = 'bit_academy';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    echo 'Verbinding mislukt: ' . $e->getMessage();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, username, password FROM gebruikers WHERE username = :username LIMIT 1");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && $user['password'] === $password) {
        $_SESSION['loggedInUser'] = $user['id'];  
        header('Location: index.php');  
        exit();
    } else {
        $error = "Ongeldige gebruikersnaam of wachtwoord.";  
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
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

<body>
    <h2>Inloggen</h2>
    <?php
    if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    }
    ?>
    <form method="POST" action="login.php">
        <label for="username">Gebruikersnaam:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" required><br>

        <input type="submit" value="Inloggen">
    </form>
</body>
</html>
