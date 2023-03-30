<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) die(header('Location: /'));

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/dish.class.php');

  $db = getDatabaseConnection();

  $dish = Dish::getDish($db, intval($_GET['id']));

  if ($dish) {
    $dish->name = $_POST['name'];
    $dish->price = floatval($_POST['price']);
    $dish->category = $_POST['category'];
    $dish->description = $_POST['description'];

    $dish->save($db, $_FILES['photo']['tmp_name']);
  }

  header('Location: ' . $_SERVER['HTTP_REFERER']);
?>