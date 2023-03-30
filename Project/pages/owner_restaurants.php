<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');

  require_once(__DIR__ . '/../database/restaurant.class.php');
  require_once(__DIR__ . '/../database/dish.class.php');

  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../templates/restaurant.tpl.php');
  require_once(__DIR__ . '/../templates/review.tpl.php');

  $db = getDatabaseConnection();

  $restaurants = Restaurant::getOwnerRestaurants($db, $session->getId());
  drawHeader($session);
  drawOwnerRestaurants($restaurants);
  drawFooter();
  ?>