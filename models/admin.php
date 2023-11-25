<?php

require 'employee.php';
class Admin extends Employee
{
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
        
    ) {
        parent::__construct($id, $firstName, $lastName, $address, $gender, $birthDate,$image,$email,$phone,$salary);
    }

    // getter and setter methods
    // db connection

    public static function create($data)
    {
        require __DIR__ . '/../services/connect.php';
        $sql = "INSERT INTO admins ( `firstName`, `lastName`, `address`, `gender`, `birthDate`,`image`,`email`,`phone`, `salary`, `credentialId`)
        VALUES ('".$data['firstName']."','".$data['lastName']."','".$data['address']."','".$data['gender']."','".$data['birthDate']."','".$data['image']."','".$data['email']."','".$data['phone']."','".$data['salary']."',".$data['credentialId'].")";
        echo $sql;
        $res = $conn->query($sql) ;
        $conn->close();
        return $res=== TRUE;
    }
    
    public static function findByiId($id){
        require __DIR__ . '/../services/connect.php';
        $sql = "SELECT * FROM admins WHERE id = $id ";
        $result =  $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
            $admin = new Admin(
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
            return $admin;
            }}else{
                $conn->close();
                return null;
            }
    }

    public static function findWhere($query){
        require __DIR__ . '/../services/connect.php';
        $sql = "SELECT * FROM admins WHERE $query ORDER BY created_at DESC;";
        $result =  $conn->query($sql);
        $admins = [];
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
            $admin = new Admin(
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
            array_push($admins,$admin);
        }
    } 
    $conn->close();
    return $admins;
    }
    
    static public function getByCredential(Credential $cred)
    {
        require __DIR__ . '/../services/connect.php';
        $sql = "SELECT * FROM admins WHERE credentialId = '".$cred->getId()."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $admin = new Admin(
                    $row['id'],
                    $row['firstName'],
                    $row['lastName'],
                    $row['address'],
                    $row['gender'],
                    $row['birthDate'],
                    $row['image'],
                    $row['email'],
                    $row['phone'],
                    $row['salary']
                );
                $conn->close();
                return $admin;
            }
        } else {
            $conn->close();
            return null;
        }
    }

    public function update():bool{
        require __DIR__ . '/../services/connect.php';
        $sql = "UPDATE `admins` SET `firstName`='".$this->firstName."',`lastName`='".$this->lastName."',`address`='".$this->address."',`gender`='".$this->gender."',`birthDate`='".$this->birthDate."',`salary`='".$this->salary."' WHERE id=".$this->id;
        $res = $conn->query($sql) ;
        $conn->close();
        return $res=== TRUE;
    }
    public function delete(): bool
    {
        require __DIR__ . '/../services/connect.php';
        $sql = "DELETE FROM admins WHERE id='$this->id'";
        $res = $conn->query($sql) ;
        $conn->close();
        return $res;
    }
    public static function deleteById($id): bool
    {
        require __DIR__ . '/../services/connect.php';
        $sql = "DELETE FROM admins WHERE id='$id'";
        $res = $conn->query($sql) ;
        $conn->close();
        return $res;
    }

}