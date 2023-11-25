<?php

class KidLevel
{
    const A = 'A';
    const B = 'B';
    const C = 'C';
    const D = 'D';
    
    const values =["A","B","C","D"];
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
const values =["admin","sitter","kid"];
};?>


<?php
Class Day
{
    const SUN="sunday";
    const MON="monday";
    const TUE="tuesday";
    const WED="wednesday";
    const THU="thursday";
const values =['sunday','monday','tuesday','wednesday','thursday'];
};?>

