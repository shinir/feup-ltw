<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    if (!$session->isLoggedIn()) die(header('Location: /'));

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/order.class.php');

    $db = getDatabaseConnection();

    Order::removeOrder($db,intval($_GET['id']));
    


    header('Location: ' . $_SERVER['HTTP_REFERER']);

?>