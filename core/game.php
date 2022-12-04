<?php

class game
{
    public $db;
    public $dbname = 'demo';
    public $dbhost = 'localhost';
    public $dbpassword ='';
    public $dbuser = 'root';


    public function __construct()
    {
        $this->db = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpassword, $this->dbname);
    }

    public function generatenumbers()
    {
        $data = '';

        for ($i = 0; $i < 10; ++$i) {
            $data .= '<button class="demo" id="'.$i.'"><span class="ballitem">'.$i.'</span></button> ';
        }

        return $data;
    }
    
    public function generateToken()
    {
        $token = md5(uniqid(rand(), true));
        return $token;
    }



    public function bet($data){
        $data = implode(',', $data);
        $token  = $this->generateToken();
        $dateadded =date('jS F, Y');
        $timeadded = date('h:i:s A');

        $query = mysqli_query($this->db,"INSERT INTO bet(token,number,status,dateadded,timeadded) VALUES ('$token', '$data', 'pending','$dateadded','$timeadded')");

        if($query){
            session_start();
            $_SESSION['token'] = $token;
            $msg = 'success';
        }
        else{
            $msg = 'Error Placing Bet';
        }

        return $msg;


        




    }
}
