<?php
abstract class Person
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
    public function getFirsName(): string
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
    abstract public static function create($data): bool;
    
    abstract public static function findByiId($id);
    abstract public function save(): bool;
    abstract public function delete(): bool;


}


?>