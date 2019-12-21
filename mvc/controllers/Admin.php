<?php
class Admin extends Controller
{
    protected $re;
    protected $time;
    public function __construct()
    {
        ob_start();
        if (empty($_SESSION["email"])) {
            echo "<p style=\"color:red;text-align:center;\">Vui lòng login";
            header("location:".BASE_URL);
            exit();
        }
        
        $this->re=$this->model('ReportModel');
        
        $this->time = time();
        if(date('z', $this->time) == '0') {
            // Ngày đầu tiên trong năm
            $this->re->UpdateTopSongByYear();
            $this->re->UpdateTopSingerByYear();
            $this->re->UpdateTopCategoryByYear();
            $this->re->UpdateTopAlbumByYear();
        }
        else {
            if(date('j', $this->time) == '1') {
                //Ngày đầu tiên trong tháng
                $this->re->UpdateTopSongByMonth();
                $this->re->UpdateTopSingerByMonth();
                $this->re->UpdateTopCategoryByMonth();
                $this->re->UpdateTopAlbumByMonth();
            }
        else {
                if(date('D', $this->time) == 'Mon') {
                    //Ngày đầu tiên trong tuần (Thứ hai)
                    $this->re->UpdateTopSongByWeek();
                    $this->re->UpdateTopSingerByWeek();
                    $this->re->UpdateTopCategoryByWeek();
                    $this->re->UpdateTopAlbumByWeek();
                }
            }
        }
    }
    

    public function Show()
    {   $a='1';
        $this->view('admin', [
            'page' => 'Report-week',
            'albumw' => $this->re->AlbumWeek(),
            'categoryw' => $this->re->CategoryWeek(),
            'songw' => $this->re->SongWeek(),
            'singerw' =>$this->re->SingerWeek(),
            'singupTime'=>$this->re->SingupTime(),
            "oldsingup" =>$this->re->SingupTime1(),
            "postnest" =>$this->re->UserPost(),
            'a' => $a,
        ]);
    }

    public function Week()
    {
        $b='1';
        $this->view('admin', [
            'page' => 'Report-week',
            'albumw' => $this->re->AlbumWeek(),
            'categoryw' => $this->re->CategoryWeek(),
            'songw' => $this->re->SongWeek(),
            'singerw' =>$this->re->SingerWeek(),
            'b' => $b,
        ]);
    }
    public function Month()
    {
        $c='1';
        $this->view('admin', [
            'page' => 'Report-month',
            'albumm' => $this->re->AlbumMonth(),
            'categorym' => $this->re->CategoryMonth(),
            'songm' => $this->re->SongMonth(),
            'singerm' =>$this->re->SingerMonth(),
            'a' => $c,
        ]);
    }
    public function Year()
    {
        $d='1';
        $this->view('admin', [
            'page' => 'Report-year',
            'albumy' => $this->re->AlbumYear(),
            'categoryy' => $this->re->CategoryYear(),
            'songy' => $this->re->SongYear(),
            'singery' =>$this->re->SingerYear(),
            'a' => $d,
        ]);
    }
}
?>