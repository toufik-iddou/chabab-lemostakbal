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
        int $salary
    ){
        parent::__construct($id, $firstName, $lastName, $address, $gender, $birthDate,$salary);
    }

    // getter and setter methods

    // db connection
    public static function create($data):bool{
        require __DIR__ . '/../services/connect.php';
        $sql = "INSERT INTO sitters ( `firstName`, `lastName`, `address`, `gender`, `birthDate`, `salary`, `credentialId`)
        VALUES ('".$data['firstName']."','".$data['lastName']."','".$data['address']."','".$data['gender']."','".$data['birthDate']."','".$data['salary']."',".$data['credentialId'].")";
        $res = $conn->query($sql) ;
        $conn->close();
        return $res=== TRUE;
    }
    public static function findByiId($id){
        
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
            $row['salary']);
            $conn->close();
            return $sitter;
            }}else{
                $conn->close();
                return null;
            }
    }
    public function save():bool{
        
    }
    public function delete():bool{
        require __DIR__ . '/../services/connect.php';
        $sql = "DELETE FROM sitters WHERE id='$this->id'";
        $res =  $conn->query($sql) ;
        $conn->close();       
        return $res;
    }
}