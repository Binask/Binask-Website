<?php include "session.php";
include "head.php";
?>
<body>
<h1 class="titel">BiNaSk</h1>
<?php include "navbar.php" ?>
<div class="container">
    <div class="row">
        <h1>Hallo <?php echo $user_firstname . '!'; ?></h1>
        <p>Welkom bij de startpagina! Vanuit hier kunt u zich navigeren naar de bronnen die u zoekt. Hieronder staat ook nog een overzicht met alle categorieën.</p>
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
    </div>
</div>
</body>
</html>