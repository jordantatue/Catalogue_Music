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
    <div class="modals">
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        <div class="thumbnail">
                            <img class="image" src="" alt="">
                            <div class="prize"></div>
                            <div class="caption">
                                <h4><span class="titre"></span> (<span class="annee"></span>)</h4>
                                <p><i>Artiste: </i><b class="artist"></b></p>
                                <p class="description"></p>
                                <p><a class="btn btn-order" role="button" href="#">Acheter</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container site">
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
                                <h4>Turn Up the Quiet</h4>
                                <p><i>Artiste: </i>' . $item['artist'] . '</p>
                                <a href ="view ::article('.$item['id'].')" ><button id = "' . $item['id']  . '" type="button" class="btn btn-order button-modal" data-album="20">
                                    Voir le détail
                                </button></a>
                            </div>
                        </div>
                    </div>';
            }
            echo '</div>
                    </div>';
        }
        Database::disconnect();
        echo '</div>';
        ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script>
        $(document).on("click", "button.btn", function() {
            alert('clike');
            echo();
        });
    </script>

    <script>
        $(document).on("click", "button.btn", function() {
            var data = "album=" + $(this).attr("data-album");
            var modal = $("#modal");
            $.ajax({
                url: "view.php",
                type: "GET",
                dataType: 'json',
                data: data,
                success: function(result) {
                    $(modal).find(".modal-title").html(result['name']);
                    $(modal).find(".image").attr("src", "images/" + result['image']);
                    $(modal).find(".prize").html(result['price'] + " €");
                    $(modal).find(".titre").html(result['name']);
                    $(modal).find(".annee").html(result['year']);
                    $(modal).find(".artist").html(result['artist']);
                    $(modal).find(".format").html(result["format"]);
                    $(modal).modal("show");
                }
            });
        });
    </script>


</body>

</html>