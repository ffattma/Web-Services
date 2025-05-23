<?php
require 'config.php';
require 'vendor/autoload.php';

use GuzzleHttp\Client;

if (!isset($_GET['city_id'])) {
    die('City not selected!');
}

$cityId = $_GET['city_id'];
$url = WEATHER_URL . "?id=$cityId&appid=" . API_KEY . "&units=metric";

$client = new Client();

try {
    $response = $client->request('GET', $url, ['verify' => false]);
    $data = json_decode($response->getBody(), true);
} catch (Exception $e) {
    die("Error fetching data: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weather Report</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <?php if (isset($data['main'])): ?>
        <div class="weather-card">
            <h2><?= htmlspecialchars($data['name']) ?> Weather</h2>
            <p><strong>Min Temp:</strong> <?= $data['main']['temp_min'] ?>°C</p>
            <p><strong>Max Temp:</strong> <?= $data['main']['temp_max'] ?>°C</p>
            <p><strong>Humidity:</strong> <?= $data['main']['humidity'] ?>%</p>
            <a href="index.php" class="back-btn">Back</a>
        </div>
    <?php else: ?>
        <p>Sorry, something went wrong.</p>
    <?php endif; ?>
</div>
</body>
</html>
