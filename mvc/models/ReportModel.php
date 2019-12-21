<?php
    class ReportModel extends DB
    {
   
        public function AlbumWeek()
        {
            $sql= ('SELECT * FROM `album1` ORDER BY week DESC LIMIT 3; ');
            return mysqli_query($this->con, $sql);
        }
        public function CategoryWeek()
        {
            $sql= ('SELECT * FROM `category` ORDER BY week DESC LIMIT 3; ');
            return mysqli_query($this->con, $sql);
        }
        public function SongWeek()
        {
            $sql= ('SELECT DISTINCT song.id_song, song.song_name,song.views,song.week,song.link_song,song.liycs_song,song.song_img,singer.singer_name from song  inner JOIN detail_song ON song.id_song=detail_song.id_song inner join singer on detail_song.id_singer=singer.id_singer where song.status_song=1 ORDER BY song.week DESC LIMIT 3; ');
            return mysqli_query($this->con, $sql);
        }
        
        public function SingerWeek()
        {
            $sql= ('SELECT * FROM `singer` ORDER BY week DESC LIMIT 3; ');
            return mysqli_query($this->con, $sql);
        }
        public function UserPost(){
            $sql="SELECT user_web.user_img,user_web.user_name,user_web.user_fullname ,COUNT(song.id_song) from user_web INNER JOIN song on user_web.id_user=song.id_user GROUP by user_web.id_user;";
            return mysqli_query($this->con, $sql);
        }

    // show tháng
         public function AlbumMonth()
         {
             $sql= ('SELECT * FROM `album1` ORDER BY `month` DESC LIMIT 3; ');
             return mysqli_query($this->con, $sql);
         }
         public function CategoryMonth()
         {
             $sql= ('SELECT * FROM `category` ORDER BY `month` DESC LIMIT 3; ');
             return mysqli_query($this->con, $sql);
         }
         public function SongMonth()
         {
             $sql= ('SELECT * FROM `song` ORDER BY `month` DESC LIMIT 3; ');
             return mysqli_query($this->con, $sql);
         }
         public function SingerMonth()
         {
             $sql= ('SELECT * FROM `singer` ORDER BY `month` DESC LIMIT 3; ');
             return mysqli_query($this->con, $sql);
         }
         public function SingupTime()
         {
             $sql= ('SELECT * FROM `user_web` where WEEK(date_cre) = WEEK(CURRENT_TIME) and id_role="U"; ');
             return mysqli_query($this->con, $sql);
         }
         public function SingupTime1()
         {
             $sql= ('SELECT * FROM `user_web` where WEEK(date_cre) = WEEK(CURRENT_TIME) - 1 and id_role="U"; ');
             return mysqli_query($this->con, $sql);
         }


    // show năm
         public function AlbumYear()
         {
             $sql= ('SELECT * FROM `album1` ORDER BY `year` DESC LIMIT 3; ');
             return mysqli_query($this->con, $sql);
         }
         public function CategoryYear()
         {
             $sql= ('SELECT * FROM `category` ORDER BY `year`  DESC LIMIT 3; ');
             return mysqli_query($this->con, $sql);
         }
         public function SongYear()
         {
             $sql= ('SELECT * FROM `song` ORDER BY `year`  DESC LIMIT 3; ');
             return mysqli_query($this->con, $sql);
         }
         public function SingerYear()
         {
             $sql= ('SELECT * FROM `singer` ORDER BY `year`  DESC LIMIT 3; ');
             return mysqli_query($this->con, $sql);
         }
 
 
    // Report
    // report năm
        public function UpdateTopSongByYear()
        {
            $stmt = $this->con->prepare('UPDATE song SET year = 0, month = 0, week = 0;');
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
        public function UpdateTopSingerByYear()
        {
            $stmt = $this->con->prepare('UPDATE singer SET year = 0, month = 0, week = 0;');
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
        public function UpdateTopCategoryByYear()
        {
            $stmt = $this->con->prepare('UPDATE category SET year = 0, month = 0, week = 0;');
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
        public function UpdateTopAlbumByYear()
        {
            $stmt = $this->con->prepare('UPDATE album SET year = 0, month = 0, week = 0;');
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

    // report tháng
        public function UpdateTopSongByMonth()
        {
            $stmt = $this->con->prepare('UPDATE song SET month = 0, week = 0;');
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
        public function UpdateTopSingerByMonth()
        {
            $stmt = $this->con->prepare('UPDATE singer SET month = 0, week = 0;');
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
        public function UpdateTopCategoryByMonth()
        {
            $stmt = $this->con->prepare('UPDATE category SET month = 0, week = 0;');
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
        public function UpdateTopAlbumByMonth()
        {
            $stmt = $this->con->prepare('UPDATE album SET month = 0, week = 0;');
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

    //report tuần
        public function UpdateTopSongByWeek()
        {
            $stmt = $this->con->prepare('UPDATE song SET week = 0;');
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
        public function UpdateTopSingerByWeek()
        {
            $stmt = $this->con->prepare('UPDATE singer SET week = 0;');
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
        public function UpdateTopCategoryByWeek()
        {
            $stmt = $this->con->prepare('UPDATE category SET week = 0;');
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
        public function UpdateTopAlbumByWeek()
        {
            $stmt = $this->con->prepare('UPDATE album SET week = 0;');
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }

    }
?>