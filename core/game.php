<?php

class game
{
    public $db;
    public $dbname = 'demo';
    public $dbhost = 'localhost';
    public $dbpassword = '';
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

    public function bet($data)
    {
        $data = implode(',', $data);
        $token = $this->generateToken();
        $dateadded = date('jS F, Y');
        $timeadded = date('h:i:s A');

        $query = mysqli_query($this->db, "INSERT INTO bet(token,number,status,dateadded,timeadded) VALUES ('$token', '$data', 'pending','$dateadded','$timeadded')");

        if ($query) {
            session_start();
            $_SESSION['token'] = $token;
            $msg = 'success';
        } else {
            $msg = 'Error Placing Bet';
        }

        return $msg;
    }

    public function winnumber()
    {
        $winnumber = [];

        for ($i = 0; $i < 5; ++$i) {
            $gen = rand(0, 9);
            array_push($winnumber, $gen);
        }

        $winnumber = implode(',', $winnumber);

        return $winnumber;
    }

    public function sendwinnumber()
    {
        $winnumber = $this->winnumber();
        $wintoken = $this->generateToken();
        // $winnumber = implode(',', $winnumber);
        $dateadded = date('jS F, Y');
        $timeadded = date('h:i:s A');
        $next = date('h:i:s A', strtotime('+3 minutes'));
        $ck = mysqli_query($this->db, 'SELECT * FROM winnumber ORDER BY id DESC LIMIT 1');
        $ck = mysqli_fetch_assoc($ck);
        $ck = $ck['nexttime'];
        if ($ck > date('h:i:s A')) {
            // $msg = 'Please wait for the next draw';
        } else {
            $query = mysqli_query($this->db, "INSERT INTO win(number,dateadded,timeadded,nexttime,wintoken) VALUES ('$winnumber','$dateadded','$timeadded','$next','$wintoken')");
            if ($query) {
                // $msg = 'success';
                session_start();
                $_SESSION['wintoken'] = $wintoken;
            } else {
                // $msg = 'Error ';
            }
        }
        // return $msg;
    }

    public function comparewin()
    {
        $this->sendwinnumber();
        // session_start();
        if (isset($_SESSION['token'])) {
            $token = $_SESSION['token'];
            // $wintoken = $_SESSION['wintoken'];
            $gt = mysqli_query($this->db, 'SELECT * FROM win  ORDER BY id DESC LIMIT 1');
            $gt = mysqli_fetch_assoc($gt);
            $winnumber = $gt['number'];

            $g = mysqli_query($this->db, "SELECT * FROM bet WHERE status = 'pending' AND token = '$token' ");
            $g = mysqli_fetch_assoc($g);
            $number = $g['number'];
            $number = explode(',', $number);
            $winnumber = explode(',', $winnumber);
            $result = array_intersect($number, $winnumber);
            $result = count($result);
            if ($result == 5) {
                $up = mysqli_query($this->db, "UPDATE bet SET status ='won' WHERE token ='$token'");
                unset($_SESSION['token']);
                $status = 'won';
            } else {
                $up = mysqli_query($this->db, "UPDATE bet SET status ='lost' WHERE token ='$token'");
                unset($_SESSION['token']);
                $status = 'lost';
            }
        } else {
            $status = 'nobet';
        }

        return $status;
    }
}
