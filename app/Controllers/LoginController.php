<?php

namespace App\Controllers;
use App\Models\UserModel;

class LoginController extends PagesController
{
    private $userModel;

	public function __construct() {
        $this->userModel = new UserModel();
    }

    public function index($page = 'login')
	{ 
        $pageData = [
            'name' => $page,
            'Header' => 'loginHeader',
            'Footer' => 'loginFooter'
        ];
        $this->view($page, array(), $pageData);
	}

    public function login() {
        $return = ['mensaje' => '', 'status' => 1];
        $user = $this->post('user');
        $pass = $this->post('pass');
        if (!isset($user) || empty($user) || !isset($pass) || empty($pass)) {
            $return['mensaje'] = 'El usuaro y/o la contraseña esta vacio';
            $return['status'] = 1;
        } else {
            $result = $this->userModel->login($user, $pass);            
            if(empty($result)){
                $return['mensaje'] = 'El usuaro y/o la contraseña es incorrecto';
                $return['status'] = 1;
            } else {
                $return['status'] = 0;
                $result = $result[0];
                $newdata = [
                    'username'  => $result->usuario,
                    'email'     => $result->correo,
                    'type_user'     => $result->description,
                    'logged_in' => true,
                ];
                $this->session->set($newdata);
            }            
        }
        echo json_encode($return);
    }

    public function logOut() {
        $this->session->destroy();
        header('Location: login');
    }
}