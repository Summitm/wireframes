<?php

class Db{

    protected $dbName = 'wireframes';
    protected $dbHost = 'localhost';

    protected $dbUser = 'root';
    protected $dbPass = 'kihika@10';

    protected $dbHandler, $dbStmt;

    public function __construct() {

        $Dsn = "mysql:host=". $this->dbHost .";dbname=" .$this->dbName;

        $Options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {

            $this->dbHandler = new PDO($Dsn, $this->dbUser, $this->dbPass, $Options);
            // echo "Connected successfully!";
            
        }
        catch(Exemption $e) {

            var_dump("Could not establish a connection:" . $e.getMessage());
            // echo "Error: Unable to create connection: ".$e.getMessage();

        }

    }

    public function verifyIds($payload) {

        $query = $this->dbHandler->prepare("SELECT * FROM `niims_dtls` WHERE `id_number` = :id");
        $query->bindParam(':id', $puyload);
        $query->execute();

        $response = $query->fetchAll();

        if(count($response) > 0) {

            return $result = array(
                "status" => true,
                "id" => $payload,
                "data" => "This ID is valid."
            );

        }
        else{

            return $result = array(
                "status" => false,
                "id" => $payload,
                "data" => "Not a valid ID."
            );

        }

    }

    public function verifyKeys($keyvalue) {

        $query = $this->dbHandler->prepare("SELECT * FROM `user_reg` WHERE `publickey` = :keyvalue");
        $query->bindParam(':keyvalue', $keyvalue);
        $query->execute();

        $checked = $query->fetchAll();

        if(count($checked) > 0) {
            return $result = array(
                "status" => true,
                "key" => $keyvalue,
                "data" => "The Public Key is valid."
            );
        }
        else {

            return $result = array(
                "status" => false,
                "key" => $keyvalue,
                "data" => "The Key is Invalid! Please check that you have the right key!."
            );

        }

    }


}
?>