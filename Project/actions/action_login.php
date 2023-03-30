<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();

  $user = User::getUserWithPassword($db, $_POST['username'], $_POST['password']);

  if ($user && password_verify($_POST['password'], $user->password)) {
    $session->setId($user->id);
    $session->setName($user->name);
    $session->setImagePath($user->photo);
    $session->setUserType($user->type);
    $session->addMessage('success', 'Login successful!');
  } else {
    $session->addMessage('error', 'Wrong username and/or password!');
  }

  header('Location: ../pages/index.php');
?>