<?php
require 'admin/database.php';

if (!empty($_GET['id'])) {
    $id = checkInput($_GET['id']);
}

$db = Database::connect();
$statement = $db->prepare('SELECT albums.id,albums.name,albums.artist,albums.price,albums.image,genres.name AS genre FROM albums LEFT JOIN genres ON albums.genre=genres.id
WHERE albums.id=?');
$statement->execute(array($id));
$item = $statement->fetch();
/*Database::disconnect();*/

function checkInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<!DOCTYPE html>
<html lang="">

<head>
    <title>view</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <div class="container admin">
        <div class="row">
            <div class="col-sm-6">
                <h1><strong>Voir un item</strong></h1>
                <br>
                <?php echo ' ' . $item['name']; ?>
                <div class="form-actions">
                    <a href="index.php" class="btn btn-primary"> <span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 site">
                <div class="thumbnail">
                    <img src="<?php echo 'images/' . $item['image']; ?>" alt="">
                    <div class="price"><?php echo number_format((float)$item['price'], 2, '.', ''); ?></div>
                    <div class="caption">
                        <h4><?php echo $item['name'], $item['name']; ?></h4>
                        <p><?php echo $item['artist']; ?></p>
                        <a href="#" class="btn btn-order" role="button"> <span class="glyphicon glyphicon-shopping-cart"></span> acheter</a>

                    </div>

                </div>

            </div>
        </div>
    </div>
</body>

</html>