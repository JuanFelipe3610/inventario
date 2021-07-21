<?php 
    namespace model;
    use model\Connection;

    class UserConfig extends Connection {
        public function __construct() {
            parent::__construct();
        }

        public function dataUser($user, $pass) {
            $query = "SELECT * FROM user u, type_user tu WHERE (usuario = '$user' or correo = '$user') AND pass = '$pass' AND u.id_type_user = tu.id_type_user";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            $row = $stmt->fetch();
            if (!empty($row)) {
                $data = array(
                    'ID'                => $row['id_user'],
                    'NOMBRE'            => $row['nombre'],
                    'APELLIDO'	        => $row['apellido'],
                    'USUARIO'	        => $row['usuario'],
                    'CORREO'            => $row['correo'],
                    'PASS'              => $row['pass'],
                    'TYPEUSER'          => $row['description'],
                    'IMG'               => $row['img'],
                    'FECHA_REGISTRO'    => $row['fecha_registro']
                );
            }else{
                $data = null;
            }
            return $data;
        }
    }
?>