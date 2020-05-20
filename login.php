<?php
include "database.php";

//sessie starten
session_start();

//de login error variabele initialiseren
$loginErr = "";

//als er iets gepost is, word de volgende stuk code uitgevoerd
//de ingevoerde password wordt gehashed door MD5
if (!empty($_POST)) {
    $email = (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL));
    $password = md5(($_POST["password"]));

    //sql query die de code, email en password van de tabel ophaalt, en voor login wordt email en password gebruikt
    $sql = $conn->prepare("SELECT user_id, firstname, lastname, email, password, usertype FROM user WHERE email = ? AND password = ?");
    $sql->bind_param("ss", $email, $password);
    $sql->execute();
    $result = $sql->get_result() or die("Error");
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    //de geretourneerde waarde worden gepost om het in de website te kunnen gebruiken
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        session_start();
        $_SESSION["user_id"] = $row["user_id"];
        $_SESSION["user_login"] = $email;
        $_SESSION["user_firstname"] = $row["firstname"];
        $_SESSION["user_lastname"] = $row["lastname"];
        $_SESSION["user_type"] = $row["usertype"];

        header('location: index.php');
    } else {
        //bij een verkeerde email of wachtwoord wordt er een melding gegeven
        $loginErr = "Verkeerde email en/of wachtwoord";
    }
    //als alles klaar is databaseconnectie sluiten
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Inloggen</title>
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

<form class="form-login" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <h1 class="h1 mb-3 text-center">Inloggen</h1>
    <div class="form-group">
        <label class="labels" for="email"><b>Email:</b></label>
        <input class="form-control input-lg" type="email" placeholder="Email" name="email" required>
    </div>
    <div class="form-group">
        <label class="labels" for="psw"><b>Wachtwoord:</b></label>
        <input class="form-control input-lg" type="password" placeholder="Wachtwoord" name="password" required>
        <span class="error"><span class="red"><?php echo $loginErr; ?></span></span>
    </div>
    <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Inloggen</button>
</form>

</body>
</html>