<?php

require_once  'user.php';
abstract class Client extends User{

    public function __construct(
        int $id, 
        string $firstName, 
        string $lastName, 
        string $address, 
        String $gender,
        $birthDate
    ){
        parent::__construct($id, $firstName, $lastName, $address, $gender, $birthDate );
    }

    // getter and setter methods

    
}