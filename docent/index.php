<?php
include "../database.php";
include "docentcheck.php";
include "../validatie.php";

$status = "";

$editID = "";
$titel = "";
$samenv = "";
$link = "";
$rank = "";
$cat_id = "";
$cat_name = "";

if(isset($_POST['add'])){
    if(empty($_POST['editID'])){
        $artikelTitel = test_input($_POST['artikelTitel']);
        $artikelSamenv = test_input($_POST['artikelSamenv']);
        $artikelLink = test_input($_POST['artikelLink']);
        $artikelCat = test_input($_POST['artikelCat']);
        $artikelRank = test_input($_POST['artikelRank']);

        $sql = $conn->prepare("INSERT INTO Artikelen(ArtikelTitel, ArtikelSamenvatting, ArtikelLink, ArtikelRank, category_id) VALUES (?, ?, ?, ?, ?");
        $sql->bind_param("sssii",  $artikelTitel, $artikelSamenv, $artikelLink, $artikelRank, $artikelCat);
        if ($sql->execute()) {
            $status = "Toegevoegd!";
        } else {
            $status = $sql . "<br>" . $conn->error;
        }
    }else{
        $artikelID = test_input($_POST['editID']);
        $artikelTitel = test_input($_POST['artikelTitel']);
        $artikelSamenv = test_input($_POST['artikelSamenv']);
        $artikelLink = test_input($_POST['artikelLink']);
        $artikelCat = test_input($_POST['artikelCat']);
        $artikelRank = test_input($_POST['artikelRank']);

        $sql = $conn->prepare("UPDATE Artikelen SET id = ?, ArtikelTitel = ?, ArtikelSamenvatting = ?, ArtikelLink = ?, ArtikelRank = ?, category_id = ? WHERE id = ?");
        $sql->bind_param("isssiii",  $artikelID, $artikelTitel, $artikelSamenv, $artikelLink, $artikelRank, $artikelCat, $artikelID);
        if ($sql->execute()) {
            $status = "Bewerkt!";
        } else {
            $status = $sql . "<br>" . $conn->error;
        }
    }
} elseif (isset($_POST['delete'])) {
    $artikelID = $_POST['id'];
    $sql = $conn->prepare("DELETE FROM Artikelen WHERE id = ?");
    $sql->bind_param("i",  $artikelID);
    if ($sql->execute()) {
        $status = "Verwijderd!";
    } else {
        $status = $sql . "<br>" . $conn->error;
    }
} elseif (isset($_POST['edit'])) {
    $editID = test_input($_POST['id']);
    $titel = test_input($_POST['titel']);
    $samenv = test_input($_POST['samenvatting']);
    $link = test_input($_POST['link']);
    $rank = test_input($_POST['rank']);
    $cat_id = test_input($_POST['cat_id']);
    $cat_name = test_input($_POST['cat_name']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Startpagina</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Quattrocento&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>
<h1 class="titel">BiNaSk Docenten Pagina</h1>
<p class="titel">Welkom <?php echo $_SESSION['user_firstname'];?></p>
<nav class="navbar navbar-default">
    <ul class="nav navbar-nav">
        <li><a href="index.php">Bronnen</a></li>
        <li><a href="categorie.php">Categorieën</a></li>
        <li><a href="gebruiker.php">Gebruikers</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="../index.php">Terug naar website</a></li>
    </ul>
</nav>
<div class="container">
    <h1>Bronnen Manager</h1>
    <h4>Bronnen toevoegen, bewerken en verwijderen</h4>
    <hr class="split">
    <div class="row">
        <div class="col-sm-12">
            <form class="" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <p class="titel"><?php echo $status ?></p>
                <div class="form-group">
                    <label for="artikelID"><b>ID:</b></label>
                    <input class="form-control input-md" type="text" name="artikelID" id="artikelID"  disabled value="<?php echo $editID; ?>">
                    <input class="form-control" type="text" name="editID" id="editID" hidden="hidden" value="<?php echo $editID; ?>">
                </div>
                <div class="form-group">
                    <label class="labels"><b>Titel:</b></label>
                    <input class="form-control input-md" type="text" placeholder="Titel" name="artikelTitel" id="artikelTitel" value="<?php echo $titel; ?>" required>
                </div>
                <div class="form-group">
                    <label class="labels"><b>Samenvatting:</b></label>
                    <input class="form-control input-md" type="text" placeholder="Samenvatting" name="artikelSamenv" id="artikelTitel" value="<?php echo $samenv; ?>" required>
                </div>
                <div class="form-group">
                    <label class="labels"><b>Link:</b></label>
                    <input class="form-control input-md" type="url" placeholder="Link" name="artikelLink" id="artikelTitel" value="<?php echo $link; ?>" required>
                </div>
                <div class="form-group">
                    <label class="labels"><b>Belangrang:</b></label>
                    <input class="form-control input-md" type="number" placeholder="Een getal" name="artikelRank" id="artikelTitel" value="<?php echo $rank; ?>" required>
                </div>
                <div class="form-group">
                    <label class="labels"><b>Categorie:</b></label>
                    <?php
                    $sql = "SELECT category_id, category_name FROM category";
                    $result = mysqli_query($conn, $sql);
                    echo '<select class="form-control" name="artikelCat">';
                    while($row = mysqli_fetch_array($result)){
                        echo '<option value="' . $row['category_id'] . '">' . $row['category_name'] . '</option>';
                    }
                    echo '</select>'
                    ?>
                </div>
                <button class="btn btn-sm btn-primary" name="add" type="submit">Toevoegen</button>
            </form>
        </div>
    </div>
    <hr>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Titel</th>
            <th>Samenvatting</th>
            <th>Link</th>
            <th>Rang</th>
            <th>Categorie</th>
            <th style="width: 16%;"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT a.id, a.ArtikelTitel, a.ArtikelSamenvatting, a.ArtikelLink, a.ArtikelRank, c.category_id, c.category_name FROM Artikelen a JOIN category c ON a.category_id = c.category_id ORDER BY a.id ASC";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)){
            $editID = $row['id'];
            $titel = $row['ArtikelTitel'];
            $samenv = $row['ArtikelSamenvatting'];
            $link = $row['ArtikelLink'];
            $rank = $row['ArtikelRank'];
            $cat_id = $row['category_id'];
            $cat_name = $row['category_name'];
            echo "<tr>";
            echo "<td>$editID</td>";
            echo "<td>$titel</td>";
            echo "<td>$samenv</td>";
            echo "<td>$link</td>";
            echo "<td>$rank</td>";
            echo "<td>$cat_name</td>";
            echo "<form action='index.php' method='post'>";
            echo "<input type='text' value='$editID' name='id' hidden='hidden'>";
            echo "<input type='text' value='$titel' name='titel' hidden='hidden'>";
            echo "<input type='text' value='$samenv' name='samenvatting' hidden='hidden'>";
            echo "<input type='text' value='$link' name='link' hidden='hidden'>";
            echo "<input type='text' value='$rank' name='rank' hidden='hidden'>";
            echo "<input type='text' value='$cat_id' name='cat_id' hidden='hidden'>";
            echo "<input type='text' value='$cat_name' name='cat_name' hidden='hidden'>";
            echo "<td><div class='btn-group'><input type='submit' name='edit' value='Bewerken' class='btn btn-sm btn-warning'>";
            echo "<input type='submit' name='delete' value='Verwijderen' class='btn btn-sm btn-danger'></div></td></form>";
            echo "</form>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>

