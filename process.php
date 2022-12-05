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

            $num = $game->winnumber();
            $num = explode(',', $num);
            echo '<button class="demo1" id=""><span class="ballitem1">'.$num[0].'</span></button>
            <button class="demo1" id=""><span class="ballitem1">'.$num[1].'</span></button>
            <button class="demo1" id=""><span class="ballitem1">'.$num[2].'</span></button>
            <button class="demo1" id=""><span class="ballitem1">'.$num[3].'</span></button>
            <button class="demo1" id=""><span class="ballitem1">'.$num[4].'</span></button>
            ';
            break;
        
        default:
            # code...
            break;
    }
}
