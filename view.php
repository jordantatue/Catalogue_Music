<?php
    require 'admin/database.php';
    require 'index.php';


    class view{

    public static function article($x){
        echo ' <nav class="navbar navbar-inverse"> 
        <div class="container-fluid-center">
            <a href="#" class="navbar-brand">fUll MuZiC</a>
        </div>
        </nav>';

        $db = Database::connect();
        $statement = $db->prepare('SELECT * FROM albums WHERE albums.id = ?');
        $statement->execute($x);
        
        echo '<div class="row">';
        while ($item = $statement->fetch()) {
            echo '  <div class="col-xs-12 col-md-6">
                    <div class="thumbnail">
                    <img src="images/' . $item['image']  . '" alt="Turn Up the Quiet">
                        <div class="prize">' . number_format((float)$item['price'], 2, '.', '') . ' €</div>
                        <div class="caption">
                            <h4>Turn Up the Quiet</h4>
                            <p><i>Artiste: </i>' . $item['artist'] . '</p>
                            <a href ="" ><button id = "' . $item['id']  . '" type="button" class="btn btn-order button-modal" data-album="20">
                                Voir le détail
                            </button></a>
                        </div>
                    </div>
                </div>';
        }
            
    }

    }
    
?>