<?php require('includes/sql.php') ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
    </head>
    <body>
        <?php
            if (isset($_GET['id'])) { // si un id de ville est passé en GET
                $cityId = $_GET['id'];
                if ($result = $mysqli->query("SELECT * FROM city WHERE id = '$cityId'")) { // on vérifie l'existence de la ville par son id
                    $city = $result->fetch_array();
                }
            }
        ?>

        <?php if (isset($city)) : ?>
            <h2>Détails de la ville</h2>
            <table>
                <tr>
                    <td><?php echo $city['id']; ?></td>
                    <td><?php echo $city['name']; ?></td>
                </tr>
            </table>
        <?php else : ?>
            Cette ville n'existe pas.
        <?php endif; ?>

    </body>
</html>
