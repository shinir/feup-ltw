<?php 
declare(strict_types = 1);


require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

if (!$session->isLoggedIn()) die(header('Location: /'));

require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../database/dish.class.php');

require_once(__DIR__ . '/../templates/common.tpl.php');
require_once(__DIR__ . '/../templates/user.tpl.php');

$db = getDatabaseConnection();
$_SESSION['ordercounter']+= 1;
$user = User::getUser($db, $session->getId());
$id  = $_GET['id'];
$quant = $_GET['di'];


$dish = Dish::getDish($db,intval($id));

$user = $session->getId();
$idorder = $_SESSION['ordercounter'];
$price = floatval($quant) * $dish->price;

$quantity = $quant;
$date = "1/1/1903";
$state = "Preparing";
$rest = 1;
$dish = $id;

$stmt = $db->prepare('INSERT INTO Request VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
$stmt->execute(array($idorder,floatval($price),$quantity,$date,$state,$user,$rest,$dish));




?>