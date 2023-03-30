<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();
  
  $user = User::registerUser($db, $_POST, $_FILES['photo']['tmp_name']);

  $session->setId($user->id);
  $session->setName($user->name);
  $session->setImagePath($user->photo);
  $session->setUserType($user->type);
  $session->addMessage('success', 'Registration successful!');

  header('Location: ../pages/index.php');

?>