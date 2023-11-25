<?php
require_once  'person.php';
abstract class User extends Person
{
    protected $birthDate;
    protected String $image;

    protected Credential $credential;

    public function __construct(
        int $id,
        string $firstName,
        string $lastName,
        string $address,
        String $gender,
        $birthDate,
        String $image,
    ) {
        parent::__construct($id, $firstName, $lastName, $address, $gender);
        $this->birthDate = $birthDate;
        $this->image = $image;
    }

    // getter and setter methods
    public function getUserName(): string
    {
        return $this->credential->userName;
    }
    public function getBirthDate(): string
    {
        return $this->birthDate;
    }
    public function getImage(): string
    {
        return $this->image;
    }
    public function getCredential(): Credential
    {
        return $this->credential;
    }
    public function setUserName(string $userName): void
    {
        $this->credential->userName = $userName;
    }
    public function setBirthDate(string $birthDate): void
    {
        $this->birthDate = $birthDate;
    }
    public function setCredential(Credential $credential): void
    {
        $this->credential = $credential;
    }


    //connect to db 
    abstract static public function getByCredential(Credential $cred);
    
}

?>