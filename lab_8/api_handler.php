<?php
header('Content-Type: application/json');

$env = parse_ini_file('.env');
$apiKey = $env["API_KEY"];

$action = $_POST['action'];

switch ($action) {
    case 'getCities':
        $data = [
            "apiKey" => $apiKey,
            "modelName" => "Address",
            "calledMethod" => "getCities"
        ];
        break;
    case 'getWarehouses':
        $cityRef = $_POST['cityRef'];
        $type = $_POST['type'];
        $data = [
            "apiKey" => $apiKey,
            "modelName" => "Address",
            "calledMethod" => "getWarehouses",
            "methodProperties" => [
                "CityRef" => $cityRef,
                "TypeOfWarehouseRef" => $type === "postomat" ? "f9316480-5f2d-425d-bc2c-ac7cd29decf0" : "841339c7-591a-42e2-8233-7a0a00f0ed6f"
            ]
        ];
        break;
    default:
        echo json_encode(["success" => false, "errors" => "Невідома дія"]);
        exit;
}

$url = "https://api.novaposhta.ua/v2.0/json/";
$options = [
    'http' => [
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode($data),
    ],
];

$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

if ($result === FALSE) {
    echo json_encode(["success" => false, "errors" => "Помилка запиту до API"]);
} else {
    echo $result;
}
?>