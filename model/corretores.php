<?php

class Corretores {

    function query($broker_name = '') {
        if(strlen($broker_name) <= 0) {
            if(!isset($_SESSION['brokers'])) {
                echo json_encode(array());
                return;
            }
            
            echo json_encode($_SESSION['brokers']);
            return;
        }
        
        if(!isset($_SESSION['brokers'])) {
            echo json_encode(new stdClass());
            return;
        }
        
        foreach ($_SESSION['brokers'] as $broker) {
            if($broker['broker_name'] === $broker_name) {
                echo json_encode($_SESSION[$broker]);
                return;
            }
        }
        echo json_encode(array());
    }

    function create($broker_name, $insurance_type) {
        if(!isset($_SESSION['brokers'])) {
            $_SESSION['brokers'] = array();
        }
        $_SESSION['brokers'][] = array(
            'broker_name' => $broker_name,
            'insurance_type' => $insurance_type
        );
    }
    
}