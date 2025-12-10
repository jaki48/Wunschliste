<?php
$requestMethod = $_SERVER['REQUEST_METHOD'] ?? '';
if ($requestMethod !== 'POST') {
    header("Location: /admin/"); 
    exit;
}

$name = $_POST["name"] ?? '';
$link = $_POST["link"] ?? '';
$price = $_POST["price"] ?? '';

$jsonFile = '../wishes.json'; 

$wishes = [];
if (file_exists($jsonFile)) {
    $jsonData = file_get_contents($jsonFile);
    $decodedData = json_decode($jsonData, true);
    if (is_array($decodedData)) {
        $wishes = $decodedData;
    }
}

$newId = 1;
if (!empty($wishes)) {
    $ids = array_column($wishes, 'id');
    $newId = max($ids) + 1;
}

$newWish = [
    'id' => $newId,
    'name' => $name,
    'link' => $link,
    'price' => $price
];

$wishes[] = $newWish;

if (file_put_contents($jsonFile, json_encode($wishes, JSON_PRETTY_PRINT)) !== false) {
    header("Location: .");
} else {
    header("Location: .?error=write_failed"); 
}
exit;
?>