<?php
require_once __DIR__ . '/../utils/enums.php';
require_once  'client.php';
require_once  'classroom.php';
class Kid extends Client{
    protected Classroom $classroom;
    
    public function __construct(
        int $id, 
        string $firstName, 
        string $lastName, 
        string $address, 
        String $gender, 
        $birthDate,
        int $classroomId
    ){
        parent::__construct($id, $firstName, $lastName, $address, $gender, $birthDate);
        $this->classroom = new Classroom( $classroomId,null,null,-1 );

    }
    // getter and setter methods
    public function fetchClassroom(){
        require __DIR__ . '/../services/connect.php';
        $sql = "SELECT * FROM classroom WHERE id = ".$this->classroom->getId();
        $result =  $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                
            $classroom = new Classroom (
            $row['id'],
            $row['name'],
            $row['level'],
            $row['sitter']);
            $conn->close();
            return $classroom;
            }   }else{
                $conn->close();
                return null;
            }
    }
    
    public function getClassroom(){
        return $this->classroom;
    }
    // db connection
    public static function create($data):bool{
        require __DIR__ . '/../services/connect.php';
        $sql = "INSERT INTO kids ( `firstName`, `lastName`, `address`, `gender`, `birthDate`, `classroom`, `credentialId`)
        VALUES ('".$data['firstName']."','".$data['lastName']."','".$data['address']."','".$data['gender']."','".$data['birthDate']."','".$data['classroom']."',".$data['credentialId'].")";
        $res = $conn->query($sql) ;
        $conn->close();
        return $res=== TRUE;
    }
    public static function findByiId($id){

    }
    static public function getByCredential(Credential $cred){
        require __DIR__ . '/../services/connect.php';
        $sql = "SELECT * FROM kids WHERE credentialId = '".$cred->getId()."'";
        $result =  $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                
            $kid = new Kid (
            $row['id'],
            $row['firstName'],
            $row['lastName'],
            $row['address'],
            $row['gender'],
            $row['birthDate'],
        );
            $conn->close();
            return $kid;
            }   }else{
                $conn->close();
                return null;
            }    
    }
    public function save():bool{
        require __DIR__ . '/../services/connect.php';
        $birthDate = date_format($this->birthDate,'Y-m-d');
        $sql = "INSERT INTO kids (firstName,lastName,'address',gender,birthDate,'classroom',credentialId)
        VALUES ('$this->firstName','$this->lastName','$this->address','$this->gender','$birthDate','".$this->classroom->getId()."',".$this->credential->getId().")";
        $res = $conn->query($sql) ;
        $conn->close();
        return $res=== TRUE;
    }
    public function delete():bool{
        require __DIR__ . '/../services/connect.php';
        $sql = "DELETE FROM kids WHERE id='$this->id'";
        $res = $conn->query($sql) ;
        $conn->close();       
        return $res;
    }

    
}