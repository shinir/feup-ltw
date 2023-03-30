<?php
  $db = new PDO('sqlite:news.db');
  $stmt = $db->prepare('SELECT * FROM news');
  $stmt->execute();
  $articles = $stmt->fetchAll();
?>