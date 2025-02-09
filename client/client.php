<?php

$baseUrl = "http://localhost:8000";

function sendRequest(string $method, string $endpoint, array $data = []): array
{
    global $baseUrl;
    $url = $baseUrl . $endpoint;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

    if (!empty($data)) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
    }

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    return [
        'status' => $httpCode,
        'body' => json_decode($response, true)
    ];
}

function generateNumber(): array
{
    return sendRequest('POST', '/generate');
}

function getAllNumbers(): array
{
    return sendRequest('GET', '/numbers');
}

function getNumberById($id): array
{
    return sendRequest('GET', "/numbers/$id");
}

echo "Генерация числа:\n";
print_r(generateNumber());

echo "\nПолучение всех чисел:\n";
print_r(getAllNumbers());

echo "\nПолучение числа по ID = 1:\n";
print_r(getNumberById(90));
