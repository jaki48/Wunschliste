<?php
$name = $_POST["name"];
$link = $_POST["link"];
$price = $_POST["price"];
$id = intval($_POST["id"]);

$jsonFile = '../wishes.json';

if (file_exists($jsonFile)) {
    $wishes = json_decode(file_get_contents($jsonFile), true);
    $found = false;

    foreach ($wishes as $key => $wish) {
        if ($wish['id'] == $id) {
            $wishes[$key]['name'] = $name;
            $wishes[$key]['link'] = $link;
            $wishes[$key]['price'] = $price;
            $found = true;
            break;
        }
    }

    if ($found && file_put_contents($jsonFile, json_encode($wishes, JSON_PRETTY_PRINT))) {
        header("Location: .");
        exit;
    }
}

header("Location: .?error=true");
exit;
?>