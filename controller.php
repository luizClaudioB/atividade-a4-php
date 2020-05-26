<?php

require_once('utils/logger.php');
require_once('utils/validator.php');
require('model/admin.php');

class Controller {
    
    function __construct() {
        
        session_start();

        Logger::getInstance()->log('METHOD: '.$_SERVER['REQUEST_METHOD']);
        Logger::getInstance()->log('POST: '.print_r($_POST, true));
        Logger::getInstance()->log('SESSION: '.print_r($_SESSION, true));
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handlePostRequest($_POST);
        } else if(!isset($_SESSION['userData'])) {
            Logger::getInstance()->log('unlogged');
            require_once('templates/login.php');
        } else if($_SESSION['userData']['isLogged']){
            require_once('templates/cadastro.php');
        } else {
            require_once('templates/login.php');
        }
    }

    private function handlePostRequest($req) {
        if(isset($req['operation'])) {
            switch ($req['operation']) {
                case 'login':
                    $this->handleLogin($req);
                    break;
                case 'logout':
                    session_destroy();
                    break;
            }
        }
    }

    private function handleLogin($req){
        Logger::getInstance()->log('handling login');
        $valid = Validator::validate(array(
            'admin_name' => array(
                'required' => true,
                'min_length' => 8,
                'max-length' => 12
            ),
            'password' => array(
                'required' => true,
                'min_length' => 6,
                'max-length' => 12
            )
        ), $req);

        if($valid === true) {
            $admin= new Admin();
            
            $userExist = $admin->checkAdminUser($req['admin_name'], $req['password']);

            Logger::getInstance()->log('userExist: '.$userExist);
            
            if($userExist) {
                $_SESSION['userData']['isLogged'] = true;
            } else {
                $_SESSION['userData']['isLogged'] = false;
            }
            
            header('Location: https://admin-soseguros.000webhostapp.com/index.php');
        } else {
            require_once('templates/login.php');
            echo '
                <script>
                    window.setTimout(() => {
                        Layout.getInstance().makeToast("Erro", "'.$valid[0].'", true)
                    }, 1000);
                </script>
            ';
        }
    }
}