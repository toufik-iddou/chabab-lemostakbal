<?php
require_once  'anonymous.php';
class ChildParent extends Anonymous{
    protected array $children;
    public function __construct(
        int $id, 
        string $firstName, 
        string $lastName, 
        string $address, 
        String $gender, 
    ){
        parent::__construct($id, $firstName, $lastName, $address, $gender);
        $this->fetchChildren();
    }
    // setter and getter methods
    public function getChildren(){
        return $this->children;
    }

    public function fetchChildren(){
        require __DIR__ . '/../services/connect.php';
        $sql = "SELECT * exclude from kids where id='$this->id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $kid =new Kid(
                $row["id"], 
                $row["firstName"], 
                $row["lastName"], 
                $row["address"], 
                $row["gender"], 
                $row["birthDate"],
                $row["level"]);
                array_push($this->children,$kid);
            }
          }
          $conn->close();
    }

    public static function create($data):bool{
        require __DIR__ . '/../services/connect.php';
        $sql = "INSERT INTO childPerson (firstName,lastName,'address',gender)
        VALUES (''$data->firstName'',''$data->lastName'',''$data->address'','$data->gender')";
        $res = $conn->query($sql) ;
        $conn->close();
        return $res === TRUE;
    }
    public static function findByiId($id){
        
    }
    public function save():bool{
        
    }
    public function delete():bool{
        require __DIR__ . '/../services/connect.php';
        $sql = "DELETE FROM child_parent WHERE id='$this->id'";
        $res = $conn->query($sql); 
        $conn->close();      
        return $res;;
    }
}