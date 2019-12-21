<?php
class Register extends Controller{
    public $UserModel;

    public function __construct(){
        $this->UserModel= $this->model("UserModel");
    }
    public function Sayhi(){

      
        $this->view("RegisterView",[]);
         
    }

    public function UserSingup(){
        if (isset($_POST['reg'])) {
            $user_name= htmlspecialchars($_POST['name']);
            $email=htmlspecialchars($_POST['email']);
            $password=htmlspecialchars($_POST['password']);
            $pas= password_hash($password,PASSWORD_DEFAULT);

            $kq=$this->UserModel->RegisterU($user_name,$email,$pas);
          if ($kq === "true") {
              # code...
              
            if ($this->UserModel->CheckUser($email,$password) === 'true') {
                # code...
                header("Location:".BASE_URL);
                exit();
            }
         
          }
           
            
        }
    }
}

?>