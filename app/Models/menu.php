<?php 
namespace model;
use model\Connection;

class Menu extends Connection {
    public function __construct() {
        parent::__construct();
    } 
    
    public function readAll ($values) {
        $data = array();
        $value = json_decode($values);
        $query = "SELECT * FROM menu WHERE estado = ".$value[0]->estado;
        $result = $this->conn->query($query);
        while($row = $result->fetch_array()) { 
            $data[] = array(
                'ID'        => $row['id_menu'],
                'NOMBRE'    => $row['nombre'],
                'URL'	    => $row['url'],
                'ICON'	    => $row['icon'],
                'POSITION'	=> $row['position'],
                'ORDEN'	    => $row['orden']
            );
        }
        
        if(isset($_GET["callback"])){   
            echo $_GET["callback"]."(" . json_encode($data) . ");";  
        }else{
            echo  json_encode($retorno);
        }
    }

    public function MenuTop () {
        $data = array();
        $query = "SELECT * FROM menu WHERE position = 1 ORDER BY orden ASC";
        $stmt = $this->conn->query($query);
        $stmt->execute();
        while($row = $stmt->fetchAll()) { 
            $data[] = (object)array(
                'ID'     => $row['id_menu'],
                'NOMBRE' => $row['nombre'],
                'URL'	 => $row['url'],
                'ICON'	 => $row['icon']
            );
        }
        return $data;
    }

    public function MenuLeft () {
        $data = array();
        $query = "SELECT * FROM menu WHERE position = 2 ORDER BY orden ASC";
        $stmt = $this->conn->query($query);
        $stmt->execute();
        foreach($stmt->fetchAll() as $row) {
            $query2 = "SELECT * FROM sub_menu WHERE id_menu = $row[id_menu]";
            $stmt2 = $this->conn->query($query2);
            $stmt2->execute();
            $submenu = array();
            foreach($stmt2->fetchAll() as $row2){
                $submenu[] = (object)array(
                    'ID'     => $row2['id_sub_menu'],
                    'NOMBRE' => $row2['nombre'],
                    'URL'    => $row2['url'],
                    'ICON'	 => $row2['icon']
                );
            }

            $data[] = (object)array(
                'ID'      => $row['id_menu'],
                'NOMBRE'  => $row['nombre'],
                'URL'	  => $row['url'],
                'ICON'	  => $row['icon'],
                'SUBMENU' => $submenu
            );
        }
        return $data;
    }

    public function MenuRightTop () {
        $data = array();
        $query = "SELECT * FROM menu WHERE position = 3 ORDER BY orden ASC";
        $stmt = $this->conn->query($query);
        $stmt->execute();
        foreach ($stmt->fetchAll() as $row) {
            $data[] = (object)array(
                'ID'     => $row['id_menu'],
                'NOMBRE' => $row['nombre'],
                'URL'	 => $row['url'],
                'ICON'	 => $row['icon']
            );
        }
        return $data;
    }

    public function GetMenu($option) {
        switch ($option) {
            case 'left':
                return $this->MenuLeft();
                break;
            case 'top':
                return $this->MenuRightTop();
                break;
            default:
                return 'error';
                break;
        }
    }
}
?>