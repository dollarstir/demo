<?php

require 'autoloader/loader.php';

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'bet') {
        $game = new game();
        extract($_POST);
        $game->bet($data);
    }
}
