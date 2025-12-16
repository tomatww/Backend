<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$ch = curl_init();

$url = "http://localhost/lab4_complete/phplab/api/getOilsAsJSON.php"; 
curl_setopt($ch, CURLOPT_URL, $url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    $error_msg = curl_error($ch);
    echo "Помилка cURL: " . $error_msg;
} else {
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($http_code == 200) {
        $decodedData = json_decode($response, TRUE);
        if ($decodedData === null) {
            echo "<b>Помилка:</b> Отримані дані не є валідним JSON.<br>";
        } elseif (!isset($decodedData['oils'])) {
            echo "<b>Помилка:</b> У JSON відсутній ключ 'oils'.<br>";
        } else {
            $data = $decodedData['oils'];
            foreach ($data as $oil) {
                echo $oil['id'] . ". " . ($oil['commonName'] ?? 'Назва відсутня') . " " . ($oil['oilType'] ?? '') . "</br>";
                echo "Призначення: <i>" . ($oil['purpose'] ?? 'Не вказано') . "</i></br>";
                echo "<b>Характеристики:</b></br>";
                if (isset($oil['properties']) && is_array($oil['properties'])) {
                    foreach ($oil['properties'] as $propertyName => $propertyValue) {
                        if (is_array($propertyValue)) {
                            $displayValue = implode(", ", $propertyValue);
                        } else {
                            $displayValue = $propertyValue;
                        }

                        echo $propertyName . ": " . $displayValue . "</br>";
                    }
                }
            }
        }
    } else {
        echo "Сервер повернув помилку HTTP: " . $http_code;
        echo "<br>Відповідь сервера: " . htmlspecialchars($response);
    }
}

curl_close($ch);
?>