<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Wunschliste von <?php include 'config.php'; echo $page_name; ?></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
		<h1 style="margin: 15px;">Wunschliste von <?php include 'config.php'; echo $page_name; ?> 🎁</h1>
        <?php
        $jsonFile = 'wishes.json';
        
        $wishes = [];
        if (file_exists($jsonFile)) {
            $jsonData = file_get_contents($jsonFile);
            $wishes = json_decode($jsonData, true);
            if (!$wishes) $wishes = [];
        }

        foreach ($wishes as $row) {
            $id = $row["id"] ?? uniqid();
            $name = $row["name"] ?? '';
            $link = $row["link"] ?? '';
            $price = $row["price"] ?? '';

            echo '<div class="accordion accordion-flush" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-' . $id . '" aria-expanded="false" aria-controls="flush-collapseOne">
        ' . htmlspecialchars($name) . '
      </button>
    </h2>
    <div id="collapse-' . $id . '" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body"><a href="' . htmlspecialchars($link) . '" target="_blank">Zum Produkt</a>, ' . htmlspecialchars($price) . '</div>
    </div>
  </div>
</div>';
        }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>