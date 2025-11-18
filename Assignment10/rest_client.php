<?php

function getWeather() {

    if (!isset($_POST['zip_code']) || trim($_POST['zip_code']) == "") {
        return ["<p style='color:red;'>Please enter a zip code.</p>", ""];
    }

    $zip = urlencode($_POST['zip_code']);
    $url = "https://russet-v8.wccnet.edu/~sshaper/assignments/assignment10_rest/get_weather_json.php?zip_code={$zip}";
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        curl_close($ch);
        return ["<p style='color:red;'>There was an error contacting the weather service.</p>", ""];
    }

    curl_close($ch);

    $json = json_decode($response, true);

    if (isset($json["error"])) {
        return ["<p style='color:red;'>".$json["error"]."</p>", ""];
    }

    $searched = $json["searched_city"];

    $ackMsg = "<h2>Weather Results for ZIP: {$zip}</h2>";

    $output = "";
    $output .= "<h3>{$searched['name']}</h3>";
    $output .= "<p><strong>Temperature:</strong> {$searched['temperature']}</p>";
    $output .= "<p><strong>Humidity:</strong> {$searched['humidity']}</p>";
    $output .= "<h4>Three-Day Forecast</h4>";
    $output .= "<ul>";
    foreach ($searched['forecast'] as $day) {
        $output .= "<li><strong>{$day['day']}:</strong> {$day['condition']}</li>";
    }
    $output .= "</ul>";
    $output .= "<h3>Cities with Higher Temperatures</h3>";

    if (empty($json["higher_temperatures"])) {
        $output .= "<p style='color:red;'>No cities found with higher temperatures.</p>";
    } else {
        $output .= "<table border='1' cellpadding='6'><tr><th>City</th><th>Temperature</th></tr>";
        $count = 0;

        foreach ($json["higher_temperatures"] as $city) {
            if ($count >= 3) break;
            $output .= "<tr><td>{$city['name']}</td><td>{$city['temperature']}</td></tr>";
            $count++;
        }
        $output .= "</table>";
    }

    $output .= "<h3>Cities with Lower Temperatures</h3>";

    if (empty($json["lower_temperatures"])) {
        $output .= "<p style='color:red;'>No cities found with lower temperatures.</p>";
    } else {
        $output .= "<table border='1' cellpadding='6'><tr><th>City</th><th>Temperature</th></tr>";
        $count = 0;

        foreach ($json["lower_temperatures"] as $city) {
            if ($count >= 5) break;
            $output .= "<tr><td>{$city['name']}</td><td>{$city['temperature']}</td></tr>";
            $count++;
        }
        $output .= "</table>";
    }

    return [$ackMsg, $output];
}

?>
