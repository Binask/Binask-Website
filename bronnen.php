<?php
include "session.php";
include "database.php";
include "head.php";

function ShowCategories($conn){
    $query = "SELECT DISTINCT c.category_name FROM Artikelen a JOIN category c ON a.category_id = c.category_id ORDER BY c.category_id, ArtikelRank";
    $result = mysqli_query($conn, $query);

    echo '<form class="filter-form" action="bronnen.php" method="post">';
    while($row = mysqli_fetch_array($result)){
        echo '<div class="radio">';
        echo '<label><input type="radio" name="categorie" value="' . $row['category_name'] . '"> ' . $row['category_name'] . '</label>';
        echo '</div>';
    }
    echo "<input type='submit' value='Filter' class='btn btn-primary filterbtn'>";
    echo "<hr>";
    echo '</form>';
}

function FilterCategorie($conn){
    $categorie = $_POST['categorie'];

    $query = "SELECT c.category_name, a.ArtikelTitel, a.ArtikelSamenvatting, a.ArtikelLink, a.ArtikelRank FROM Artikelen a JOIN category c ON a.category_id = c.category_id WHERE category_name = '$categorie' ORDER BY ArtikelRank ASC";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($result)) {
        echo "<table class='categorie'>";
        echo "<tbody>";
        echo "<tr><th>" . $row['ArtikelTitel'] . "</th></tr>";
        echo "<tr><td>" . $row['ArtikelSamenvatting'] . "</td></tr> ";
        echo "<tr><td>Categorie: " . $row['category_name'] . "</td></tr>";
        echo "<tr><td><a href='" . $row['ArtikelLink'] . "' target='_blank'>" . $row['ArtikelLink'] . "</a>" . "</td></tr>";
        echo "</tbody>";
        echo "</table>";
        echo "<hr>";
    }
}

function ShowArtikelen($conn){
    $query = "SELECT c.category_name, a.ArtikelTitel, a.ArtikelSamenvatting, a.ArtikelLink, a.ArtikelRank FROM Artikelen a JOIN category c ON a.category_id = c.category_id ORDER BY ArtikelRank ASC";
    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_array($result)){
        echo "<table class='categorie'>";
        echo "<tbody>";
        echo "<tr><th>" . $row['ArtikelTitel'] . "</th></tr>";
        echo "<tr><td>" . $row['ArtikelSamenvatting'] . "</td></tr> ";
        echo "<tr><td>Categorie: " . $row['category_name'] . "</td></tr>";
        echo "<tr><td><a href='" . $row['ArtikelLink'] . "' target='_blank'>" . $row['ArtikelLink'] . "</a>" . "</td></tr>";
        echo "</tbody>";
        echo "</table>";
        echo "<hr>";
    }
}

function ShowZoekResultaat($conn){
    $search = $_POST['search'];

    $query = "SELECT c.category_name, a.ArtikelTitel, a.ArtikelSamenvatting, a.ArtikelLink, a.ArtikelRank FROM Artikelen a JOIN category c ON a.category_id = c.category_id WHERE ArtikelTitel LIKE '%$search%' OR ArtikelSamenvatting LIKE '%$search%' ORDER BY ArtikelRank ASC ";
    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_array($result)){
        echo "<table class='categorie'>";
        echo "<tbody>";
        echo "<tr><th>" . $row['ArtikelTitel'] . "</th></tr>";
        echo "<tr><td>" . $row['ArtikelSamenvatting'] . "</td></tr> ";
        echo "<tr><td>Categorie: " . $row['category_name'] . "</td></tr>";
        echo "<tr><td><a href='" . $row['ArtikelLink'] . "' target='_blank'>" . $row['ArtikelLink'] . "</a>" . "</td></tr>";
        echo "</tbody>";
        echo "</table>";
        echo "<hr>";
    }
}
?>
<body>
<h1 class="titel">BiNaSk</h1>
<?php include "navbar.php" ?>
<div class="container">
    <div class="row">
        <div class="col-xs-8">
            <h1>Bronnen</h1>
        </div>
        <div class="col-xs-4">
            <form class="search-bar" action="bronnen.php" method="post">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <hr class="split">
    <div class="row">
        <div class="col-xs-3 filter">
            <h4><b>Filters</b></h4>
            <hr>
            <h5><b>Categorie</b></h5>
            <?php
            ShowCategories($conn);
            ?>
        </div>
        <div class="col-xs-9 bronnen">
            <?php
            if (!empty($_POST['categorie'])) {
                FilterCategorie($conn);
            }
            elseif(!empty($_POST['search'])) {
                ShowZoekResultaat($conn);
            }
            else {
                ShowArtikelen($conn);
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>