<?php 
class logout{

public function Sayhi(){
    session_destroy();
    header("Location:./Home/Sayhi");
    exit();
    }
}


?>