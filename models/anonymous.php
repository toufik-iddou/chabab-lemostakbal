<?php
require_once  'person.php';
abstract class Anonymous extends Person{

    public function __construct(
        int $id, 
        string $firstName, 
        string $lastName, 
        string $address, 
        String $gender,
    ){
        parent::__construct($id, $firstName, $lastName, $address, $gender);
    }

    
}