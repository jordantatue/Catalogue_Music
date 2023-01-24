<!DOCTYPE html>
<html>

<head>
    <title>ZoO albums</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body class="container">
    <?php
    require 'admin/database.php';
    echo ' <nav class="navbar navbar-inverse"> 
        <div class="container-fluid">
        <div class="navbar-header">
            <a href="#" class="navbar-brand">fUll MuZiC</a>
        </div>
        <ul class="nav navbar-nav navbar-right">';

    $db = Database::connect();
    $statement = $db->query('SELECT * FROM genres');
    $category = $statement->fetchAll();
    foreach ($category as $cat) {
        if ($cat['id'] == '1')
            echo '<li role="presentation" data-genres="' . $cat['id'] . '" class="active"><a href="#' . $cat['id'] . '"data-toggle="tab">' . $cat['name'] . '</a></li>';
        else
            echo '<li role="presentation"><a href="#' . $cat['id'] . '"data-toggle="tab">' . $cat['name'] . '</a></li>';
    }
    echo ' </ul>
        </div>
        </nav>';
    echo '<div class="tab-content">';
    foreach ($category as $cat) {
        if ($cat['id'] == '1')
            echo '<div class="tab-pane active" id="' . $cat['id'] . '">';
        else
            echo '<div class="tab-pane" id="' . $cat['id'] . '">';


        echo '<div class="row">';

        $statement = $db->prepare('SELECT * FROM albums WHERE albums.genre = ?');
        $statement->execute(array($cat['id']));

        while ($item = $statement->fetch()) {
            echo '  <div class="col-xs-12 col-md-6">
                        <div class="thumbnail">
                        <img src="images/' . $item['image']  . '" alt="Turn Up the Quiet">
                            <div class="prize">' . number_format((float)$item['price'], 2, '.', '') . ' €</div>
                            <div class="caption">
                                <h4>' . $item['name'] . '</h4>
                                <p><i>Artiste: </i>' . $item['artist'] . '</p>
                                <button type="button" class="btn btn-order button-modal" data-toggle="modal" data-target="#elt' . $item['id'] . '">
                    Voir le détail
                </button>
                            </div>
                        </div>
                    </div>';
        }
        echo '</div>
                    </div>';
    }

    $statement = $db->query("SELECT*FROM albums");
    $albums = $statement->fetchAll();
    foreach ($albums as $albums) {
        echo '<div class="modals">';
        echo ' <div class="modal fade" id="elt' . $albums['id'] . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">';
        echo '    <div class="modal-dialog" role="document">';
        echo '<div class="modal-content">';
        echo '<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="' . $albums['id'] . '">' . $albums['image'] . '</h4>
            </div>';
        echo '<div class="modal-body">
                <div class="thumbnail">';
        echo '<img class="image" src="images/' . $albums['image'] . '" alt="">';
        echo '<div class="prize">' . $albums['price'] . '€</div>
                        <div class="caption">';
        echo '<h4><span class="titre">' . $albums['name'] . '</span> (<span class="annee">' . $albums['year'] . '</span>)</h4>';
        echo '<p><i>Artiste: </i><b class="artist">' . $albums['artist'] . '</b></p>';
        echo '<p class="description"></p>
                            <p><a class="btn btn-order" role="button" href="#">Acheter</a></p>
                        </div>
                    </div>
                </div>';
        echo '<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                </div>';
        echo '</div>
           </div>
       </div></div>';
        Database::disconnect();
    }
    ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>




</body>

</html>