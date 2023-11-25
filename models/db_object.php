<?php
interface IDbObject{
    public static function create($data);
    public static function findByiId($id);
    public function update(): bool;
    public function delete(): bool;

}

?>