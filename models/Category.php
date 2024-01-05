<?php
class Category {
    // DB stuff
    private $conn;
    private $table = 'categories';

    // properties
    public $id;
    public $name;
    public $created_at;

    // constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }

    // get categories
    public function read() {
        // create query
        $query = 'SELECT
        id,
        name
        FROM 
        ' . $this->table . '
        ORDER BY
        created_at DESC';

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }
    public function read_single() {
        // create query
        $query = 'SELECT
        id,
        name
        FROM
        ' . $this->table . ' WHERE id = :id
        ORDER BY
        created_at DESC';

        // prepare statement
        $stmt = $this->conn->prepare($query);

        // bind id
        $stmt->bindParam(':id', $this->id);


        // execue query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set properties
        $this->name = $row['name'];
    }
    public function update() {
        // create query
        $query = 'UPDATE ' . $this->table . '
        SET
        name = :name,
        
       WHERE 
        id = :id';
  
        // prepare statement
        $stmt = $this->conn->prepare($query);
  
        // clean data
        $this->name = htmlspecialchars(strip_tags($this->name));
  
        // bind data
        $stmt->bindParam(':name', $this->name);
  
        // execute query
        if($stmt->execute()) {
          return true;
        }
  
        // print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
  
        return false;
      }
  
      // delete post
      public function delete() {
        // create query
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
  
        // prepare statement
        $stmt = $this->conn->prepare($query);
  
        //clean data 
  
        $this->id = htmlspecialchars(strip_tags($this->id));
  
        // bind data
  
        $stmt->bindParam(':id', $this->id);
  
          // execute query
          if($stmt->execute()) {
            return true;
          }
    
          // print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);
    
          return false;
      }
    
}