<?php
require_once __DIR__ . '/../utils/enums.php';
require_once  'client.php';
require_once  'classroom.php';
require_once  'child-parent.php';
class Kid extends Client{
    protected Classroom $classroom;
    protected ChildParent $childParent;
    
    public function __construct(
        int $id, 
        string $firstName, 
        string $lastName, 
        string $address, 
        String $gender, 
        $birthDate,
        string $image,
        int $classroomId,
        string $parentId,
    ){
        parent::__construct($id, $firstName, $lastName, $address, $gender, $birthDate,$image);
        $this->classroom = new Classroom( $classroomId,"","",-1 );
        $this->childParent = new ChildParent( $parentId,"","","","","","" );

    }
    // getter and setter methods
    public function fetchClassroom(){
        require __DIR__ . '/../services/connect.php';
        $sql = "SELECT * FROM classrooms WHERE id = ".$this->classroom->getId();
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
    public static function create($data){
        require __DIR__ . '/../services/connect.php';
        $sql = "INSERT INTO `kids` ( `firstName`, `lastName`, `address`, `gender`, `birthDate` ,`image`, `classroom`,`parent`, `credentialId`)
        VALUES ('".$data['firstName']."','".$data['lastName']."','".$data['address']."','".$data['gender']."','".$data['birthDate']."','".$data['image']."','".$data['classroom']."','".$data['parent']."',".$data['credentialId'].")";
        echo "<br>".$sql."<br>";
        $res = $conn->query($sql) ;
        $conn->close();
        return $res=== TRUE;
    }
    public static function findByiId($id){
        require __DIR__ . '/../services/connect.php';
        $sql = "SELECT * FROM kids WHERE id= $id";
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
            $row['image'],
            $row['classroom'],
            $row['parent'],
        );
            $conn->close();
            return $kid;
            }   }else{
                $conn->close();
                return null;
            } 
    }
    public static function findWhere($query){
        require __DIR__ . '/../services/connect.php';
        $sql = "SELECT * FROM kids WHERE $query ORDER BY created_at DESC;";
        $result =  $conn->query($sql);
        
        $kids = [];
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
            $kid = new Kid(
            $row['id'],
            $row['firstName'],
            $row['lastName'],
            $row['address'],
            $row['gender'],
            $row['birthDate'],
            $row['image'],
            $row['classroom'],
            $row['parent'],
        
        );
            array_push($kids,$kid);
        }
    } 
    $conn->close();
    return $kid;
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
            $row['image'],
            $row['classroom'],
            $row['parent'],
        );
            $conn->close();
            return $kid;
            }   }else{
                $conn->close();
                return null;
            }    
    }
    
    public function update():bool{
        require __DIR__ . '/../services/connect.php';
        $sql = "UPDATE `kids` SET `firstName`='".$this->firstName."',`lastName`='".$this->lastName."',`address`='".$this->address."',`gender`='".$this->gender."',`birthDate`='".$this->birthDate."',`classroom`='".$this->classroom."' WHERE id=".$this->id;
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
    public function deleteById($id):bool{
        require __DIR__ . '/../services/connect.php';
        $sql = "DELETE FROM kids WHERE id='$id'";
        $res = $conn->query($sql) ;
        $conn->close();       
        return $res;
    }

    
}