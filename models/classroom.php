<?php

require_once  'sitter.php';
require_once  'kid.php';
class Classroom{
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
     $this->sitter= new Sitter($sitterId,null,null,null,null,null,-1);
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
        public static function create($data):bool{
            require __DIR__ . '/../services/connect.php';
            $sql = "INSERT INTO classroom ( `name`)
            VALUES ('".$data['name'].")";
            $res = $conn->query($sql) ;
            $conn->close();
            return $res=== TRUE;
        }
        public static function findByiId($id){
    
        }
       
        public function save():bool{
            require __DIR__ . '/../services/connect.php';
            $birthDate = date_format($this->birthDate,'Y-m-d');
            $sql = "INSERT INTO classroom (firstName,lastName,'address',gender,birthDate,'level',credentialId)
            VALUES ('$this->firstName','$this->lastName','$this->address','$this->gender','$birthDate','$data->level',$this->credentialId)";
            $res = $conn->query($sql) ;
            $conn->close();
            return $res=== TRUE;
        }
        public function delete():bool{
            require __DIR__ . '/../services/connect.php';
            $sql = "DELETE FROM classroom WHERE id='$this->id'";
            $res = $conn->query($sql) ;
            $conn->close();       
            return $res;
        }
    
}