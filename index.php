<?php
// prise d'information sur la section actuelle
session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Prestige</title>
    <link href="CSS/style.css" rel="stylesheet" id="css" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
</head>

<?php
// Mise à jour des produits
require_once('utils/generate_product_page.php'); ?>
<script type="text/javascript">
    async function colorSwitch() {
        console.log("CLICKED")
        const css = document.getElementById("css");

        const logo = document.getElementById("logo");
        const watch = document.getElementById("watch");
        const price = document.getElementById("price")

        const left = document.getElementById("left-button")
        const right = document.getElementById("right-button")

        await new Promise(r => setTimeout(r, 1));
        switch (window.location.hash) {
            case "#patek":
                logo.src = "assets/img/White_Prestige.png"
                watch.src = "assets/img/watches/Capture d'écran 2024-02-23 151134.png"
                css.href = "CSS/patek.css"
                left.href = "#"
                right.href = "#rolex"
                price.innerHTML = "50.000 €"
                break;
            case "#daytona":
                logo.src = "assets/img/White_Prestige.png"
                watch.src = "assets/img/watches/rolex-pepsi (1).png"
                css.href = "CSS/daytona.css"
                left.href = "#rolex"
                right.href = "#"
                price.innerHTML = "20.000 €"
                break;
            case "#rolex":
                logo.src = "assets/img/Black-Prestige.png"
                watch.src = "assets/img/watches/Rolex.png"
                css.href = "CSS/rolex.css"
                left.href = "#patek"
                right.href = "#daytona"
                price.innerHTML = "30.000 €"
                break;
            default:
                logo.src = "assets/img/Black-Prestige.png"
                watch.src = "assets/img/watches/Watches.png"
                css.href = "CSS/style.css"
                left.href = "#daytona"
                right.href = "#patek"
                price.innerHTML = "25.000 €"
                break;

        }

    }
</script>

<body>
    <div class="container">
        <?php include("navbar.php") ?>

        <div class="row">
            <div class="col-md-6">
                <h1>Montre Exclusif</h1>
                <p class="tagline">
                    Choisissez le Luxe,<a class="text-black">Choisissez Nous.</a>
                </p>
                <p class="Bienvenue">
                    Découvrez la Montre Parfaite pour Chaque Occasion et Élevez Votre
                    Style avec une Élégance Intemporelle et un Savoir-Faire de
                    Précision.
                </p>
                <div class="price-tag mb-4">
                    <span class="price" id="price">25.000 €</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="carousel-controls">
                    <a href="#daytona" class="rond" id="left-button" onclick="colorSwitch()">
                        < </a>
                            <img src="assets/img/watches/Watches.png" alt="watch" id="watch" class="img-fluid" />
                            <!-- <button href="./rolex.html" class="rond">></></button> -->
                            <a href="#patek" class="rond" id="right-button" onclick="colorSwitch()">></a>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>


</html>