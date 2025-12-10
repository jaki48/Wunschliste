<?php
$id = intval($_GET["id"]);

$jsonFile = '../wishes.json';

if (file_exists($jsonFile)) {
    $wishes = json_decode(file_get_contents($jsonFile), true);
    
    $wishes = array_filter($wishes, function($wish) use ($id) {
        return $wish['id'] != $id;
    });

    $wishes = array_values($wishes);

    if (file_put_contents($jsonFile, json_encode($wishes, JSON_PRETTY_PRINT))) {
        header("Location: .");
        exit;
    }
}

header("Location: .?error=true");
exit;
?>