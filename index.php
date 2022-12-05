<?php

require 'autoloader/loader.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo Game</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    


<div class="container" style="margin-top:70px !important;">
<div class="row">
    <div class="col-md-6">
    <h1>Demo Game</h1>
    </div>

    <div class="col-md-6">
    <button class="btn btn-info countdown1">60</button>
    <button class="btn btn-info countdown">20</button>
    <span class="res">
    <button class="btn btn-success rtest" style="background-color:black !important;"><span class="results">No bet</span></button>

    
</span>
<button class="btn btn-default win"></button>

    </div>
</div>
<br><br><br>

<div class="card w-80">
  <div class="card-body">
    <div class="row">
        <div class="col-md-8">
            
            <p class="card-text">
                <?php
                $game = new game();
                echo $game->generatenumbers();
                ?>
        </div>  
        <div class="col-md-4">
            <button  class="btn btn-primary bet">Bet Now</button>
        </div>

       


    </div>


    <div class="mess" style="margin-top:20px;">

    </div>
  </div>
</div>

</div>

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>  
</body>
</html>