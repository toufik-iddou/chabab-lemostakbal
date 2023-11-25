<?php
require_once 'anonymous.php';
class ChildParent extends Anonymous
{
    protected string $email;
    protected string $phone;
    public function __construct(
        int $id,
        string $firstName,
        string $lastName,
        string $address,
        string $gender,
        string $email,
        string $phone,
    ) {
        parent::__construct($id, $firstName, $lastName, $address, $gender);
        $this->email = $email;
        $this->phone = $phone;
    }
    // setter and getter methods


    public static function create($data)
    {
        require __DIR__ . '/../services/connect.php';
        $stmt = $conn->prepare("INSERT INTO parents (firstName, lastName, address, gender, email, phone) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $data["firstName"], $data["lastName"], $data["address"], $data["gender"], $data["email"], $data["phone"]);
    
        $stmt->execute();
    
        $id = $stmt->insert_id;
    
        $stmt->close();
        $conn->close();
    
        return $id;
    }
    
    public static function findByiId($id)
    {
        require __DIR__ . '/../services/connect.php';
        $sql = "SELECT * FROM parents WHERE id= $id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $kid = new ChildParent(
                    $row['id'],
                    $row['firstName'],
                    $row['lastName'],
                    $row['address'],
                    $row['gender'],
                    $row['email'],
                    $row['phone'],
                );
                $conn->close();
                return $kid;
            }
        } else {
            $conn->close();
            return null;
        }
    }
    public function update(): bool
    {
        require __DIR__ . '/../services/connect.php';
        $sql = "UPDATE `parents` SET `firstName`='" . $this->firstName . "',`lastName`='" . $this->lastName . "',`address`='" . $this->address . "',`gender`='" . $this->gender . "',`email`='" . $this->email . "',`phone`='" . $this->phone . "' WHERE id=" . $this->id;
        $res = $conn->query($sql);
        $conn->close();
        return $res === TRUE;
    }
    public function delete(): bool
    {
        require __DIR__ . '/../services/connect.php';
        $sql = "DELETE FROM child_parent WHERE id='$this->id'";
        $res = $conn->query($sql);
        $conn->close();
        return $res;
        ;
    }
    public function deleteById($id): bool
    {
        require __DIR__ . '/../services/connect.php';
        $sql = "DELETE FROM child_parent WHERE id='$id'";
        $res = $conn->query($sql);
        $conn->close();
        return $res;
        ;
    }
}