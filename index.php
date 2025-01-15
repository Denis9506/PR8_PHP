<?php 
    include './config.php';
    include './core/model.php';
    include './core/route.php';
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    
    $r = new Route();
    $r->start();
?>