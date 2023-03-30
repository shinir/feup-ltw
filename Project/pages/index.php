<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/restaurant.class.php');
  require_once(__DIR__ . '/../database/favorite.class.php');

  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../templates/restaurant.tpl.php');
  

  $db = getDatabaseConnection();

  if(isset($_GET['search']))
    $restaurants = Restaurant::getRestaurantsWithName($db, $_GET['search']);
  else {
    if(isset($_GET['category']))
      $restaurants = Restaurant::getRestaurantsByCategory($db, $_GET['category']);
    else
      $restaurants = Restaurant::getRestaurants($db);
  }

  $categories = Restaurant::getRestaurantCategories($db);

  if($session->isLoggedIn())
    $favorites = Favorite::getFavoriteRestaurants($db, $session->getId());

  drawHeader($session);
  drawSearchBar();
  drawRestaurantCategories($categories);
  drawRestaurants($restaurants, $favorites);
  drawFooter();
?>
