<?php
class Login extends Controller{
    public $UserModel;

    public function __construct(){
        $this->UserModel= $this->model("UserModel");
    }
    public function Sayhi(){
        
         
    }

    public function UserLogin(){
        if (!empty($_SESSION['email'])) {
            # code...
            header("Location:./Home");
            exit();
        }
        //1 Get Data User from Form

        
        //2 Check User Acc exist DB
        if (isset($_POST['login-btn'])) {
            # code...
          if ($this->UserModel->CheckUser(htmlspecialchars($_POST['name']),htmlspecialchars($_POST['password'])) === 'true')
          header("Location:../Home");
          exit();
          
           
        }
        //3 Show View Result
    }
}

?>