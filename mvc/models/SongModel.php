<?php 
class SongModel extends DB{
    //Song:
    public function getid($id){
        $sql="SELECT song.id_song, song.song_name,song.views,song.link_song,song.liycs_song,song.song_img,song.status_song,singer.id_singer,singer.singer_name,album1.album_name,category.category_name,region.id_region,region.region_name,user_web.user_name from song  inner JOIN user_web ON song.id_user=user_web.id_user inner JOIN detail_song ON song.id_song=detail_song.id_song inner join singer on detail_song.id_singer=singer.id_singer inner JOIN album1 ON detail_song.id_album=album1.id_album inner join category on detail_song.id_category=category.id_category inner join region on category.id_region=region.id_region where song.id_song=$id;";
        $result = mysqli_query($this->con, $sql);
        $row = array();
        if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    }    
        return $row;
    }
    
    public function getNewSong(){
        $sql="SELECT DISTINCT song.id_song, song.song_name,song.link_song,song.liycs_song,song.song_img,song.date_add,singer.singer_name from song  inner JOIN detail_song ON song.id_song=detail_song.id_song inner join singer on detail_song.id_singer=singer.id_singer where WEEK(date_add) = WEEK(CURRENT_TIME) and status_song=1; ";
        return mysqli_query($this->con,$sql);
    }
    public function getSong($name){
        $sql="SELECT song.id_song, song.song_name,song.link_song,song.liycs_song,song.song_img, album1.album_name,singer.singer_name from song  inner JOIN detail_song ON song.id_song=detail_song.id_song inner join singer on detail_song.id_singer=singer.id_singer inner join album1 on detail_song.id_album=album1.id_album where song.song_name like '%".$name."%' and status_song=1";
        return mysqli_query($this->con,$sql);
    }
    public function updatView($id){
        $sql = "update song set views=views+1 where id_song=$id";
        return json_encode(mysqli_query($this->con,$sql));
    }
    public function topView(){
        // $sql = "SELECT * FROM `song` ORDER BY views DESC LIMIT 10";
        $sql="SELECT DISTINCT song.id_song, song.song_name,song.views,song.link_song,song.liycs_song,song.song_img,singer.singer_name from song  inner JOIN detail_song ON song.id_song=detail_song.id_song inner join singer on detail_song.id_singer=singer.id_singer ORDER BY song.views DESC LIMIT 5 ; ";
        return mysqli_query($this->con,$sql);
    }
    public function getSongByIdUser($id){
        $sql="SELECT song.id_song, song.song_name,song.views,song.link_song,song.liycs_song,song.status_song,song.song_img,singer.id_singer,singer.singer_name,album1.album_name,category.category_name,region.id_region,region.region_name,user_web.user_name from song  inner JOIN user_web ON song.id_user=user_web.id_user inner JOIN detail_song ON song.id_song=detail_song.id_song inner join singer on detail_song.id_singer=singer.id_singer inner JOIN album1 ON detail_song.id_album=album1.id_album inner join category on detail_song.id_category=category.id_category inner join region on category.id_region=region.id_region where song.id_user=$id";
        return mysqli_query($this->con,$sql);
    }
    public function topViewRegion($id){
      
        $sql="SELECT DISTINCT song.id_song, song.song_name,song.views,song.link_song,song.liycs_song,song.song_img,singer.singer_name,category.category_name, region.region_name from song  inner JOIN detail_song ON song.id_song=detail_song.id_song inner join singer on detail_song.id_singer=singer.id_singer inner JOIN album1 ON detail_song.id_album=album1.id_album inner join category on detail_song.id_category=category.id_category inner join region on category.id_region=region.id_region where region.id_region = $id  and song.status_song=1  ORDER BY song.views DESC LIMIT 5 ; ";
        return mysqli_query($this->con,$sql);
    }
    public function addSongGetId($name, $link, $lyric, $img,$id_user)
    {
        $stmt = $this->con->prepare('INSERT INTO `song`(`song_name`, `link_song`, `liycs_song`, `song_img`, `status_song`, `id_user`)
                VALUES (?,?,?,?, 2,?)');
        $stmt->bind_param("ssssi", $name, $link, $lyric, $img,$id_user);
        if ($stmt->execute()) {
            $last_id = $this->con->insert_id;
            return $last_id;
        } else {
            return false;
        }
    }
    public function addDetailSong($id_song, $id_singer, $id_category)
    {
        $stmt = $this->con->prepare('INSERT INTO `detail_song`(`id_song`, `id_singer`, `id_category`, `id_album`) VALUES (?, ?, ?,14);');
        $stmt->bind_param("iii", $id_song, $id_singer, $id_category);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function countSong(){    
        $sql = ('SELECT count(id_song) from song where status_song=1;');
        return mysqli_query($this->con, $sql);
    }

    public function Limit($start,$limit){
        $sql = ('SELECT  song.id_song, song.song_name,song.link_song,song.song_img,singer.id_singer,
        singer.singer_name, song.status_song,album1.album_name,song.date_add
        from song 
        inner JOIN detail_song ON song.id_song=detail_song.id_song 
        inner join singer on detail_song.id_singer=singer.id_singer 
        inner join album1 on detail_song.id_album=album1.id_album
        where song.status_song= 1 LIMIT '.$start.', '.$limit.';');
        // $sql = ('SELECT * FROM song ;');
        return mysqli_query($this->con, $sql);
    }
    public function LimitApp($start, $limit)
    {
        $sql = ('SELECT  song.id_song, song.song_name,song.link_song,song.song_img,singer.id_singer,
        singer.singer_name, song.status_song,album1.album_name,song.date_add,user_web.user_name
        from song inner JOIN user_web on song.id_user=user_web.id_user
        inner JOIN detail_song ON song.id_song=detail_song.id_song 
        inner join singer on detail_song.id_singer=singer.id_singer 
        inner join album1 on detail_song.id_album=album1.id_album
        where song.status_song= 2 LIMIT '.$start.', '.$limit.';');
        // $sql = ('SELECT * FROM song ;');
        return mysqli_query($this->con, $sql);
    }
    public function countApp(){    
        $sql = ('SELECT count(id_song) from song where status_song=2;');
        return mysqli_query($this->con, $sql);
    }

    public function updateSong($song_name, $lyric, $img, $id)
    {
        $stmt = $this->con->prepare('UPDATE `song` SET `song_name`= ? ,`link_song`=?,
                `liycs_song`=?,`song_img`=?
                WHERE `id_song`=?;');
        $stmt->bind_param("ssssi", $song_name, $link, $lyric, $img, $id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteDetail($id)
    {
        $stmt = $this->con->prepare('DELETE from `detail_song` where `id_song`= ?');
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteSong($id)
    {
        $stmt = $this->con->prepare('DELETE from `song` where `id_song`= ?');
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function approval($id)
    {
        $stmt = $this->con->prepare('UPDATE `song` SET `status_song` = 1 WHERE `id_song` = ?;');
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    //Album
    public function getAlbum(){
        $sql="SELECT DISTINCT album1.id_album,album1.album_name,album1.alnum_img from album1 inner join detail_album on album1.id_album=detail_album.id_album inner join title on detail_album.id_title= title.id_title where title.id_title=1";
        return mysqli_query($this->con,$sql);
    }
    public function getAlbumid($id){
        $sql="SELECT song.id_song, song.song_name,song.views,song.link_song,song.liycs_song,song.song_img,singer.singer_name,album1.album_name,album1.alnum_img,category.category_name,region.id_region,region.region_name from song  inner JOIN detail_song ON song.id_song=detail_song.id_song inner join singer on detail_song.id_singer=singer.id_singer inner JOIN album1 ON detail_song.id_album=album1.id_album inner join category on detail_song.id_category=category.id_category inner join region on category.id_region=region.id_region where album1.id_album=$id;";
        $result = mysqli_query($this->con, $sql);
        $row = array();
        if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    }    
        return $row;
    }
    public function getAlbumSpec(){
        $sql="SELECT DISTINCT album1.id_album,album1.album_name,album1.alnum_img from album1 inner join detail_album on album1.id_album=detail_album.id_album inner join title on detail_album.id_title= title.id_title where title.id_title=2";
        return mysqli_query($this->con,$sql);
    }
    public function getAlbumSpec2(){
        $sql="SELECT DISTINCT album1.id_album,album1.album_name,album1.alnum_img from album1 inner join detail_album on album1.id_album=detail_album.id_album inner join title on detail_album.id_title= title.id_title where title.id_title=3";
        return mysqli_query($this->con,$sql);
    }
    public function getRegion(){
        $sql="select * from region;";
        return mysqli_query($this->con,$sql);
    }
    public function getVnAlbum(){
        $sql="SELECT DISTINCT album1.id_album,album1.album_name,album1.alnum_img,category.category_name,region.id_region,region.region_name from album1 inner join category on album1.id_category=category.id_category inner join region on category.id_region=region.id_region where region.id_region=1";
        return mysqli_query($this->con,$sql);
    }
    public function getAlbumbyId($id){
        $sql="select * from album1 where id_album=$id;";
        $result = mysqli_query($this->con, $sql);
        $row = array();
        if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    }    
        return $row;
    }
    
    public function getAlbumbyName($name){
        $sql="select * from album1 where album_name like '%".$name."%'";
        return mysqli_query($this->con, $sql);
       
    }
    public function getSongbyIDAlbum($id){
        $sql="SELECT song.id_song, song.song_name,song.link_song,song.liycs_song,song.song_img, album1.album_name,singer.singer_name from song  inner JOIN detail_song ON song.id_song=detail_song.id_song inner join singer on detail_song.id_singer=singer.id_singer inner join album1 on detail_song.id_album=album1.id_album where album1.id_album=$id";
        return mysqli_query($this->con,$sql);
    }
     public function topAlbum(){
        // $sql = "SELECT * FROM `song` ORDER BY views DESC LIMIT 10";
        $sql="SELECT DISTINCT * from album1  ORDER BY album1.view_album DESC LIMIT 10 ; ";
        return mysqli_query($this->con,$sql);
    }
    public function updateViewAlbum($id){
        $sql = "update album1 set view_album=view_album+1 where id_album=$id";
        return json_encode(mysqli_query($this->con,$sql));
    }
    //Category:
    public function getCategory(){
        $sql="select * from category;";
        return mysqli_query($this->con, $sql);
    }
    public function getCategoryByName($name)
    {
        $sql = ("SELECT * from category where category_name = '$name';");
        return mysqli_query($this->con, $sql);
    }
    


    //Singer
    public function addSingerbySongGetId($name)
    {
        $stmt = $this->con->prepare('INSERT INTO `singer`(`singer_name`) VALUES (?)');
        $stmt->bind_param("s", $name);
        if ($stmt->execute()) {
            $last_id = $this->con->insert_id;
            return $last_id;
        } else {
            return false;
        }
    }

    public function updateSinger($singer_name, $id)
    {
        $stmt = $this->conn->prepare('UPDATE `singer` SET `singer_name`= ? WHERE `id_singer` =?;');
        $stmt->bind_param("si", $singer_name, $id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

}

?>