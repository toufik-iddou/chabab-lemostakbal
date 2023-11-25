<?php
require_once "db_object.php";
abstract class Person implements IDbObject
{
    protected int $id;
    protected string $firstName;
    protected string $lastName;
    protected string $address;
    protected String $gender ;


    public function __construct(
        int $id,
        string $firstName,
        string $lastName,
        string $address,
        String $gender ,
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->gender = $gender;

    }
    // getter and setter methods
    public function getId(): int
    {
        return $this->id;
    }
    public function getFirstName(): string
    {
        return $this->firstName;
    }
    public function getLastName(): string
    {
        return $this->lastName;
    }
    public function getAddress(): string
    {
        return $this->address;
    }
    public function getGender(): String
    {
        return $this->gender;
    }

    // db connection



}


?>