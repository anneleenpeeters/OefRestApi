<?php


class Database
{
    //DB Params
    private $host = 'localhost';
    private $db_name = 'city';
    private $username = 'root';
    private $password = 'mysql';
    private $conn;

    //DB connect
    public function connect(){
        $this->conn = null;

        try {
            //create en new PDO object en pass in de DB
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);

            //set the error mode
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch(PDOException $e) {
            //$e->getMessage() will tell us what went wrong
            echo 'Connection Error: ' . $e->getMessage();
        }

        //return the connection
        return $this->conn;
    }
}