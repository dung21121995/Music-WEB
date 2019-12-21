<?php
class Home extends Controller
{
  protected $SongModel;
 // protected $AlbumModel;

  public function __construct(){
    $this->SongModel=$this->model("SongModel");
  //  $this->AlbumModel=$this->model("AlbumModel");
  } 
    public function Sayhi(){
    
     
      $this->view("HomeView",
      [
        "page" => "HomeUser",
       
        "newsong" =>$this->SongModel->getNewSong(),
        "album" =>$this->SongModel->getAlbum(),
        "album2"=>$this->SongModel->getAlbumSpec(),
        "album3"=>$this->SongModel->getAlbumSpec2(),
        "topview" =>$this->SongModel->topView(),
        "topAlbum"=>$this->SongModel->topAlbum(),
        "a" =>$this->SongModel->getCategory()
      ]);
    }

    public function Login(){
  
      $this->view("LoginView",[]);
      
      
    }

    public function logout(){
      session_destroy();
      header("Location:../Home");
      exit();
      
    }
    public function Search(){
      if (isset($_POST['submit'])) {
        # code...
        $_SESSION["search"] =$_POST["search"];
        header("Location:../Search/Result");
          exit();
    }

    
  }
  public function admin(){
    $this->view("admin",[
      "page"=>"report"
    ]);
  }

    
}
?>