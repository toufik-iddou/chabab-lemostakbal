<?php
class Credential {
    private int $id;
    private String $userName;
    private String $role;

    public function __construct($id,$userName,$role) {
        $this->id = $id;
        $this->userName = $userName;
        $this->role = $role;
    } 
    //setters and getter
    public function getId() {
        return $this->id;
    }
    public function getUserName() {
        return $this->userName;}
        public function getRole() {
        return $this->role;
    }
    //db connection
    public static function register($userName, $pw, $role): int {
        require '../../services/connect.php';
        echo "$pw ss<br>";
        $hashedPassword = password_hash($pw, PASSWORD_DEFAULT);
        
        $stmt = $conn->prepare("INSERT INTO credentials (`userName`, `password`, `role`) VALUES (?, ?, ?)");
        
        $stmt->bind_param("sss", $userName, $hashedPassword, $role);
        
        $stmt->execute();
        
        $credentialId = $stmt->insert_id;
        
        $stmt->close();
        $conn->close();
        
        return $credentialId;
    }
    
    public static function login($userName,$pw):Credential|null{
        require '../../services/connect.php';
        $sql = "SELECT * from credentials where userName='$userName'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if (password_verify($pw,$row["password"])) {  
                    $conn->close();
                    return new Credential($row["id"],$row["userName"],$row["role"]);
                } 
            }
          }
          $conn->close();
          return null;
    }
}
?>