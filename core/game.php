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





public function  winnumber()
    
{
    $winnumber = array(1,2,3,4,5,6,7,8,9,0);
    $winnumber = array_rand($winnumber, 1);
    $winnumber = array_slice($winnumber,0, 5);
    
    return $winnumber;

}



public function  sendwinnumber()
{
    $winnumber = $this->winnumber();
    $winnumber = implode(',', $winnumber);
    $dateadded =date('jS F, Y');
    $timeadded = date('h:i:s A');
    $query = mysqli_query($this->db,"INSERT INTO win(number,dateadded,timeadded) VALUES ('$winnumber','$dateadded','$timeadded')");
    if($query){
        $msg = 'success';
        session_start();
        $_SESSION['winnumber'] = $winnumber;
    }
    else{
        $msg = 'Error ';
    }

    return $msg;

}


public function  comparewin()
{
    session_start(); 
    $token  = $_SESSION['token'];
    $winnumber = $_SESSION['winnumber'];
    $g = mysqli_query($this->db,"SELECT * FROM bet WHERE status = 'pending' AND token = '$token' ");
    $g = mysqli_fetch_assoc($g);
    $number = $g['number'];
    $number = explode(',', $number);
    $winnumber = explode(',', $winnumber);
    $result = array_intersect($number, $winnumber);
    $result = count($result);
    


}

}