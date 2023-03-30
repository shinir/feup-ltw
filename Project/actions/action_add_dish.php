<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/dish.class.php');

  $db = getDatabaseConnection();
  $restaurantId = $_GET['id'];

  Dish::addDish($db, $_POST, intval($restaurantId), $_FILES['photo']['tmp_name']);

  header('Location: ../pages/restaurant.php?id='.$restaurantId);
  
?>