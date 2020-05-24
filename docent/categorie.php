<?php
include "../database.php";
include "docentcheck.php";
include "../validatie.php";

$status = "";
$editID = "";
$name = "";

if (isset($_POST['add'])){
    if (empty($_POST['editID'])) {
        $catName = test_input($_POST['catName']);
        $sql = "INSERT INTO category (category_name) VALUES ('$catName')";
        if ($conn->query($sql) === TRUE) {
            $status = "Toegevoegd!";
        } else {
            $status = $sql . "<br>" . $conn->error;
        }
    } else {
        $catName = test_input($_POST['catName']);
        $catID = test_input($_POST['editID']);
        $sql = "UPDATE category SET category_name = '$catName' WHERE category_id = $catID ";
        if ($conn->query($sql) === TRUE) {
            $status = "Aangepast!";
        } else {
            $status = $sql . "<br>" . $conn->error;
        }
    }

} elseif (isset($_POST['delete'])) {
    $catID = test_input($_POST['id']);
    $sql = "DELETE FROM category WHERE category_id = $catID";
    if ($conn->query($sql) === TRUE) {
        $status = "Verwijderd!";
    } else {
        $status = $sql . "<br>" . $conn->error;
    }
} elseif (isset($_POST['edit'])) {
    $editID = test_input($_POST['id']);
    $name = test_input($_POST['name']);
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
    <h1>Categorie Manager</h1>
    <h4>Categorieën toevoegen, bewerken en verwijderen</h4>
    <hr class="split">
    <div class="row">
        <div class="col-sm-12">
            <form class="" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <p class="titel"><?php echo $status ?></p>
                <div class="form-group">
                    <label for="catID"><b>ID:</b></label>
                    <input class="form-control input-md" type="text" name="catID" id="catID"  disabled value="<?php echo $editID; ?>">
                    <input class="form-control" type="text" name="editID" id="editID" hidden="hidden" value="<?php echo $editID; ?>">
                </div>
                <div class="form-group">
                    <label class="labels"><b>Naam:</b></label>
                    <input class="form-control input-md" type="text" placeholder="Naam" name="catName" id="catName" value="<?php echo $name; ?>" required>
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
            <th>Naam</th>
            <th style="width: 16%;"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT category_id, category_name FROM category ORDER BY category_id ASC";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)){
            $id = $row['category_id'];
            $name = $row['category_name'];
            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$name</td>";
            echo "<form action='categorie.php' method='post'>";
            echo "<input type='text' value='$id' name='id' hidden='hidden'>";
            echo "<input type='text' value='$name' name='name' hidden='hidden'>";
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