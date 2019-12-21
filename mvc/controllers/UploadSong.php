<?php 

class UploadSong extends Controller{
    protected $SongModel;

    public function __construct(){
        $this->SongModel= $this->model("SongModel");
    }
    public function Sayhi(){
        $this->view("HomeView",
        ["page" =>"upload-song"]);
    }

    public function UserUp(){
      if (isset($_POST["submit"])){
          $name=$_POST["song_name"];
          $sound_path = BASE_URL."public/songs/";
    
         
  
              
  
              $goal_path = basename( $_FILES['link_song']['name']);  
  
              if(move_uploaded_file($_FILES['link_song']['tmp_name'], $sound_path))  
              {  
                $kq=$this->SongModel->addSongGetId($name,$goal_path);

                $this->view("HomeView",
                [
                    "page" =>"upload-song",
                    "result"=>$kq
                ]);
              }
  
              if(file_exists($goal_path)){
                  echo 'File '.$_FILES['link_song']['name'].' uploaded successfully.';
              }
        

         
      }
    }
}

?>