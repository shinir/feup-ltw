<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/review.class.php');

  $db = getDatabaseConnection();
  $data = array();
  $data['user'] = $session->getId();
  $data['grade'] = intval($_POST['grade']);
  $data['date'] = date("d-m-Y");
  $data['restaurant'] = intval($_GET['id']);

  Review::addReview($db, $data);

  header('Location: ' . $_SERVER['HTTP_REFERER']);
  
?>