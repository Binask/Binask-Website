<?php
include "database.php";

$firstnameErr = $lastnameErr = $emailErr = $passwordErr = $repeatpasswordErr = "";
$firstname = $lastname = $email = $password = $repeatpassword = $hashedpassword = "";



if (!empty($_POST)) {

    //kijkt als er een voornaam ingevuld is
    if (empty($_POST["firstname"])) {
        $firstnameErr = "Dit veld mag niet leeg zijn!";
    } else {
        $firstname = test_input($_POST["firstname"]);
    }

    //kijkt als er een achternaam ingevuld is
    if (empty($_POST["lastname"])) {
        $lastnameErr = "Dit veld mag niet leeg zijn!";
    } else {
        $lastname = test_input($_POST["lastname"]);
    }

    //kijkt als er een email ingevuld is
    if (empty($_POST["email"])) {
        $emailErr = "Dit veld mag niet leeg zijn!";
    } else {
        $email = test_input($_POST["email"], FILTER_VALIDATE_EMAIL);
    }

    //kijkt als er geen andere email bestaat
    $check = "SELECT email FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $check);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        $emailErr = "Dit account bestaat al!";
    }

    //kijkt als er een NHL-stenden email gebruikt wordt
    if (preg_match("/(student.nhlstenden|nhlstenden)/i", $email)) {
        //echo "werkt";
    } else {
        $emailErr = "Gebruik een NHL-Stenden emailadres!";
    }

    //kijkt als er een password ingevuld is
    if (empty($_POST["password"])) {
        $passwordErr = "Dit veld mag niet leeg zijn!";
    } else {
        $password = test_input($_POST["password"]);
    }

    //kijkt als er een herhaalde password ingevuld is
    if (empty($_POST["repeatpassword"])) {
        $passwordErr = "Dit veld mag niet leeg zijn!";
    } else {
        $repeatpassword = test_input($_POST["repeatpassword"]);
    }

    //kijkt als herhaalde password en password gelijk zijn
    //als herhaalde password en password gelijk zijn dan wordt de password gehashed met md5
    if ($password == $repeatpassword) {
        $hashedpassword = md5($password);
    } else {
        $repeatpasswordErr = "Wachtwoorden zijn niet hetzelfde!";
    }

    //bij foutmelding worden de errors op het scherm weergegeven
    $errors = $emailErr . $passwordErr . $repeatpasswordErr;
    //echo $errors;

    //als er geen errors zijn dan wordt de volgende stuk code gevoerd
    if (empty($errors) == true) {
        //SQL Query voor her invoeren van al de gegevens, iedereen krijgt eerst als usertype student
        $sql = "INSERT INTO user(firstname, lastname, email, password, usertype) VALUES ('$firstname', '$lastname', '$email', '$hashedpassword', 'student')";
        //SQL Query uitvoeren en in de variabele $result verwerken
        $result = mysqli_query($conn, $sql);
        //SQL Query op de scherm weergeven
        //echo $sql;

        //als er geen foutmeldingen zijn wordt je omgeleid naar de login pagina
        if ($result == true) {
            header('location: login.php');
        } else {
            //bij een foutmelding wordt de foutmelding op het scherm geprint
            echo mysqli_errno();
        }
        //als alles klaar is databaseconnectie sluiten
        mysqli_close($conn);
    }
}
include "head.php";
?>
<body>
<h1 class="titel">BiNaSk</h1>
<?php include "navbar.php" ?>
<form class="form-registratie" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <h1 class="h1 mb-3 text-center">Registratie</h1>
    <div class="form-group">
        <label class="labels" for="voornaam"><b>Voornaam:</b></label>
        <input class="form-control input-lg" type="text" placeholder="Voornaam" name="firstname" required>
        <span class="error"><span class="red"><?php echo $firstnameErr; ?></span></span>
    </div>
    <div class="form-group">
        <label class="labels" for="achternaam"><b>Achternaam:</b></label>
        <input class="form-control input-lg" type="text" placeholder="Achternaam" name="lastname" required>
        <span class="error"><span class="red"><?php echo $lastnameErr; ?></span></span>
    </div>
    <div class="form-group">
        <label class="labels" for="email"><b>Email:</b></label>
        <input class="form-control input-lg" type="text" placeholder="Email" name="email" required>
        <span class="error"><span class="red"><?php echo $emailErr; ?></span></span>
    </div>
    <div class="form-group">
        <label class="labels" for="password"><b>Wachtwoord:</b></label>
        <input class="form-control input-lg" type="password" placeholder="Wachtwoord" name="password" required>
        <span class="error"><span class="red"><?php echo $passwordErr; ?></span></span>
    </div>
    <div class="form-group">
        <label class="labels" for="repeatpassword"><b>Herhaal wachtwoord:</b></label>
        <input class="form-control input-lg" type="password" placeholder="Herhaal Wachtwoord" name="repeatpassword"
               required>
        <span class="error"><span class="red"><?php echo $repeatpasswordErr; ?></span></span>
    </div>
    <button class="btn btn-lg btn-primary btn-block" name="register" type="submit">Registreren</button>
</form>
</body>
</html>