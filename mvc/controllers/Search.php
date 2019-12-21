<?php 
class Search extends Controller {
    protected $SongModel;
    // protected $AlbumModel;
   
     public function __construct(){
       $this->SongModel=$this->model("SongModel");
     //  $this->AlbumModel=$this->model("AlbumModel");
     } 
 public function Result(){
    if (isset( $_SESSION["search"])) {
        # code...
       
        $name =$_SESSION["search"];
    
      $this->view("HomeView",[
        "page"=>"Result",
        "datasearch"=>$this->SongModel->getSong($name),
        "dataalbumsr" => $this->SongModel->getAlbumbyname($name)

      ]);
      
    }
    else {
      echo "Search Error";
    }
 }


}



?>