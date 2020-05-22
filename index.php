<?php include "session.php";
include "head.php";
?>
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
                $query = "SELECT DISTINCT c.category_name FROM Artikelen a JOIN category c ON a.category_id = c.category_id ORDER BY c.category_name, ArtikelRank";
                $result = mysqli_query($conn, $query);

                while($row = mysqli_fetch_array($result)){
                    echo "<p>•" . $row['category_name'] . "</p>";
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