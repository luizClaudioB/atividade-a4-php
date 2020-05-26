<?php

include('controller.php');

session_start();

$_SESSION['admin_users'] = array(
    array(
        "admin_name" => 'usuario@usuario',
        "password" => 'senha123'
        )
    );

new Controller();

?>