<?php

class KidLevel
{
    const A = 'A';
    const B = 'B';
    const C = 'C';
    const D = 'D';
    
    const values =["a","b","c","d"];
    static function isValid($level):bool{
        return in_array($level,self::values);
    }
    
};?>

<?php
Class Gender
{
    const MALE ="male";
    const  FEMALE="female";
    const values =["male","female"];
};?>

<?php
class Activity
{
    const ENGLISH="english";
    const ARABIC="arabic";
    const MATH="math";
    const DRAWING="drawing";
    const SPORT="sport";
    const values =["english","arabic","math","drawing","sport"];
};?>

<?php
class SessionStatus
{
    const PREPARATION="preparation";
    const STARTED="started";
    const ENDED="ended";
    const CANCELED="canceled";
    const values =["preparation","started","ended","canceled","sport"];
};?>

<?php
Class Role
{
    const ADMIN="admin";
    const SITTER="sitter";
    const KID="kid";
    const PARENT="parent";
const values =["admin","sitter","kid","parent"];
};?>

