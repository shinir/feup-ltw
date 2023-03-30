<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../templates/common.tpl.php');
  require_once(__DIR__ . '/../templates/register.tpl.php');


  drawHeader($session);
  drawDishRegisterForm(intval($_GET['id']));
  drawFooter();
?>