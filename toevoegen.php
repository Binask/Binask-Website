<?php include "session.php";
include "database.php";

if (!empty($_POST)) {
    if (isset($_POST['titel'])) {
        $titel = test_input($_POST['titel']);
    }
    if (isset($_POST['samenvatting'])) {
        $samenvatting = test_input($_POST['samenvatting']);
    }
    if (isset($_POST['link'])) {
        $link = $_POST['link'];
    }
    if (isset($_POST['categorie'])) {
        $categorie = test_input($_POST['categorie']);
    }
    if (isset($_POST['belangrang'])) {
        $rank = test_input($_POST['belangrang']);
        if($rank > 2147483647)
        {
            $rank = 2147483647;
        }

    }

    $toevoegquery = $conn->prepare("INSERT INTO Artikelen (ArtikelTitel, ArtikelSamenvatting, ArtikelLink, ArtikelCategorie, ArtikelRank) VALUES (?, ?, ?, ?, ?);");
    $toevoegquery->bind_param("ssssi", $titel, $samenvatting, $link, $categorie, $rank);
    $toevoegquery->execute();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Startpagina</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="custom.css">
    <link href="https://fonts.googleapis.com/css?family=Quattrocento&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<h1 class="titel">BiNaSk</h1>

<?php include "navbar.php" ?>

<!--
<form action="toevoegen.php" method="post">
    Titel:<br>
    <input type="text" placeholder="Titel"><br><br>
    Samenvatting:<br>
    <input type="text" placeholder="Samenvatting"><br><br>
    Link:<br>
    <input type="text" placeholder="Link"><br><br>
    Categorie:<br>
    <input type="text" placeholder="Categorie"><br><br>
    Belangrang:<br>
    <input type="text" placeholder="Een getal">
    <button class="btn btn-lg btn-primary btn-block" name="toevoegen" type="submit">Toevoegen</button>
-->
<form class="form-login" method="POST" action="toevoegen.php">
    <h1 class="h1 mb-3 text-center">Bron toevoegen</h1>
    <div class="form-group">
        <label class="labels"><b>Titel:</b></label>
        <input class="form-control input-lg" type="text" placeholder="Titel" name="titel" required>
    </div>
    <div class="form-group">
        <label class="labels"><b>Samenvatting:</b></label>
        <input class="form-control input-lg" type="text" placeholder="Samenvatting" name="samenvatting" required>
    </div>
    <div class="form-group">
        <label class="labels"><b>Link:</b></label>
        <input class="form-control input-lg" type="url" placeholder="Link" name="link" required>
    </div>
    <div class="form-group">
        <label class="labels"><b>Categorie:</b></label>
        <input class="form-control input-lg" type="text" placeholder="Samenvatting" name="categorie" required>
    </div>
    <div class="form-group">
        <label class="labels"><b>Belangrang:</b></label>
        <input class="form-control input-lg" type="number" placeholder="Een getal" name="belangrang" required>
    </div>
    <button class="btn btn-lg btn-primary btn-block" name="toevoegen" type="submit">Toevoegen</button>
</form>

</form>


</body>
</html>