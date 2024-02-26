<?php session_start() ?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>À Propos - Prestige</title>
  <link href="../CSS/about.css" rel="stylesheet" />
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
  <div class="container">
    <?php include("../navbar.php") ?>
    <script>
      const logo = document.getElementById("logo")
      logo.src = "../assets/img/White_Prestige.png"
    </script>

    <main>
      <h1>À Propos de Notre Équipe</h1>
      <div class="team">
        <div class="person">
          <div class="sajed">
          <h2>Sajed (Front-End)</h2>
          <p>
            Sajed s'est occupé du design des différentes pages telles que
            l'authentification, le profil, le panier, etc. Il a également géré
            le routage et la gestion de l'authentification de l'utilisateur.
            De plus, il a travaillé sur le front du dashboard.
          </p>
          <div class="social-links">
            <a href="https://www.linkedin.com/in/sajed-benyoussef" target="_blank">LinkedIn</a>
            <a href="https://github.com/Sajedd" target="_blank">GitHub</a>
            <a href="lien_vers_cv_de_Sajed" target="_blank">CV</a>
            </div>
          </div>
        </div>
        <div class="person">
          <h2>Marc (Front-End)</h2>
          <p>
            Marc a collaboré avec Sajed sur le front-end en s'occupant
            notamment du design et de l'ergonomie des différentes pages. Il a
            également travaillé sur le design du dashboard.
          </p>
          <div class="social-links">
            <a href="lien_vers_linkedIn_de_Marc" target="_blank">LinkedIn</a>
            <a href="lien_vers_github_de_Marc" target="_blank">GitHub</a>
            <a href="lien_vers_cv_de_Marc" target="_blank">CV</a>
          </div>
        </div>
        <div class="person">
          <h2>Abdoulaye (Back-End)</h2>
          <p>
            Abdoulaye a été responsable de la création et de l'implémentation
            de la base de données. Il a également développé les API CRUD pour
            la gestion des produits et des utilisateurs, ainsi que le
            dashboard pour les administrateurs.
          </p>
          <div class="social-links">
            <a href="lien_vers_linkedIn_de_Abdoulaye" target="_blank">LinkedIn</a>
            <a href="lien_vers_github_de_Abdoulaye" target="_blank">GitHub</a>
            <a href="lien_vers_cv_de_Abdoulaye" target="_blank">CV</a>
          </div>
        </div>
        <div class="person">
          <h2>Miyad (Back-End)</h2>
          <p>
            Miyad a contribué au développement du back-end en travaillant sur
            les fonctionnalités de CRUD pour les produits et les utilisateurs.
            Il a également participé à la conception du dashboard
            administrateur et à la gestion de la sécurité des accès.
          </p>
          <div class="social-links">
            <a href="https://www.linkedin.com/in/miyad-youssouf-ali-1ba879289/" target="_blank">LinkedIn</a>
            <a href="https://github.com/youssoufmiyad" target="_blank">GitHub</a>
            <a href="CV/cv_Miyad.pdf" target="_blank">CV</a>
          </div>
        </div>
      </div>
    </main>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>