<?php require('includes/sql.php'); ?>
<?php require('includes/user.php'); ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <h2>Formulaire de recherche</h2>
        <form action="index.php" method="get">
            <input type="text" name="city" placeholder="enter city">
            <input type="submit" value="search">
        </form>

        <?php
            if (isset($_GET['city'])) { // si l'utilisateur saisi une ville
                $cityNameToFind = $_GET['city'];
                if ($result = $mysqli->query("SELECT * FROM city WHERE name = '$cityNameToFind'")) { // test de l'existence de la ville par son nom
                    if ($city = $result->fetch_array()) {
                        $cityId = $city['id'];
                        $mysqli->query("INSERT INTO search (user_id, city_id) VALUES ($userId, $cityId)"); // si la ville existe alors on enregistre la recherche
                    } else {
                        echo "La ville $cityNameToFind n'existe pas.";
                    }
                }
            }
        ?>

        <h2>Historique de vos recherches</h2>
        <ul>
            <?php if ($result = $mysqli->query("SELECT city.id as id, city.name as name FROM city INNER JOIN search ON city.id = search.city_id WHERE search.user_id = $userId ORDER BY search.id DESC")) : ?>
                <?php while ($city = $result->fetch_array()) : ?>
                    <li><a href="city.php?id=<?php echo $city['id']; ?>"><?php echo $city['name']; ?></a></li>
                <?php endwhile; ?>
            <?php endif; ?>
        </ul>

    </body>
</html>
