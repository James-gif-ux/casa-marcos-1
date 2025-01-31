<?php
class RoomModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllRooms() {
        $query = "SELECT * FROM rooms";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRoomById($id) {
        $query = "SELECT * FROM rooms WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createRoom($name, $price, $image, $description, $capacity) {
        $query = "INSERT INTO rooms (name, price, image, description, capacity) 
                 VALUES (:name, :price, :image, :description, :capacity)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':capacity', $capacity);

        return $stmt->execute();
    }

    public function updateRoom($id, $name, $price, $image, $description, $capacity) {
        $query = "UPDATE rooms 
                 SET name = :name, 
                     price = :price, 
                     image = :image, 
                     description = :description, 
                     capacity = :capacity 
                 WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':capacity', $capacity);

        return $stmt->execute();
    }

    public function deleteRoom($id) {
        $query = "DELETE FROM rooms WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
