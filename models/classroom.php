<?php

require_once  'sitter.php';
require_once  'kid.php';
require_once  'db_object.php';
class Classroom implements IDbObject {
    private Sitter $sitter ;
    private array $kids ;
    private int $id;
    private string $name;
    private string $level;
    public function __construct(
        int $id, 
        string $name,
        String $level,
        int $sitterId
    ){
     $this->id =$id;
     $this->name =$name;
     $this->level =$level;
     $this->sitter= new Sitter($sitterId,"","","","","","","","",-1);
    }

    // getter and setter methods

    public function getId():int{
        return $this->id;
        }

    public function getName():string{
        return $this->name;
        }
        public function setId(int $id):void{
            $this->id =$id;
        }
        public function setName(string $name):void{
            $this->name =$name;
        }
        public function getSitter():Sitter{
            return $this->sitter;
        }
        public function setSitter(Sitter $sitter):void{
            $this->sitter =$sitter;
        }
        public function getKids():array{
            return $this->kids;
            }
        public function setKids(array $kids):void{
            $this->kids =$kids;
        }
        public function addKid(Kid $kid):void{
            array_push($this->kids,$kid);
        }
        public function removeKid(Kid $kid):void{
            $index = array_search($kid,$this->kids);
            if($index !== false){
                unset($this->kids[$index]);
            }
        }
        //db connection
        public static function create($data){
            require __DIR__ . '/../services/connect.php';
            $sql = "INSERT INTO classrooms (`name`,`sitter`,`level`)
            VALUES ('".$data['name']."','".$data['sitter']."','".$data['level']."')";
            $res = $conn->query($sql) ;
            $conn->close();
            return $res=== TRUE;
        }
        public static function findByiId($id){
            require __DIR__ . '/../services/connect.php';
            $sql = "SELECT * FROM classrooms WHERE id=$id";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $classroom = new Classroom(
                        $row['id'],
                        $row['name'],
                        $row['level'],
                        $row['sitter'],
                    );
                    $conn->close();
                    return $classroom;
                }
            }else{
                $conn->close();
                return null;
            } 
           }
       public static function findWhere($query):array{
        require __DIR__ . '/../services/connect.php';
        $sql = "SELECT * FROM classrooms WHERE $query ORDER BY created_at DESC;";
        $result = $conn->query($sql);
        $classrooms = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $classroom = new Classroom(
                    $row['id'],
                    $row['name'],
                    $row['level'],
                    $row['sitter'],
                );
                array_push($classrooms,$classroom);
            }
        } 
        $conn->close();
        return $classrooms;
       }
       public function update():bool{
        require __DIR__ . '/../services/connect.php';
        $sql = "UPDATE `classrooms` SET `name`='".$this->name."',`sitter`='".$this->sitter->getId()."',`level`='".$this->level."' WHERE id= ".$this->id;
        $res = $conn->query($sql) ;
        $conn->close();
        return $res=== TRUE;
    }
        public function delete():bool{
            require __DIR__ . '/../services/connect.php';
            $sql = "DELETE FROM classrooms WHERE id='$this->id'";
            $res = $conn->query($sql) ;
            $conn->close();       
            return $res;
        }
        public static function deleteById($id):bool{
            require __DIR__ . '/../services/connect.php';
            $sql = "DELETE FROM classrooms WHERE id='$id'";
            $res = $conn->query($sql) ;
            $conn->close();       
            return $res;
        }
}