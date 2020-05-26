<?php

class Compradores {

    function query($customer_name = '') {
        if(strlen($customer_name) <= 0) {
            if(!isset($_SESSION['customers'])) {
                echo json_encode(array());
                return;
            }
            
            echo json_encode($_SESSION['customers']);
            return;
        }
        
        if(!isset($_SESSION['customers'])) {
            echo json_encode(new stdClass());
            return;
        }
        
        foreach ($_SESSION['customers'] as $customer) {
            if($customer['customer_name'] === $customer_name) {
                echo json_encode($customer);
                return;
            }
        }
        echo json_encode(array());
    }

    function create($customer_name, $customer_location) {
        if(!isset($_SESSION['customers'])) {
            $_SESSION['customers'] = array();
        }
        $_SESSION['customers'][] = array(
            'customer_name' => $customer_name,
            'customer_location' => $customer_location
        );
    }
    
}

