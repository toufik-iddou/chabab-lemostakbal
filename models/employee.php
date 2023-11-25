<?php
require_once  'user.php';
abstract class Employee extends User{
    protected float $salary;
    protected String $email;
    protected String $phone;

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
        int $salary,
    ){
        parent::__construct($id, $firstName, $lastName, $address, $gender, $birthDate,$image);
        $this->salary = $salary;
        $this->email = $email;
        $this->phone = $phone;
    }

    // getter and setter methods
    public function getSalary():float{
        return $this->salary;
    }
    public function setSalary($salary):void{
        $this->salary = $salary;
    }

   

    public function incrementSalaryAndSave($inc):bool{
        require __DIR__ . '/../services/connect.php';
        $sql = "UPDATE employee
        SET salary = salary + $inc
        WHERE id = '$this->id'";
        $res = $conn->query($sql);
        $conn->close();
        return $res;
    }
    //db connection

    
}