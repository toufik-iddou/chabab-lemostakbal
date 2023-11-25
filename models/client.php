<?php

require_once  'user.php';
abstract class Client extends User{

    public function __construct(
        int $id, 
        string $firstName, 
        string $lastName, 
        string $address, 
        String $gender,
        $birthDate,
        string $image,
    ){
        parent::__construct($id, $firstName, $lastName, $address, $gender, $birthDate,$image );
    }

    // getter and setter methods

    
}