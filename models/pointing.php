<?php

require_once  'auth.php';
class Pointing {
    private Credential $user ;
    private int $id;
    public function __construct(
        int $id, 
        int $userId
    ){
     $this->id =$id;
     $this->user= new Credential($userId,"","");
    }
    
    static public function create($data){
        require __DIR__ . '/../services/connect.php';
        $sql = "INSERT INTO pointings ( `user`)
        VALUES (".$data['user'].")";
        $res = $conn->query($sql) ;
        $conn->close();
        return $res=== TRUE;
    }  
    static public function exist($data):bool{
        require __DIR__ . '/../services/connect.php';
        $sql = "SELECT count(*) as total FROM pointings WHERE user=".$data['user']." and  DATE(created_at) = '".$data['date']."'";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
            $conn->close();
            return $row['total']!=0;
        }   }
        
        return false;
    }  
}?>