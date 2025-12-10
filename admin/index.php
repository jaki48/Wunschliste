<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Wunschliste von <?php include '../config.php'; echo $page_name; ?> [ADMIN]</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <?php
        if (isset($_GET["error"])) {
            echo '<div class="alert alert-danger" role="alert">
                    Dateisystem Fehler (Schreibrechte prüfen!).
                  </div>';
        }
        ?>
        <div class="container py-5">
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <?php
                ini_set("display_errors", 1);
                error_reporting(E_ALL);
                
                $jsonFile = '../wishes.json';
                $wishes = [];

                if (file_exists($jsonFile)) {
                    $jsonData = file_get_contents($jsonFile);
                    $wishes = json_decode($jsonData, true);
                    if (!$wishes) $wishes = [];
                }
                
                foreach ($wishes as $row) {
                    echo '
                    <div class="col">
                        <div class="card link-card h-100">
                            <div class="card-body">
                                <form action="edit.php" method="post">
                                    <input type="hidden" name="id" value="' . $row["id"] . '">
                                    <input type="text" name="name" class="form-control mb-2" value="' . htmlspecialchars($row["name"]) . '">
                                    <input type="text" name="link" class="form-control mb-2" value="' . htmlspecialchars($row["link"]) . '">
                                    <input type="text" name="price" class="form-control mb-2" value="' . htmlspecialchars($row["price"]) . '">
                                    <button type="submit" class="btn btn-primary">Speichern</button>
                                    <a href="delete.php?id=' . $row["id"] . '" class="btn btn-danger float-end">Löschen</a>
                                </form>
                            </div>
                        </div>
                    </div>';
                }
                ?>
                <div class="col">
                    <div class="card link-card h-100">
                        <div class="card-body">
                            <h5 class="card-title">Neuer Wunsch</h5>
                            <form action="add.php" method="post">
                                <input type="text" name="name" class="form-control mb-2" placeholder="Name">
                                <input type="text" name="link" class="form-control mb-2" placeholder="URL">
                                <input type="text" name="price" class="form-control mb-2" placeholder="Preis">
                                <button type="submit" class="btn btn-primary">Hinzufügen</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>