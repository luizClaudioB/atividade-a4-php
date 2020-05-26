<?php

require_once('utils/logger.php');
require_once('utils/validator.php');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    handlePostRequest($_POST);
}

function handlePostRequest() {
    $req = json_decode(file_get_contents('php://input'), true);

    Logger::getInstance()->log(print_r($req, 1));

    if(isset($req['operation']) && isset($req['entity'])) {
        switch($req['entity']) {
            case 'logout':
                session_destroy();
                break;
            case 'admin':
                require_once('model/admin.php');
                adminRequest($req);
                break;
            case 'broker':
                require_once('model/corretores.php');
                brokerRequest($req);
                break;
            case 'customer':
                require_once('model/compradores.php');
                customerRequest($req);
                break;
            default:
                break;
        }
    }
}

function adminRequest($req) {
    $admin = new Admin();
                
    if($req['operation'] === 'query') {
        if(!isset($req['admin_name']))
            $admin->query();
        else
            $admin->query($req['admin_name']);
    } else if($req['operation'] === 'create') {
        $validationResult = Validator::validate(array(
            'admin_name' => array(
                'required' => true
            ),
            'password' => array(
                'required' => true,
                'min_length' => 8,
                'max_length' => 15
            )
        ), $req);
         
        if($validationResult === true) {
            $admin->create($req['admin_name'], $req['password']);
        } else {
            http_response_code(400);
            echo json_encode($validationResult);
        }
    } else if($req['operation'] === 'delete') {}
}

function brokerRequest($req) {
    $broker = new Corretores();
    if($req['operation'] === 'query') {
        if(!isset($req['broker_name']))
            $broker->query();
        else
            $broker->query($req['broker_name']);
    } else if($req['operation'] === 'create') {
        $validationResult = Validator::validate(array(
            'broker_name' => array(
                'required' => true
            ),
            'insurance_type' => array(
                'required' => true
            )
        ), $req);
        
        if($validationResult === true) {
            $broker->create($req['broker_name'], $req['insurance_type']);
        } else {
            http_response_code(400);
            echo json_encode($validationResult);
        }
    } else if($req['operation'] === 'delete') {}
}

function customerRequest($req) {
    $customer = new Compradores();
    if($req['operation'] === 'query') {
        if(!isset($req['customer_name']))
            $customer->query();
        else
            $customer->query($req['customer_name']);
    } else if($req['operation'] === 'create') {
        $validationResult = Validator::validate(array(
            'customer_name' => array(
                'required' => true
            ),
            'customer_location' => array(
                'required' => true
            )
        ), $req);
        
        if($validationResult === true) {
            $customer->create($req['customer_name'], $req['customer_location']);
        } else {
            http_response_code(400);
            echo json_encode($validationResult);
        }
    } else if($req['operation'] === 'delete') {}
}