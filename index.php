<?php include "session.php" ?>
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

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="hbtext">
                <h1>Hallo <?php echo $user_firstname . '!'; ?></h1>
                <p class="welkomtext">Welkom bij de startpagina! Vanuit hier kunt u zich navigeren naar de bronnen die u
                    zoekt. U kunt rechts namelijk zoeken naar een bron. Hieronder staat ook nog een overzicht met alle
                    categorieën.</p>
            </div>
            <div class="categorieen">
                <h2>Categorieën</h2>
                <?
                $query = "SELECT DISTINCT(ArtikelCategorie) FROM Artikelen ORDER BY ArtikelCategorie, ArtikelRank";
                $result = mysqli_query($conn, $query);

                while($row = mysqli_fetch_array($result)){
                    echo "<p>•" . $row['ArtikelCategorie'] . "</p>";
                }
                ?>
            </div>
            <div>
                <h2>Misschien iets voor u.</h2>
                <a>•Lorem ipsum dolor sit.</a><br>
                <a>•Lorem, ipsum dolor.</a><br>
                <a>•Lorem ipsum dolor sit amet.</a><br>
                <a>•Lorem ipsum dolor sit amet consectetur.</a><br>
            </div>
        </div>
        <div class="col-md-4">
            <div class="search-bar">
                <form action="#">
                    <input type="text" class="input-md" placeholder="Zoeken..">
                    <button class="btn btn-md btn-primary glyphicon glyphicon-search" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
            <div class="laatstbekeken">
                <br>
                <h2>Laatst bekeken</h2>
                <p>•Lorem ipsum dolor sit amet.</p>
                <p>•Lorem, ipsum dolor.</p>
                <p>•Lorem ipsum dolor sit.</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>