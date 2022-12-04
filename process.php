<?php

require 'autoloader/loader.php';

if (isset($_GET['action'])) {
    

    switch ($_GET['action']) {
        case 'bet':

            $game = new game();
            extract($_POST);
            echo $game->bet($data);
            
            break;

        case 'result':
            $game = new game();

            echo $game->comparewin();
            break;

        case 'winnumber':
            $game = new game();

            echo $game->winnumber();
            break;
        
        default:
            # code...
            break;
    }
}
