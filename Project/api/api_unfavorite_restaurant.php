<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/favorite.class.php');

  $db = getDatabaseConnection();
  
  Favorite::removeFavoriteRestaurant($db, intval($_GET['id']), $session->getId());
  
?>