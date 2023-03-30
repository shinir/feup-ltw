<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    if (!$session->isLoggedIn()) die(header('Location: /'));

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/order.class.php');

    $db = getDatabaseConnection();

    
    $order = Order::getOrder($db, intval($_GET['id']));

    if ($order) {
        if($order->state == "Preparing")
       {
        $new = "Packaging";
       }
       else if($order->state == "Packaging")
       {
        $new = "Delivering";
       }
       else if($order->state == "Delivering")
       {
        $new = "Delivered";
       }
       else if($order->state == "Delivered")
       {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
       }
        $order->state = $new;
    
        $order->save($db);
        
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);

?>