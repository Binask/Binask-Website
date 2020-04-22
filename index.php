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
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php">Uitloggen</a></li>
    </ul>
</nav>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="hbtext">
                    <h1>Welkom!</h1>
                    <p class="welkomtext">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Mollitia laborum, illum velit aspernatur dolore odio, blanditiis excepturi, suscipit et fugit iste. Blanditiis sequi eum nobis libero? Fugiat voluptas illo temporibus pariatur eaque assumenda doloribus? Maiores consequuntur molestias libero dolor in sit dicta perferendis dolores adipisci labore. Hic, pariatur atque ipsam accusamus reiciendis officiis voluptates perspiciatis error corporis delectus similique magni quas animi quasi earum aut sint doloremque nihil quia blanditiis!</p>
                </div>
                <div class="categorieen">
                    <h2 >Categorieën</h2>
                    <p>•Lorem ipsum dolor sit amet.</p>
                    <p>•Lorem ipsum dolor sit amet consectetur.</p>
                    <p>•Lorem ipsum dolor sit.</p>
                    <p>•Lorem ipsum dolor sit amet.</p>
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