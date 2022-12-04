<?php

class game
{
    public function generatenumbers()
    {
        $data = '';

        for ($i = 0; $i < 10; ++$i) {
            $data .= '<button class="demo" id="'.$i.'"><span class="ballitem">'.$i.'</span></button> ';
        }

        return $data;
    }
}
