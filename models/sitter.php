<?php
require_once  'employee.php';
class Sitter extends Employee{
    protected float $salary;

    public function __construct(
        int $id, 
        string $firstName, 
        string $lastName, 
        string $address,  
        String $gender,
        $birthDate,
        String $image,
        String $email,
        String $phone,
        int $salary
    ){
        parent::__construct($id, $firstName, $lastName, $address, $gender, $birthDate,$image,$email,$phone,$salary);
    }

    // getter and setter methods

    // db connection
    public static function create($data){
        require __DIR__ . '/../services/connect.php';
        $sql = "INSERT INTO sitters ( `firstName`, `lastName`, `address`, `gender`, `birthDate`,`image`,`email`,`phone`, `salary`, `credentialId`)
        VALUES ('".$data['firstName']."','".$data['lastName']."','".$data['address']."','".$data['gender']."','".$data['birthDate']."','".$data['image']."','".$data['email']."','".$data['phone']."','".$data['salary']."',".$data['credentialId'].")";
        $res = $conn->query($sql) ;
        $conn->close();
        return $res=== TRUE;
    }
    public static function findByiId($id){
        require __DIR__ . '/../services/connect.php';
        $sql = "SELECT * FROM sitters WHERE id = $id";
        $result =  $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
            $sitter = new Sitter(
            $row['id'],
            $row['firstName'],
            $row['lastName'],
            $row['address'],
            $row['gender'],
            $row['birthDate'],
            $row['image'],
            $row['email'],
            $row['phone'],
            $row['salary']);
            $conn->close();
            return $sitter;
            }}else{
                $conn->close();
                return null;
            }
    }

    public static function findWhere($query){
        require __DIR__ . '/../services/connect.php';
        $sql = "SELECT * FROM sitters WHERE $query ORDER BY created_at DESC;";
        $result =  $conn->query($sql);
        
        $sitters = [];
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
            $sitter = new Sitter(
            $row['id'],
            $row['firstName'],
            $row['lastName'],
            $row['address'],
            $row['gender'],
            $row['birthDate'],
            $row['image'],
            $row['email'],
            $row['phone'],
            $row['salary']);
            array_push($sitters,$sitter);
        }
    } 
    $conn->close();
    return $sitters;
    }
    static public function getByCredential(Credential $cred){
        require __DIR__ . '/../services/connect.php';
        $sql = "SELECT * FROM sitters WHERE credentialId = '".$cred->getId()."'";
        $result =  $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
            $sitter = new Sitter(
            $row['id'],
            $row['firstName'],
            $row['lastName'],
            $row['address'],
            $row['gender'],
            $row['birthDate'],
            $row['image'],
            $row['email'],
            $row['phone'],
            $row['salary']);
            $conn->close();
            return $sitter;
            }}else{
                $conn->close();
                return null;
            }
    }
    public function update():bool{
        require __DIR__ . '/../services/connect.php';
        $sql = "UPDATE `sitters` SET `firstName`='".$this->firstName."',`lastName`='".$this->lastName."',`address`='".$this->address."',`gender`='".$this->gender."',`birthDate`='".$this->birthDate."',`salary`='".$this->salary."' WHERE id=".$this->id;
        $res = $conn->query($sql) ;
        $conn->close();
        return $res=== TRUE;
    }
    public function delete():bool{
        require __DIR__ . '/../services/connect.php';
        $sql = "DELETE FROM sitters WHERE id='$this->id'";
        $res =  $conn->query($sql) ;
        $conn->close();       
        return $res;
    }

    public function deleteById($id):bool{
        require __DIR__ . '/../services/connect.php';
        $sql = "DELETE FROM sitters WHERE id='$id'";
        $res =  $conn->query($sql) ;
        $conn->close();       
        return $res;
    }
}