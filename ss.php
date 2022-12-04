<?php

//  user selection
// 1,2,3,4,5
// 2,3,4,5,6
// 3,4,5,6,7
// 4,5,6,7,8
// 5,6,7,8,9

$userdata = [
    [1, 9, 3, 4, 5],
    [2, 3, 4, 5, 6],
    [3, 4, 5, 6, 7],
    [4, 5, 6, 7, 8],
    [5, 6, 7, 8, 9],
];

// machine selection
// 1,2,3,4,5

// task1. write a php program to compare the user selection and machine selection to see if both  contain the same element

function compare($userdata)
{
    $msg = '';
    $machinedata = [1, 2, 3, 4, 5];
    foreach ($userdata as $user) {
        echo '<pre>';
        print_r($msg = array_diff($user, $machinedata));

        echo '</pre>';
    }

    // if (strpos($msg, 'won') !== false) {
    //     echo 'You have won';
    // } else {
    //     echo 'You have lost';
    // }

    // return $msg;
}

echo compare($userdata);
