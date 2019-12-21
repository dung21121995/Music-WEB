<?php
class Song extends Controller
{
   
    
    public function Listenit($id){
     
     $song= $this->model("SongModel");
     if ($song->updatView($id) === 'true') {
       # code...
       $datasong= $song->getid($id);
       $id_re=$datasong["id_region"];
       $this->view("HomeView",
      [
        "page" =>"ListenSong",
        "datasong"=>$song->getNewSong(),
        "id_song"=>$song->getid($id),
        "topregion" =>$song->topViewRegion($id_re)
        
      ]);
     }
      
      
    }
    public function AlbumShow($id){
      $song= $this->model("SongModel");
      if ($song->updateViewAlbum($id) === 'true') {
      $this->view("HomeView",
      [
        "page" =>"album",
        "dataalbum"=>$song->getAlbumbyId($id),
        "SonginAlbum"=>$song->getSongbyIDAlbum($id),
        "album"=>$song->getAlbum(),
        "song" => $song->getNewSong()
      ]);
      }
    }
    public function PlayAlbum($id){
      $song= $this->model("SongModel");
      $datasong= $song->getAlbumid($id);
      $id_re=$datasong["id_region"];
      $this->view("HomeView",
      [
        "page" =>"playlist",
        "datasong"=>$song->getSongbyIDAlbum($id),
        "albums" =>$song->getAlbumid($id),
        "topregion" =>$song->topViewRegion($id_re)
        
      ]);
    }

    public function AllAlbum(){
       $song= $this->model("SongModel");
      
    
      $this->view("HomeView",
      [
        "page"=>"showAlbum",
        "region"=>$song->getRegion(),
        "allalbum"=>$song->getVnAlbum()
       
      ]);
    }
    
}
?>