<!-- prise d'information sur la section actuelle -->
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profil</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<?php
// Import de la connection à la database sous la forme de la variable "$db"
require_once('../utils/connect.php');
?>

<body>
    <?php
    try {
        echo $_SESSION["user"]["userId"];
        $image = $db->query("SELECT Image FROM users_photo WHERE UserId=" . $_SESSION["user"]["userId"] . ";");
        $image = $image->fetch_assoc();
        $base64img = @base64_encode($image["Image"]);
        $src = "data:image/jpg;base64," . $base64img;
    } catch (\Throwable $th) {
        throw $th;
    }

    ?>
    <!-- photo de profil -->
    <img src="<?php echo $src ?>" alt="pfp" width="360px" height="360px">
    <!-- prénom NOM -->
    <div class="user-name">
        <?php echo $_SESSION["user"]["lastName"] . " " . $_SESSION["user"]["firstName"] ?>
    </div>
</body>

</html>