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
<nav class="navbar navbar-default">
    <ul class="nav navbar-nav">
        <li><a href="index.php">Startpagina</a></li>
        <li><a href="bronnen.php">Bronnen</a></li>
        <?
        if($user_role == 'docent'){
            echo '<li><a href="toevoegen.php">Bronnen toevoegen</a></li>';
        }
        ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php">Uitloggen</a></li>
    </ul>
</nav>
<h1>Bronnen</h1>
<br><br>
Filter op categorie:<br>
<?php


function ShowCategories($conn){
    $query = "SELECT DISTINCT(ArtikelCategorie) FROM Artikelen ORDER BY ArtikelCategorie, ArtikelRank";
    $result = mysqli_query($conn, $query);

    echo '<form action="bronnen.php" method="post">';
    while($row = mysqli_fetch_array($result)){
        echo '<input type="radio" name="categorie" value="' . $row['ArtikelCategorie'] . '">' . $row['ArtikelCategorie'] . '<br>';
    }
    echo "<input type='submit' value='Filter'><br>";
    echo '</form>';


}

function FilterCategorie($conn){


    $categorie = $_POST['categorie'];

    $query = "SELECT * FROM Artikelen WHERE ArtikelCategorie = '$categorie' ORDER BY ArtikelRank ASC";
    $result = mysqli_query($conn, $query);

    echo "<br><br>";
    while($row = mysqli_fetch_array($result)){
        echo "<tr><td><b>" . $row['ArtikelTitel'] . "</b><br><br></td></tr><tr><td>" . $row['ArtikelSamenvatting'] . "<br><br></td></tr><tr><td><a href='" . $row['ArtikelLink'] . "' target='_blank'>" . $row['ArtikelLink'] . "</a>" . "<br><br></td></tr><tr><td>Categorie: " . $row['ArtikelCategorie'] . "<br><br><br><br></td></tr>";

    }

}

function ShowArtikelen($conn){
    $query = "SELECT * FROM Artikelen ORDER BY ArtikelRank ASC";
    $result = mysqli_query($conn, $query);

    echo "<br><br><table>";

    while($row = mysqli_fetch_array($result)){
        echo "<tr><td><b>" . $row['ArtikelTitel'] . "</b><br><br></td></tr><tr><td>" . $row['ArtikelSamenvatting'] . "<br><br></td></tr><tr><td><a href='" . $row['ArtikelLink'] . "' target='_blank'>" . $row['ArtikelLink'] . "</a>" . "<br><br></td></tr><tr><td>Categorie: " . $row['ArtikelCategorie'] . "<br><br><br><br></td></tr>";

    }

    echo "</table>";
}
$query = "SELECT DISTINCT(ArtikelCategorie) FROM Artikelen ORDER BY ArtikelCategorie";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

ShowCategories($conn);

if (!empty($_POST['categorie'])) {
    FilterCategorie($conn);
}
else {
    ShowArtikelen($conn);
}


?>


</body>
</html>