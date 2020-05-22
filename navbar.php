<nav class="navbar navbar-default">
        <?php
        if (isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"])) {
            echo "<ul class=\"nav navbar-nav\">";
            echo "<li><a href=\"index.php\">Startpagina</a></li>";
            echo "<li><a href=\"bronnen.php\">Bronnen</a></li>";
            echo "</ul>";
            echo "<ul class=\"nav navbar-nav navbar-right\">";
            echo "<li><a href=\"logout.php\">Uitloggen</a></li>";
            echo "</ul>";
            if ($_SESSION["user_type"] == "docent") {
                echo "<ul class=\"nav navbar-nav navbar-right\">";
                echo "<li><a href=\"docent/index.php\">Docenten Pagina</a></li>";
                echo "</ul>";
            }
        }else {
            echo "<ul class=\"nav navbar-nav navbar-right\">";
            echo "<li><a href=\"login.php\">Log in</a></li>";
            echo "<li><a href=\"registratie.php\">Registreer</a></li>";
            echo "</ul>";
        }
        ?>
</nav>