<?php 

class DBconnection{

    public $host = 'localhost';
    public $pswd = '';
    public $user = 'root';
    public $db = 'enrgbat';

    public function createConnection(){

        try{
            $db = new PDO("mysql:host=". $this->host .";dbname=". $this->db, $this->user, $this->pswd);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            return $db;
        }catch(PDOException $e){
            echo "Error". $e->getMessage();
        }
        
    }
}


?>