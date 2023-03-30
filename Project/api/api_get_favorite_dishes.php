<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/favorite.class.php');
  require_once(__DIR__ . '/../database/dish.class.php');

  $db = getDatabaseConnection();
  
  $favorites = Favorite::getFavoriteDishesFromRestaurant($db, $session->getId(), intval($_GET['id']));

  echo json_encode($favorites);  
?>