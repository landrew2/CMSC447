<?php

$query = "SELECT * FROM Profile";
$results = $db_connection->query($query);

   
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Profile</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
        <table class='table'>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Abilities</th>
                </tr>
            </thead>
            <tbody>
                <?php
                 foreach($results as $results){
                ?>
                    <tr>
                     <td><?php echo $results['name']?></td>
                     <td><?php echo $results['zipcode']?></td>
                     <td><?php
                     if($results['abilities'] == fire){
                         echo "fire";
                     }elseif($results['abilities'] == water){
                         echo "water",
                     }elseif($results['abilities'] == crime){
                        echo "crime",
                    }elseif($results['abilities'] == general){
                        echo "general",
                    }
                    ?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        </div>
    </body>
</html>