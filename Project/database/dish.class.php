<?php
  declare(strict_types = 1);

  class Dish {
    public int $id;
    public string $name;
    public float $price;
    public string $photo;
    public string $description;
    public string $category;
    public int $restaurant;

    public function __construct(int $id, string $name, float $price, string $photo, string $description, string $category, int $restaurant) {
      $this->id = $id;
      $this->name = $name;
      $this->price = $price;
      $this->photo = $photo;
      $this->description = $description;
      $this->category = $category;
      $this->restaurant = $restaurant;
    }

    function save($db) {
      if(!empty($photo))
        $this->photo = self::uploadPhoto($photo, strval($this->id));

      $stmt = $db->prepare('
        UPDATE Dish SET name = ?, price = ?, photo = ?, descrip = ?, category = ?, restaurant = ?
        WHERE idDish = ?
      ');

      $stmt->execute(array($this->name, $this->price, $this->photo, $this->description, $this->category, $this->restaurant, $this->id));
    }

    static function uploadPhoto(string $photo, string $id) : string {
      $path = "/../photos/dish/$id.jpg";

      unlink(__DIR__ . $path);
      move_uploaded_file($photo, __DIR__ . $path);

      return $path;
    }

    static function addDish(PDO $db, array $data, int $restaurantId, string $photo) {
      if(!empty($photo))
        $photopath = self::uploadPhoto($photo, $data['name']);
      else
        $photopath = "/../photos/dish/default.jpg";

      $stmt = $db->prepare('
        INSERT INTO Dish VALUES (NULL, ?, ?, ?, ?, ?, ?)
      ');

      $stmt->execute(array($data['name'], floatval($data['price']), $photopath, $data['description'], $data['category'], $restaurantId));
    }

    static function removeDish(PDO $db, int $id) {
    $stmt = $db->prepare('
      DELETE FROM Dish
      WHERE idDish = ?
    ');

    $stmt->execute(array($id));
    
    }

    static function getRestaurantDishes(PDO $db, int $id) : array {
      $stmt = $db->prepare('
        SELECT idDish, name, price, photo, descrip, category, restaurant
        FROM Dish 
        WHERE restaurant = ?
        GROUP BY idDish
      ');
      $stmt->execute(array($id));

      $categories = self::getDishCategoriesFromRestaurant($db, $id);
      $dishes = array();

      foreach($categories as $category) {
        $dishes[$category] = array();
      }

      while ($dish = $stmt->fetch()) {
        $dishes[$dish['category']][] = new Dish(
          intval($dish['idDish']), 
          $dish['name'],
          floatval($dish['price']),
          $dish['photo'],
          $dish['descrip'],
          $dish['category'],
          intval($dish['restaurant']),
        );
      }
      
      return $dishes;
    }

    static function getRestaurantDishesByCategory(PDO $db, string $category, int $id) : array {
      $stmt = $db->prepare('
        SELECT idDish, name, price, photo, descrip, category, restaurant
        FROM Dish 
        WHERE category = ? and restaurant = ?
        GROUP BY idDish
      ');
      $stmt->execute(array($category, $id));

      $dishes = array();

      while ($dish = $stmt->fetch()) {
        $dishes[] = new Dish(
          intval($dish['idDish']), 
          $dish['name'],
          floatval($dish['price']),
          $dish['photo'],
          $dish['descrip'],
          $dish['category'],
          intval($dish['restaurant']),
        );
      }
  
      return $dishes;
    }

    static function getDish(PDO $db, int $id) : Dish {
      $stmt = $db->prepare('
        SELECT idDish, name, price, photo, descrip, category, restaurant
        FROM Dish 
        WHERE idDish = ?
      ');
      $stmt->execute(array($id));
  
      $dish = $stmt->fetch();
  
      return new Dish(
        intval($dish['idDish']), 
        $dish['name'],
        floatval($dish['price']),
        $dish['photo'],
        $dish['descrip'],
        $dish['category'],
        intval($dish['restaurant']),
      );
    }

    static function getDishCategoriesFromRestaurant(PDO $db, int $restaurantId) : array {
      $stmt = $db->prepare('
          SELECT DISTINCT category
          FROM Dish
          WHERE restaurant = ?
        ');

      $stmt->execute(array($restaurantId));

      $categories = array();

      while($category = $stmt->fetch()) {
        $categories[] = $category['category'];
      }

      return $categories;
    }

  }
?>