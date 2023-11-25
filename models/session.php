<?php

require_once  'classroom.php';
require_once  'db_object.php';
class session implements IDbObject{
    private Classroom $classroom ;
    private int $id; 
    private String $activity;
    private String $day;
    private $startAt;
    private $endAt;

    public function __construct(
        int $id, 
        string $activity,
        String $day,
        $startAt,
        $endAt,
        int $classroomId,
    ){
     $this->id =$id;
     $this->activity =$activity;
     $this->day =$day;
     $this->startAt =$startAt;
     $this->endAt =$endAt;
     $this->classroom= new Classroom($classroomId,"","",-1);
    }

    // getter and setter methods

    public function getId():int{
        return $this->id;
        }

   public function getActivity():string{
    return $this->activity;
}
public function getDay():String{
       return $this->activity;
}
public function getStartAt():String{
    return $this->startAt;
}
public function getEndAt():String{
    return $this->endAt;
}
public function getClassroomId():int{
    return
    $this->classroom->getId();
}
public function getClassroom():Classroom{
    return $this->classroom;
}
public function fetchClassroom():Classroom{
    $this->classroom=Classroom::findByiId($this->classroom->getId());
    return $this->classroom;
}
        //db connection
        public static function create($data){
            require __DIR__ . '/../services/connect.php';
            $sql = "INSERT INTO `sessions` (`activity`, `classroom`,`day`, `start_at`, `end_at`) VALUES ( '".$data["activity"]."', '".$data["classroom"]."', '".$data["day"]."', '".$data["start_at"]."','".$data["end_at"]."')";
            $res = $conn->query($sql) ;
            $conn->close();
            return $res=== TRUE;
        }
        public static function findByiId($id){
            require __DIR__ . '/../services/connect.php';
            $sql = "SELECT * FROM sessions WHERE id = $id";
            $result = $conn->query($sql);
          
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $session = new Session(
                        $row['id'],
                        $row['activity'],
                        $row['day'],
                        $row['start_at'],
                        $row['end_at'],
                        $row['classroom'],
                    );
                    $conn->close();
                    return $session;
                }
            } else{
                $conn->close();
                return null;
            }
        }
       public static function findWhere($query):array{
        require __DIR__ . '/../services/connect.php';
        $sql = "SELECT * FROM sessions WHERE $query ORDER BY created_at DESC;";
        $result = $conn->query($sql);
        $session = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $session = new Session(
                    $row['id'],
                    $row['activity'],
                    $row['$day'],
                    $row['$startAt'],
                    $row['$endAt'],
                    $row['$classroom'],
                );
                array_push($sessions,$session);
            }
        } 
        $conn->close();
        return $session;
       }
        public function update():bool{
            require __DIR__ . '/../services/connect.php';
            $sql = "UPDATE `sessions` SET `activity`='".$this->activity."',`classroom`='".$this->classroom."',`day`='".$this->day."',`start_at`='".$this->startAt."',`end_at`='".$this->startAt."' WHERE id=".$this->id;
            $res = $conn->query($sql) ;
            $conn->close();
            return $res=== TRUE;
        }
        public function delete():bool{
            require __DIR__ . '/../services/connect.php';
            $sql = "DELETE FROM sessions WHERE id='$this->id'";
            $res = $conn->query($sql) ;
            $conn->close();       
            return $res;
        }

        public function deleteById($id):bool{
            require __DIR__ . '/../services/connect.php';
            $sql = "DELETE FROM sessions WHERE id='$id'";
            $res = $conn->query($sql) ;
            $conn->close();       
            return $res;
        }
    
}