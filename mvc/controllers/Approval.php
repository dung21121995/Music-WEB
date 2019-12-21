<?php


class Approval extends Controller
{
    protected $song;
    protected $limit;
    protected $start;
    protected $result;
    protected $total_records;
    protected $current_page;
    protected $total_page;
    protected $data;

    public function __construct()
    {
        ob_start();
        if (empty($_SESSION["email"])) {
            echo "<p style=\"color:red;text-align:center;\">Vui lòng login";
            header("location:".BASE_URL);
            exit();
        } else {
            $name = $_SESSION["name"];
        }
      
        $this->song = $this->model('SongModel');

        $this->result = $this->song->countApp();
        $row = $this->result->fetch_array(MYSQLI_NUM);
        $this->total_records = htmlspecialchars($row[0], ENT_QUOTES);

        $this->current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $this->limit = 5;
        $this->total_page = ceil($this->total_records / $this->limit);
        if ($this->current_page > $this->total_page) {
            $this->current_page = $this->total_page;
        } else if ($this->total_page <= 1) {
            $this->total_page = 1;
        }
        $this->start = ($this->current_page - 1) * $this->limit;
        $this->result = $this->song->LimitApp($this->start, $this->limit);
        $this->data = [
            'limit' => $this->limit,
            'result2' => $this->result,
            'total_records' => $this->total_records,
            'current_page' => $this->current_page,
            'total_page' => $this->total_page,
            'start' => $this->start
        ];
    }

    function Show()
    {
        $this->view('admin', [
            'page'=>'manage-approval',
            'listsong' => $this->song->LimitApp($this->start, $this->limit),
           'page1'=>$this->data
        ]);
    }
    function Page($page)
    {
        $result = $this->song->countApp();
        $row = $result->fetch_array(MYSQLI_NUM);
        $total_records = htmlspecialchars($row[0], ENT_QUOTES);
        $current_page = isset($page) ? $page : 1;
        $limit = 5;
        $total_page = ceil($total_records / $limit);
        if ($current_page > $total_page) {
            $current_page = $total_page;
        } else if ($total_page <= 1) {
            $total_page = 1;
        }
        $start = ($current_page - 1) * $limit;
        $result = $this->song->LimitApp($start, $limit);
        // $result->free_result(); // giải phóng tài nguyên
        $data = [
            'limit' => $limit,
            'result2' => $result,
            'total_records' => $total_records,
            'current_page' => $current_page,
            'total_page' => $total_page,
            'start' => $start
        ];

        $this->view('admin', [
            'page'=>'manage-approval',
            'listsong' => $this->song->LimitApp($start, $limit),
           'page1'=>$data
        ]);
    }


    function DeleteSong($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id_singer' => $id_singer,
                'id' => $id,
                'err' => ''
            ];
            if (isset($_POST['submit'])) {
               
                    if ($this->song->deleteSong($id)) {
                        
                            $data['err'] = "Xóa thành công bài hát ";
                            $this->view('admin', [
                                'page'=>'manage-approval',
                                'listsong' => $this->song->LimitApp($this->start, $this->limit),
                               'page1'=>$this->data,
                                'result' => $data
                            ]);
                       
                    }
                
            } else {
                $this->view('admin', [
                    'page'=>'manage-approval',
                    'listsong' => $this->song->LimitApp($this->start, $this->limit),
                   'page1'=>$this->data,
                    'result' => $data
                ]);
            }
        } else {
            $this->view('admin', [
                'page'=>'manage-approval',
                'listsong' => $this->song->LimitApp($this->start, $this->limit),
               'page1'=>$this->data
            ]);
        }
    }

    function Yes($id_song)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'err' => '',
                'id_song' => $id_song
            ];
            if (isset($_POST['submit'])) {
                if ($this->song->approval($id_song)) {
                    $data['err'] = 'Phê duyệt thành công!';
                    
                    $this->view('admin', [
                        'page'=>'manage-approval',
                        'listsong' => $this->song->LimitApp($this->start, $this->limit),
                       'page1'=>$this->data,
                        'result' => $data
                    ]);
                  } else {
                    $data['err'] = 'Phê duyệt thất bại! Lỗi hệ thống!';
                    $this->view('admin', [
                        'page'=>'manage-approval',
                        'listsong' => $this->song->LimitApp($this->start, $this->limit),
                       'page1'=>$this->data,
                        'result' => $data
                    ]);
                }
            }
        } else {

            $this->view('admin', [
                'page'=>'manage-approval',
                'listsong' => $this->song->LimitApp($this->start, $this->limit),
               'page1'=>$this->data,
            ]);
        }
    }
}