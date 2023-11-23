
<?php


?> 
<?php

?>
<html>
<body>

<?php





// if(!isset($_COOKIE[$cookie_name])) {
//   echo "Cookie named '" . $cookie_name . "' is not set!";
// } else {
//   echo "Cookie '" . $cookie_name . "' is set!<br>";
//   echo "Value is: " . $_COOKIE[$cookie_name];
//   echo "Value is: " . $_COOKIE["id"];
// }
?>

<?php
 
class c1{
    protected int $i;
    public function __construct(int $i){
      $this->$i=$i;
      if($this instanceof c2) {
        echo "the obj is c2";
      }else{
        echo "the obj is just c1";
      }
     $this->i=10;
    }
}

class c2 extends c1{
    public function __construct(){
        parent::__construct(0);
       
        echo $this->i;
    }
    
}

new c1(null);

?>

</body>
</html>