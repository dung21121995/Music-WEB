<?php
    class AlbumModel extends DB 
    {
        public function Limitalbum($start, $limit)   
        {
            $sql=('SELECT * from album1 LIMIT '.$start.', '.$limit.';');
            return mysqli_query($this->con, $sql);
        }
        public function Countalbum()  
        {
            $sql=('SELECT count(id_album) from album1;');
            return mysqli_query($this->con, $sql);
        }
        public function add($album, $date)
        {
            $stmt= $this->con->prepare("INSERT INTO `album1`(`album_name`, `date_add`) VALUE (?,?);");
            $stmt->bind_param('ss', $album, $date);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
        public function edit($album, $id)
        {
            $stmt= $this->con->prepare('UPDATE album1 SET album_name = ? where id_album = ?;');
            $stmt->bind_param('si', $album, $id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
        public function delete($id)
        {
            $stmt = $this->con->prepare('DELETE FROM album1 where id_album =?;');
            $stmt->bind_param('i', $id);
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

    }
    

?>