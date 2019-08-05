<?php

class Database
{
    public $connection;
    public function __construct()
    {
        $this->connection = mysqli_connect("localhost","root","","ex_qr");
        if ($this->connection->connect_error)
        {
            die("connection failed");
        }
        
    }
}
$obj = new Database;

?>