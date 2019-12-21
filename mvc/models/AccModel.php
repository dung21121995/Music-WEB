<?php
class AccModel extends DB
{
    public function TimKiem($varchar)
    {
        $sql = ("SELECT * FROM `user_web` WHERE song_name REGEXP '$varchar' ORDER BY id_user DESC");
        return mysqli_query($this->con, $sql);
    }
    public function getAcc()
    {
        $sql = ("SELECT * from user_web where `id_role` = 'U'");
        return mysqli_query($this->con, $sql);
    }
    public function getAccNv()
    {
        $sql = ("SELECT * from user_web where `id_role` = 'Nv'");
        return mysqli_query($this->con, $sql);
    }
    public function getAccSinger()
    {
        $sql = ("SELECT * from user_web where `id_role` = 'S'");
        return mysqli_query($this->con, $sql);
    }
    public function getAccNvPt($a,$b)
    {
        $sql = ("SELECT * from user_web  where `id_role` = 'Nv' LIMIT $a,$b ");
        return mysqli_query($this->con, $sql);
    }
    public function getAccNvCount()
    {
        $sql = ("SELECT count(id_user) from user_web  where `id_role` = 'Nv'");
        return mysqli_query($this->con, $sql);
    }
    public function getAccByUserName($name)
    {
        $sql = ("SELECT * from `user_web` where `user_name` = '$name';");
        $row = mysqli_query($this->con, $sql);
        if (mysqli_num_rows($row) != 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function getAccById($id)
    {
        $sql = ("SELECT * from user_web where `id_user` = '$id'");
        return mysqli_query($this->con, $sql);
    }

    public function addAcc($name, $pass, $time)
    {
        $stmt = $this->con->prepare("INSERT INTO `user_web`( `user_name`, `user_password`, `id_role`, `registration_date`) VALUES (?,?,'U',?)");
        $stmt->bind_param("sss", $name, $pass, $time);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function addAccNv($name, $day, $add, $uname, $email, $pass, $time)
    {
        $stmt = $this->con->prepare("INSERT INTO `user_web` (`user_fullname`, `birthday`, `address`, `user_name`, `email`, `user_password`,  `id_role`, `registration_date`)
         VALUES (?,?,?,?,?,?,'Nv',?)");
        $stmt->bind_param("sssssss", $name, $day, $add, $uname, $email, $pass, $time);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function addSinger($uname, $name,$pass, $time,$mota)
    {
        $stmt = $this->con->prepare("INSERT INTO `user_web`( `user_fullname`,`user_name`, `user_password`, `id_role`, `registration_date`,`des_singer`)
         VALUES (?,?,?,'S',?,?)");
        $stmt->bind_param("sssss", $uname, $name, $pass, $time, $mota);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function lockAcc($id, $noidung)
    {
        $stmt = $this->con->prepare('UPDATE `user_web` SET `time_lock`= 1,`note`=? WHERE `id_user`= ?');
        $stmt->bind_param("si", $noidung, $id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function openAcc($id)
    {
        $stmt = $this->con->prepare('UPDATE `user_web` SET `time_lock`= 2, `note`=null WHERE `id_user`= ?');
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteAcc($id)
    {
        $stmt = $this->con->prepare('DELETE FROM `user_web` WHERE `id_user`= ?');
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function editAccNv($name, $day, $add, $email, $id)
    {
        $stmt = $this->con->prepare("UPDATE `user_web` SET `user_fullname` = ?, `birthday` = ?, `address`=?, `email` = ?
         WHERE `user_web`.`id_user` = ?;");
        $stmt->bind_param("ssssi", $name, $day, $add, $email, $id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function editSinger($name, $mota, $id)
    {
        $stmt = $this->con->prepare("UPDATE `user_web` SET `user_fullname` = ?, `des_singer` = ?
         WHERE `user_web`.`id_user` = ?;");
        $stmt->bind_param("ssi", $name, $mota, $id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function LimitAcc($start,$limit)
    {
        $sql = ("SELECT * from user_web where `id_role` = 'U' LIMIT $start, $limit;");
        return mysqli_query($this->con, $sql);
    }
    public function LimitAccNv($start,$limit)
    {
        $sql = ("SELECT * from user_web where `id_role` = 'Nv' LIMIT $start, $limit;");
        return mysqli_query($this->con, $sql);
    }
    public function LimitAccSinger($start,$limit)
    {
        $sql = ("SELECT * from user_web where `id_role` = 'S' LIMIT $start, $limit;");
        return mysqli_query($this->con, $sql);
    }

    public function countAcc(){    
        $sql = ("SELECT count(id_user) from user_web where `id_role` = 'U';");
        return mysqli_query($this->con, $sql);
    }
    public function countAccNv(){    
        $sql = ("SELECT count(id_user) from user_web where `id_role` = 'Nv';");
        return mysqli_query($this->con, $sql);
    }
    public function countAccSinger(){    
        $sql = ("SELECT count(id_user) from user_web where `id_role` = 'S';");
        return mysqli_query($this->con, $sql);
    }
}