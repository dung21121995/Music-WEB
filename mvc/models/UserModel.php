<?php
class UserModel extends DB{
    

    public function CheckUser($email, $password){
        $result=$this->con->query("select * from user_web where email='$email';");
        $kq=false;
        if ($result->num_rows == 0) {
            # code...
            $_SESSION['message']="User dosen't exits !";
           
        }
        else {
            # code...
            $user=$result->fetch_assoc();
            if (password_verify($password, $user['user_password']) && $user['time_lock'] == 1){
                # code...
                $_SESSION['user_fullname']=$user['user_fullname'];
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['email']=$user['email'];
                $_SESSION['id_role'] =$user['id_role'];
                $_SESSION['user_name'] =$user['user_name'];
                $_SESSION['user_img'] =$user['user_img'];
               
                $kq=true;
               
            }
           
        }
        return json_encode($kq);
    }
    public function Profile($id){
        $sql="select * from user_web where id_user = $id";
        $result = mysqli_query($this->con, $sql);
        $row = array();
        if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    }    
        return $row;
    }

    public function RegisterU($user_name,$email,$password){
    $sql="insert into user_web(user_name,email,user_password) values('$user_name','$email','$password');";
        $result=false;
    if (mysqli_query($this->con,$sql)) {
    
        $result=true;
    }
    return json_encode($result);
    }

    public function getU($id){
        $sql="SELECT * from user_web where id_user=$id;";
        $result = mysqli_query($this->con, $sql);
        $row = array();
        if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    }    
        return $row;
    }


    
   
}


?>