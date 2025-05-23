<?php
$cities = json_decode(file_get_contents('data/city.list.json'), true);
$egyptCities = array_filter($cities, fn($c) => $c['country'] === 'EG');
?>
<form method="GET" action="weather.php">
    <select name="city_id">
        <?php foreach ($egyptCities as $city): ?>
            <option value="<?= $city['id'] ?>"><?= htmlspecialchars($city['name']) ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Get Weather</button>
</form>
