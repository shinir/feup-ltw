<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) die(header('Location: /'));

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/restaurant.class.php');

  $db = getDatabaseConnection();

  $restaurant = Restaurant::getRestaurant($db, intval($_GET['id']));

  if ($restaurant) {
    $restaurant->name = $_POST['name'];
    $restaurant->address = $_POST['address'];
    $restaurant->category = $_POST['category'];

    $restaurant->save($db, $_FILES['photo']['tmp_name']);
  }

  header('Location: ../pages/owner_restaurants.php');
?>