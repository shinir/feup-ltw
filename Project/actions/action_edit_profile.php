<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  if (!$session->isLoggedIn()) die(header('Location: /'));

  require_once(__DIR__ . '/../database/connection.db.php');
  require_once(__DIR__ . '/../database/user.class.php');

  $db = getDatabaseConnection();

  $user = User::getUser($db, $session->getId());

  if ($user) {
    $user->name = $_POST['name'];
    $user->username = $_POST['username'];
    if(!empty($_POST['password']))
      $user->password = $_POST['password'];
    $user->address = $_POST['address'];
    $user->email = $_POST['email'];
    $user->phone = $_POST['phone'];

    $user->save($db, $_FILES['photo']['tmp_name']);

    $session->setName($user->name);
    $session->setImagePath($user->photo);
  }

  header('Location: ../pages/profile.php');
?>