<?php 
    namespace controller;
    use model\UserConfig;

    class UserConfigController extends UserConfig {
        public function __construct() {
            parent::__construct();
        }

        public function login($user, $pass) {
            $data = $this->dataUser($user, $pass);
            if (is_null($data)) {
                $data = array(
                    "MESSAGE" => "Usuario y/o Contraseña Incorrecta"
                );
            }else{
                $data["MESSAGE"] = "Session iniciada";
                $data["SESSION"] = 1;
                session::set('DATAUSER', $data);
                session::set('authorize', true);
                session::set('last_activity', time());
                session::$timeoff = true;
            }
            return $data;
        }
    }
?>