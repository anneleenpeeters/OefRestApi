<?php


class Taak
{
    //DB conn
    private $conn;
    private $table = 'taak';

    //Taak properties
    public $taa_id;
    public $taa_datum;
    public $taa_omschr;

    //Constructor with DB
    public function __construct($db){
        $this->conn = $db;
    }

    //GET taken
    public function get() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    //GET taak (id)
    public function getSingle() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE taa_id = ' . $this->taa_id;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        //fetch the array
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //assign the properties
        $this->taa_id = $row['taa_id'];
        $this->taa_datum = $row['taa_datum'];
        $this->taa_omschr = $row['taa_omschr'];
    }

    //POST taak
    public function post(){
        $query = 'INSERT INTO ' . $this->table . ' SET taa_datum = :taa_datum, taa_omschr = :taa_omschr';
        $stmt = $this->conn->prepare($query);

        //Clean submit data
        $this->taa_omschr = htmlspecialchars(strip_tags($this->taa_omschr));

        //Bind data
        $stmt->bindParam(':taa_omschr', $this->taa_omschr);
        $stmt->bindParam(':taa_datum', $this->taa_datum);

        //Execute query
        if($stmt->execute()) {
            return true;
        } else {
            //print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }

    //PUT taak
    public function put(){
        $query = 'UPDATE ' . $this->table . ' SET taa_datum = :taa_datum, taa_omschr = :taa_omschr WHERE taa_id = :taa_id';
        $stmt = $this->conn->prepare($query);

        //Clean submit data
        $this->taa_omschr = htmlspecialchars(strip_tags($this->taa_omschr));
        $this->taa_id = htmlspecialchars(strip_tags($this->taa_id));

        //Bind data
        $stmt->bindParam(':taa_omschr', $this->taa_omschr);
        $stmt->bindParam(':taa_datum', $this->taa_datum);
        $stmt->bindParam(':taa_id', $this->taa_id);

        //Execute query
        if($stmt->execute()) {
            return true;
        } else {
            //print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            return false;
        }
    }

    //DELETE TAAK
    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE taa_id = :taa_id';
        $stmt = $this->conn->prepare($query);

        //Clean submit data
        $this->taa_id = htmlspecialchars(strip_tags($this->taa_id));

        //Bind data
        $stmt->bindParam(':taa_id', $this->taa_id);

        //Execute query
        if($stmt->execute()) {
            return true;
        } else {
            //print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

    }

}