<?php
class playlist extends Controller
{
   
    
    public function Listenlist(){
     
     $song= $this->model("SongModel");
      $this->view("HomeView",
      [
        "page" =>"tsts",
        "datasong"=>$song->getNewSong(),
        
        
      ]);
      
    }
    public function AlbumShow(){

    }
    public function PlayAlbum(){
      
    }
}
?>