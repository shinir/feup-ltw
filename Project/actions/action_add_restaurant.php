<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/restaurant.class.php');

  $db = getDatabaseConnection();
  
  Restaurant::addRestaurant($db, $_POST, $session->getId(), $_FILES['photo']['tmp_name']);

  header('Location: ../pages/owner_restaurants.php');
  
?>