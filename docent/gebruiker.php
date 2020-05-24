<?php
include "../database.php";
include "docentcheck.php";
include "../validatie.php";

$status = "";

$editID = "";
$firstname = "";
$lastname = "";
$email = "";
$usertype = "";

if(isset($_POST['bewerken'])){
    if(!empty($_POST['editID'])){
        $userID = test_input($_POST['editID']);
        $userFirstname = test_input($_POST['userFirstname']);
        $userLastname = test_input($_POST['userLastname']);
        $userEmail = test_input($_POST['userEmail']);
        $userUsertype = test_input($_POST['userUsertype']);

        $sql = $conn->prepare("UPDATE user SET user_id = ?, firstname = ?, lastname = ?, email = ?, usertype = ? WHERE user_id = ?");
        $sql->bind_param("issssi", $userID, $userFirstname, $userLastname, $userEmail, $userUsertype, $userID);
        if ($sql->execute()) {
            $status = "Bewerkt!";
        } else {
            $status = $sql . "<br>" . $conn->error;
        }
    }else{
        echo $status = "Kies een gebruiker";
    }
} elseif (isset($_POST['delete'])) {
    $userID = $_POST['id'];
    $sql = $conn->prepare("DELETE FROM user WHERE user_id = ?");
    $sql->bind_param("i", $userID);
    if ($sql->execute()) {
        $status = "Verwijderd!";
    } else {
        $status = $sql . "<br>" . $conn->error;
    }
} elseif (isset($_POST['edit'])) {
    $editID = test_input($_POST['id']);
    $firstname = test_input($_POST['firstname']);
    $lastname = test_input($_POST['lastname']);
    $email = test_input($_POST['email']);
    $usertype = test_input($_POST['usertype']);
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
    <h1>Gebruikers Manager</h1>
    <h4>Gebruikers bewerken en verwijderen</h4>
    <hr class="split">
    <div class="row">
        <div class="col-sm-12">
            <form class="" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <p class="titel"><?php echo $status ?></p>
                <div class="form-group">
                    <label for="userID"><b>ID:</b></label>
                    <input class="form-control input-md" type="text" name="userID" id="userID"  disabled value="<?php echo $editID; ?>">
                    <input class="form-control" type="text" name="editID" id="editID" hidden="hidden" value="<?php echo $editID; ?>">
                </div>
                <div class="form-group">
                    <label class="labels"><b>Firstname:</b></label>
                    <input class="form-control input-md" type="text" placeholder="Firstname" name="userFirstname" id="userFirstname" value="<?php echo $firstname; ?>" required>
                </div>
                <div class="form-group">
                    <label class="labels"><b>Lastname:</b></label>
                    <input class="form-control input-md" type="text" placeholder="Lastname" name="userLastname" id="userLastname" value="<?php echo $lastname; ?>" required>
                </div>
                <div class="form-group">
                    <label class="labels"><b>Email:</b></label>
                    <input class="form-control input-md" type="email" placeholder="Email" name="userEmail" id="userEmail" value="<?php echo $email; ?>" required>
                </div>
                <div class="form-group">
                    <label class="labels"><b>Usertype:</b></label>
                    <input class="form-control input-md" type="text" placeholder="Usertype" name="userUsertype" id="userUsertype" value="<?php echo $usertype; ?>" required>
                </div>
                <button class="btn btn-sm btn-primary" name="bewerken" type="submit">Bewerken</button>
            </form>
        </div>
    </div>
    <hr>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Usertype</th>
            <th style="width: 16%;"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT user_id, firstname, lastname, email, usertype FROM user ORDER BY user_id ASC";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)){
            $editID = $row['user_id'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $email = $row['email'];
            $usertype = $row['usertype'];
            echo "<tr>";
            echo "<td>$editID</td>";
            echo "<td>$firstname</td>";
            echo "<td>$lastname</td>";
            echo "<td>$email</td>";
            echo "<td>$usertype</td>";
            echo "<form action='gebruiker.php' method='post'>";
            echo "<input type='text' value='$editID' name='id' hidden='hidden'>";
            echo "<input type='text' value='$firstname' name='firstname' hidden='hidden'>";
            echo "<input type='text' value='$lastname' name='lastname' hidden='hidden'>";
            echo "<input type='text' value='$email' name='email' hidden='hidden'>";
            echo "<input type='text' value='$usertype' name='usertype' hidden='hidden'>";
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