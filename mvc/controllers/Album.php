<?php
class Album extends Controller
{
    protected $cate;

    public function __construct()
    {
        ob_start();
        if (empty($_SESSION["email"])) {
            echo "<p style=\"color:red;text-align:center;\">Vui lòng login";
            header("location:".BASE_URL);
            exit();
        } 
        
        $this->cate = $this->model('AlbumModel');

        $this->result = $this->cate->Countalbum();
        // $row = mysqli_num_rows($this->result);
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
        $this->result = $this->cate->Limitalbum($this->start, $this->limit);
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
            'page'=>'manager-album',
            'album2' => $this->cate->Limitalbum($this->start, $this->limit),
            'page1'=>$this->data,
        ]);
    }

    function Page($page)
    {
        $result = $this->cate->Countalbum();
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
        $result = $this->cate->Limitalbum($start, $limit);
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
            'page'=>'manager-album',
            'album2' => $this->cate->Limitalbum($start, $limit),
            'page1' => $data
        ]);
    }

    function Add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'album' => trim($_POST['album']),
                'album_err' => '',
                'err' => '',
            ];
            if (isset($_POST['submit'])) {

                if (empty($data['album'])) {
                    $data['err'] = 'Bạn chưa nhập album muốn thêm!';
                    $this->view('admin', [
                        'page'=>'manager-album',
                        'album1' => $data,
                        'album2' => $this->cate->Limitalbum($this->start, $this->limit),
                        'page1'=>$this->data,
                    ]);
                }

                if (empty($data['err'])) {
                    date_default_timezone_get('Asia/Ho Chi Minh');
                    $time = date('Y-m-d');
                    if ($this->cate->add($data['album'], $time)) {
                        $data['err'] = 'Thêm thành công album: ';

                        $this->data['total_records'] = $this->data['total_records'] + 1;
                        $this->view('admin', [
                            'page'=>'manager-album',
                            'album1' => $data,
                            'album2' => $this->cate->Limitalbum($this->start, $this->limit),
                            'page1'=>$this->data
                        ]);
                    } else {
                        $data['err'] = 'Thêm thất bại album: ';
                        $this->view('admin', [
                            'page'=>'manager-album',
                            'album1' => $data,
                            'album2' => $this->cate->Limitalbum($this->start, $this->limit),
                            'page1'=>$this->data,
                        ]);
                    }
                }
            }
        } else {
            $data['err'] = 'Lỗi Sever method';
            $this->view('admin', [
                'page'=>'manager-album',
                'album2' => $this->cate->Limitalbum($this->start, $this->limit),
                'page1'=>$this->data
            ]);
        }
    }
    function Delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $id,
                'err' => '',
                'album' => trim($_POST['album']),
            ];
            if ($this->cate->delete($data['id'])) {
                $data['err'] = 'Xóa thành công! ';
                $this->data['total_records'] = $this->data['total_records'] - 1;

                $this->view('admin', [
                    'page'=>'manager-album',
                    'album1' => $data,
                    'album2' => $this->cate->Limitalbum($this->start, $this->limit),
                    'page1'=>$this->data
                ]);
            } else {
                $data['err'] = 'Xóa thất bại! ';
                $this->view('admin', [
                    'page'=>'manager-album',
                    'album1' => $data,
                    'album2' => $this->cate->Limitalbum($this->start, $this->limit),
                    'page1'=>$this->data,
                ]);
            }
        } else {
            $data['err'] = 'Lỗi Sever method';
            $this->view('admin', [
                'page'=>'manager-album',
                'album2' => $this->cate->Limitalbum($this->start, $this->limit),
                'page1'=>$this->data
            ]);
        }
    }
    function Edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'album' => trim($_POST['album']),
                'album1' => trim($_POST['album1']),
                'err' => '',
                'id' => $id,
            ];
            if (isset($_POST['submit'])) {

                if (empty($data['album1'])) {
                    $data['err'] = 'Bạn chưa nhập album muốn sửa!';
                    $this->view('admin', [
                        'page'=>'manager-album',
                        'album1' => $data,
                        'album2' => $this->cate->Limitalbum($this->start, $this->limit),
                        'page1'=>$this->data,
                    ]);
                }

                if (empty($data['err'])) {
                    if ($this->cate->edit($data['album1'], $data['id'])) {
                        $data['err'] = 'Sửa thành công album: ';
                        $this->view('admin', [
                            'page'=>'manager-album',
                            'album1' => $data,
                            'album2' => $this->cate->Limitalbum($this->start, $this->limit),
                            'page1'=>$this->data
                        ]);
                    } else {
                        $data['err'] = 'Sửa thất bại album: ';
                        $this->view('admin', [
                            'page'=>'manager-album',
                            'album1' => $data,
                            'album2' => $this->cate->Limitalbum($this->start, $this->limit),
                            'page1'=>$this->data,
                        ]);
                    }
                }
            }
        } else {
            $data['err'] = 'Lỗi Sever method';
            $this->view('admin', [
                'page'=>'manager-album',
                'album2' => $this->cate->Limitalbum($this->start, $this->limit),
                'page1'=>$this->data
            ]);
        }
    }
}
?>