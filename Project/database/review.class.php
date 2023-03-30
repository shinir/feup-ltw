<?php
  declare(strict_types = 1);

  class Review {
    public int $id;
    public int $grade;
    public string $date;
    public string $username;
    public string $userphoto;
    public int $user;
    public int $restaurant;

    public function __construct(int $id, int $grade, string $date, string $username, string $userphoto, int $user, int $restaurant) {
      $this->id = $id;
      $this->grade = $grade;
      $this->date = $date;
      $this->username = $username;
      $this->userphoto = $userphoto;
      $this->user = $user;
      $this->restaurant = $restaurant;
    }

    static function addReview(PDO $db, array $data) {
      $stmt = $db->prepare('
        INSERT INTO Review VALUES (NULL, ?, ?, ?, ?)
      ');

      $stmt->execute(array($data['grade'], $data['date'], $data['user'], $data['restaurant']));
    }

    static function getReviewsFromRestaurant(PDO $db, int $id) : array {
        $stmt = $db->prepare('
          SELECT idReview, grade, date, user, userName, User.photo
          FROM Review 
            INNER JOIN User ON User.idUser = Review.user
            INNER JOIN Restaurant ON Restaurant.idRestaurant = Review.restaurant
          WHERE idRestaurant = ?
        ');

        $stmt->execute(array($id));
        
        $reviews = array();
  
        while ($review = $stmt->fetch()) {
          $reviews[] = new Review(
            intval($review['idReview']), 
            intval($review['grade']),
            $review['date'],
            $review['userName'],
            $review['photo'],
            intval($review['user']),
            $id
          );
        }
  
        return $reviews;
    }
}
  
?>