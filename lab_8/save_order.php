<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $orderNumber = $_POST['order_number'];
    $orderWeight = $_POST['order_weight'];
    $city = $_POST['city'];
    $deliveryType = $_POST['delivery_type'];
    $delivery_point = $_POST['delivery_point'];

    if (empty($orderNumber) || empty($orderWeight) || empty($city) || empty($deliveryType) || empty($delivery_point)) {
        echo "Please fill in all fields.";
        exit;
    }

    try {
        $pdo = new PDO("pgsql:host=postgres dbname=db user=laravel-getting-started-user password=laravel-getting-started-password");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare('INSERT INTO orders (number, weight, city, delivery_type, delivery_point) VALUES (?, ?, ?, ?, ?)');
        $stmt->execute([$orderNumber, $orderWeight, $city, $deliveryType, $delivery_point]);

        echo "Order successfully saved!";
    } catch (PDOException $e) {
        echo "Error saving the order: " . $e->getMessage();
    }
}
