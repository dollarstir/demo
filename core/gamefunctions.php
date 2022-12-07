<?php

class gamefunctions
{
    public function g120()
    {
        $userdata = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

        $len = count($userdata);

        if ($len >= 5) {
            $result = $len * ($len - 1) * ($len - 2) * ($len - 3) * ($len - 4) / 120;

            return $result;
        }
    }
}
