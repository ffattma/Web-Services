<?php
require 'config.php';

if (!isset($_GET['city_id'])) {
    die('City not selected!');
}

$cityId = $_GET['city_id'];
$url = WEATHER_URL . "?id=$cityId&appid=" . API_KEY . "&units=metric";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response, true);

if (isset($data['cod']) && $data['cod'] != 200) {
    die("API Error: " . $data['message']);
}

echo "<h2>Weather Status for " . htmlspecialchars($data['name'])  . "</h2>";
echo "Min Temp: {$data['main']['temp_min']}°C<br>";
echo "Max Temp: {$data['main']['temp_max']}°C<br>";
echo "Humidity: {$data['main']['humidity']}%";
?>
