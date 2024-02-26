<header>
    <nav class="navbar">
        <a href="http://localhost/e-commerce-PHP/"><img src="http://localhost/e-commerce-PHP/assets/img/Black-Prestige.png" alt="Logo Y’Cross" class="logo" id="logo" /></a>
        <div class="right-menu">
            <a class="nav-link" href="http://localhost/e-commerce-PHP/products/">Shop</a>
            <a class="nav-link" href="http://localhost/e-commerce-PHP/marketplace/">Marketplace</a>
            <a class="nav-link" href="http://localhost/e-commerce-PHP/about/">À Propos</a>
            <a class="nav-link" href="http://localhost/e-commerce-PHP/contact/">Nous contacter</a>
            <?php if (@$_SESSION["user"]) {
                echo '<a class="nav-link" href="http://localhost/e-commerce-PHP/profil/">Profil</a><a class="nav-link" href="http://localhost/e-commerce-PHP/cart/">Panier</a>
                        <form action="http://localhost/e-commerce-PHP/utils/disconnect.php">
                            <input type="submit" class="nav-link btn btn-dark text-white" name="disconnect" value="disconnect" />
                        </form>';
            } else {
                echo '<a class="nav-link btn btn-dark text-white" href="http://localhost/e-commerce-PHP/login/">Connexion</a>';
            }
            ?>

        </div>
    </nav>
</header>
