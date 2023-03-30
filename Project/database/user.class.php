<?php
  declare(strict_types = 1);

  class User {
    public int $id;
    public string $name;
    public string $username;
    public string $password;
    public string $address;
    public string $phone;
    public string $email;
    public string $photo;
    public string $type;

    public function __construct(?int $id, string $name, string $username, string $password, string $address, string $phone, string $email, string $photo, string $type) {
      $this->id = $id;
      $this->name = $name;
      $this->username = $username;
      $this->password = $password;
      $this->address = $address;
      $this->phone = $phone;
      $this->email = $email;
      $this->photo = $photo;
      $this->type = $type;
    }

    function save($db, $photo) {
      if(!empty($photo))
        $this->photo = self::uploadPhoto($photo, $this->username);
      
      $stmt = $db->prepare('
        UPDATE User SET name = ?, username = ?, password = ?, address = ?, phoneNumber = ?, email = ?, photo = ?
        WHERE idUser = ?
      ');

      $stmt->execute(array($this->name, $this->username, $this->password, $this->address, $this->phone, $this->email, $this->photo, $this->id));
      
    }

    static function uploadPhoto(string $photo, string $name) : string {
      $path = "/../photos/user/$name.jpg";

      unlink(__DIR__ . $path);
      move_uploaded_file($photo, __DIR__ . $path);

      return $path;
    }

    static function registerUser(PDO $db, array $data, string $photo) : User {
      if(!empty($photo))
        $photopath = self::uploadPhoto($photo, $data['username']);
      else
        $photopath = "/../photos/user/default.jpg";

      $stmt = $db->prepare('
        INSERT INTO User VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)
      ');

      $stmt->execute(array($data['name'], $data['username'], password_hash($data['password'], PASSWORD_DEFAULT), $data['address'], $data['email'], $data['phone'], $photopath, $data['option']));
      
      $id = $db->lastInsertId();

      return self::getUser($db, intval($id));
    }

    
    static function getUserWithPassword(PDO $db, string $username, string $password) : ?User {
      $stmt = $db->prepare('
        SELECT idUser, name, userName, password, address, email, phoneNumber, photo, option
        FROM User 
        WHERE username = ?
      ');

      $stmt->execute(array($username));
  
      if ($user = $stmt->fetch()) {
        return new User(
          intval($user['idUser']),
          $user['name'],
          $user['userName'],
          $user['password'],
          $user['address'],
          $user['phoneNumber'],
          $user['email'],
          $user['photo'],
          $user['option'],
        );
      } else return null;
    }

    static function getUser(PDO $db, int $id) : User {
      $stmt = $db->prepare('
        SELECT idUser, name, userName, password, address, email, phoneNumber, photo, option
        FROM User
        WHERE idUser = ?
      ');

      $stmt->execute(array($id));
      $user = $stmt->fetch();
      return new User(
        intval($user['idUser']),
        $user['name'],
        $user['userName'],
        $user['password'],
        $user['address'],
        $user['phoneNumber'],
        $user['email'],
        $user['photo'],
        $user['option'],
      );
    }

  }
?>