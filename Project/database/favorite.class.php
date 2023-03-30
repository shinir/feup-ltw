<?php
  declare(strict_types = 1);

  class Favorite {
    public int $user;
    public ?int $restaurant;
    public ?int $dish;

    public function __construct(int $user, ?int $restaurant, ?int $dish) {
      $this->user = $user;
      $this->restaurant = $restaurant;
    }

    static function addFavoriteRestaurant(PDO $db, int $restaurant, int $user) {
      $stmt = $db->prepare('
        INSERT INTO FavoriteRestaurant VALUES (?, ?)
      ');

      $stmt->execute(array($user, $restaurant));
    }

    static function addFavoriteDish(PDO $db, int $dish, int $user) {
        $stmt = $db->prepare('
          INSERT INTO FavoriteDish VALUES (?, ?)
        ');
  
        $stmt->execute(array($user, $dish));
    }

    static function removeFavoriteRestaurant(PDO $db, int $restaurant, int $user) {
        $stmt = $db->prepare('
        DELETE FROM FavoriteRestaurant
        WHERE user = ? and restaurant = ?
        ');

        $stmt->execute(array($user, $restaurant));
    }

    static function removeFavoriteDish(PDO $db, int $dish, int $user) {
        $stmt = $db->prepare('
        DELETE FROM FavoriteDish
        WHERE user = ? and dish = ?
        ');

        $stmt->execute(array($user, $dish));
    }

    static function getFavoriteRestaurants(PDO $db, int $user) : array {
      $stmt = $db->prepare('
        SELECT idRestaurant, name, address, photo, category, idOwner, AVG(grade) AS avgscore
        FROM Restaurant
        INNER JOIN FavoriteRestaurant on Restaurant.idRestaurant = FavoriteRestaurant.restaurant
        LEFT JOIN Review on Restaurant.idRestaurant = Review.restaurant
        WHERE FavoriteRestaurant.user = ?
        GROUP BY idRestaurant
      ');

      $stmt->execute(array($user));
  
      $restaurants = array();
        
      while ($restaurant = $stmt->fetch()) {
        $restaurants[] = new Restaurant(
          intval($restaurant['idRestaurant']), 
          $restaurant['name'],
          $restaurant['address'],
          $restaurant['photo'],
          $restaurant['category'],
          intval($restaurant['idOwner']),
          floatval($restaurant['avgscore'])
        );
      }

      return $restaurants;
    }

    static function getFavoriteDishesFromRestaurant(PDO $db, int $user, int $restaurant) : array {
        $stmt = $db->prepare('
          SELECT idDish, name, price, photo, descrip, category, restaurant
          FROM Dish 
          INNER JOIN FavoriteDish on Dish.idDish = FavoriteDish.dish
          WHERE FavoriteDish.user = ? and restaurant = ?
          GROUP BY idDish
        ');
  
        $stmt->execute(array($user, $restaurant));
    
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
}
?>