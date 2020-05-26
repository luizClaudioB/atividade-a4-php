<?php

class Admin {

    function checkAdminUser($admin_name, $password) {
        Logger::getInstance()->log("checking user $admin_name, $password in ".print_r($_SESSION['admin_users'], true));
        
        if(!isset($_SESSION['admin_users'])) {
            echo json_encode(array());    
        }
        
        foreach ($_SESSION['admin_users'] as $admin_user) {
            if($admin_user['admin_name'] === $admin_name && $admin_user['password'] === $password) {
                return true;
            }
        }
        return false;
    }

    function query($admin_name = '') {
        Logger::getInstance()->log('in query admin_users');
        if(strlen($admin_name) <= 0) {
            if(!isset($_SESSION['admin_users'])) {
                echo json_encode(array());
                return;
            }
            
            echo json_encode($_SESSION['admin_users']);
            return;
        }
        
        if(!isset($_SESSION['admin_users'])) {
            echo json_encode(new stdClass());
            return;
        }
            
        foreach ($_SESSION['admin_users'] as $admin_user) {
            if($admin_user['admin_name'] === $admin_name) {
                echo json_encode($admin_user);
                return;
            }
        }
        echo json_encode(array());
    }

    function create($admin_name, $password) {
        Logger::getInstance()->log('in create admin_users');
        if(!isset($_SESSION['admin_users'])) {
            $_SESSION['admin_users'] = array();
        }
        $_SESSION['admin_users'][] = array(
            'admin_name' => $admin_name,
            'password' => $password
        );
    }
    
}