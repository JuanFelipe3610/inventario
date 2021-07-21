<?php
    namespace model;
    use \PDO;
    class Connection {
        private $host = 'localhost';
        private $user = 'root';
        private $password = '';
        private $database = 'appfactory';
        private $port = 3306;
        protected $conn;

        public function __construct() {
            $connString = "mysql:host=".$this->host.";dbname=".$this->database.";charset=utf8";
            try {
                $this->conn = new PDO($connString, $this->user, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $e) {
                $this->connect = "Error de conexón";
                echo "ERROR: ".$e->getMessage();
            }            
        }
    }
?>    