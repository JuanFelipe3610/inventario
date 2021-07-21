<?php 
    use model\Connection;

    class Icons extends Connection {
        public function __construct() {
            parent::__construct();
        } 
        
        public function readAll () {
            $data = null;
            $query = "SELECT * FROM iconos";
            $result = $this->conn->query($query);
            while($row = $result->fetch()) { 
                $data[] = array(
                    'ID'     => $row['id_icon'],
                    'CASS' => $row['class'],
                    'FONT' => $row['font']
                );
		    }
            return $data;
        }

        public function readForFont ($font) {
            $data = null;
            $query = "SELECT * FROM iconos WHERE font = '$font'";
            $result = $this->conn->query($query);
            while($row = $result->fetch()) { 
                $data[] = array(
                    'ID'   => $row['id_icon'],
                    'CASS' => $row['class'],
                    'FONT' => $row['font']
                );
		    }
            return $data;
        }
    }
?>