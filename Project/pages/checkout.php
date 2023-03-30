<?php 
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();
  
  if (!$session->isLoggedIn()) die(header('Location: /'));

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../templates/user.tpl.php');
  require_once(__DIR__ . '/../templates/order.tpl.php');
  require_once(__DIR__ . '/../database/order.class.php');
  require_once(__DIR__ . '/../database/dish.class.php');
  $db = getDatabaseConnection();



  $user = User::getUser($db, $session->getId());
  
  drawHeader($session);
  if($session->isOwner()){
    $ownerOrders = Order::getOwnerOrders($db,$session->getId());
    drawOwnerOrders($ownerOrders,$session);
  }
          
  $orders = Order::getUserOrders($db,$session->getId());
  drawOrders($orders,$session);
  drawFooter();
?>  
  

  


