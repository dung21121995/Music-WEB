<?php
class Account extends Controller
{
    protected $acc;
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
        if (!isset($_SESSION["email"])) {
            echo "<p style=\"color:red;text-align:center;\">Vui lòng login";
            header("location:".BASE_URL);
            exit();
        } else {
            $name = $_SESSION["name"];
        }
       
        $this->acc = $this->model('AccModel');

        $this->result = $this->acc->countAcc();
        // $row = mysqli_num_rows($this->result);
        $row = $this->result->fetch_array(MYSQLI_NUM);
        $this->total_records = htmlspecialchars($row[0], ENT_QUOTES);

        $this->current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $this->limit = 2;
        $this->total_page = ceil($this->total_records / $this->limit);
        if ($this->current_page > $this->total_page) {
            $this->current_page = $this->total_page;
        } else if ($this->total_page <= 1) {
            $this->total_page = 1;
        }
        $this->start = ($this->current_page - 1) * $this->limit;
        $this->result = $this->acc->LimitAcc($this->start, $this->limit);
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
           'page'=>'manager-account',
            'acc' => $this->acc->LimitAcc($this->start, $this->limit),
            'page1' => $this->data
        ]);
    }
    function Page($page)
    {
        $result = $this->acc->countAcc();
        $row = $result->fetch_array(MYSQLI_NUM);
        $total_records = htmlspecialchars($row[0], ENT_QUOTES);
        $current_page = isset($page) ? $page : 1;
        $limit = 2;
        $total_page = ceil($total_records / $limit);
        if ($current_page > $total_page) {
            $current_page = $total_page;
        } else if ($total_page <= 1) {
            $total_page = 1;
        }
        $start = ($current_page - 1) * $limit;
        $result = $this->acc->LimitAcc($start, $limit);
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
           'page'=>'manager-account',
            'acc' => $this->acc->LimitAcc($start, $limit),
            'page1' => $data
        ]);
    }
    function Add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'user_name' => trim($_POST['user_name']),
                'user_name_err' => '',
                'pass' => trim($_POST['pass']),
                'pass_err' => '',
                'pass1' => trim($_POST['pass1']),
                'pass1_err' => '',
                'err' => ''
            ];
            if (isset($_POST['submit'])) {
                if (empty($data['user_name'])) {
                    $data['user_name_err'] = 'Bạn chưa nhập tên tài khoản!';
                }
                if (empty($data['pass'])) {
                    $data['pass_err'] = 'Bạn chưa nhập mật khẩu!';
                }
                if (empty($data['pass1'])) {
                    $data['pass1_err']  = 'Bạn chưa nhập mật khẩu!';
                }
                if (strlen($data['user_name']) != 0 && strlen($data['user_name']) < 6) {
                    $data['user_name_err']  = 'Tên đăng nhập ít nhất 6 kí tự!';
                }
                if (strlen($data['pass']) != 0 && strlen($data['pass']) < 8) {
                    $data['pass_err']  = 'Mật khẩu ít nhất 8 kí tự!';
                }
                if ($data['pass'] !== $data['pass1']) {
                    $data['pass1_err']  = 'Mật khẩu không giống nhau!';
                }
                if ($this->acc->getAccByUserName($data['user_name']) != 0) {
                    $data['user_name_err'] = "Tài khoản đã tồn tại";
                }
                
                if (empty($data['user_name_err']) && empty($data['pass_err']) && empty($data['pass1_err'])) {
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $time=date('Y-m-d H:i:s') ;
                    $pass_hash = password_hash($data['pass'], PASSWORD_DEFAULT);
                    if ($this->acc->addAcc($data['user_name'], $pass_hash, $time)) {
                        header('Location:'.BASE_URL.'Account/Show');
                    } else {
                        $data['err'] = 'Thêm thất bại';
                        $this->view('admin', [
                            'page' => 'admin-page/Add_account',
                            'acc' => $data,
                            
                        ]);
                    }
                } else {$data['err'] = 'Thêm thất bại';
                    $this->view('admin', [
                        'admin' => 'admin-page/Add_account',
                        'acc' => $data
                    ]);
                }
            } else {$data['err'] = 'Thêm thất bại';
                $this->view('admin', [
                    'admin' => 'admin-page/Add_account',
                    'acc' => $data
                ]);
            }
        } else {$data['err'] = 'Thêm thất bại';
            $this->view('admin', [
                'admin' => 'admin-page/Add_account'
            ]);
        }
    }
    function LockAcc($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'text' => trim($_POST['text']),
                'err' => '',
                'id' => $id
            ];
            if (isset($_POST['submit'])) {
                if (empty($data['text'])) {
                    $data['err'] = 'Bạn chưa nhập lí do khóa';
                }
                if (empty($data['err'])) {
                    if ($this->acc->lockAcc($id, $data['text'])) {
                        $data['err'] ="Khóa thành công tài khoản: ";
                        $this->view('admin', [
                           'page'=>'manager-account',
                            'acc' => $this->acc->LimitAcc($this->start, $this->limit),
                            'page1' => $this->data,
                            'lock' => $data
                        ]);
                    }
                 
                } else {
                    
                    $this->view('admin', [
                       'page'=>'manager-account',
                        'acc' => $this->acc->LimitAcc($this->start, $this->limit),
                        'page1' => $this->data,
                        'lock' => $data
                    ]);
                }
            } else {
                $this->view('admin', [
                   'page1'=>'manager-account',
                    'acc' => $this->acc->LimitAcc($this->start, $this->limit),
                    'page' => $this->data,
                    'lock' => $data
                ]);
            }
        } else {
            $this->view('admin', [
               'page1'=>'manager-account',
                'acc' => $this->acc->LimitAcc($this->start, $this->limit),
                'page' => $this->data,
            ]);
        }
    }
    function OpenAcc($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'time' => trim($_POST['time']),
                'id' => $id,
                'err' => ''
            ];
            if (isset($_POST['submit'])) {

                if ($this->acc->openAcc($id)) {
                    $data['err'] ="Mở thành công tài khoản: ";
                    $this->view('admin', [
                       'page'=>'manager-account',
                        'acc' => $this->acc->LimitAcc($this->start, $this->limit),
                        'page1' => $this->data,
                        'lock' => $data
                    ]);
                }
            } else {
                $this->view('admin', [
                   'page'=>'manager-account',
                    'acc' => $this->acc->LimitAcc($this->start, $this->limit),
                    'page1' => $this->data,
                    'lock' => $data
                ]);
            }
        } else {
            $this->view('admin', [
               'page'=>'manager-account',
                'acc' => $this->acc->getAcc()
            ]);
        }
    }
    function DeleteAcc($id){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $id,
                'err' => ''
            ];
            if (isset($_POST['submit'])) {

                if ($this->acc->deleteAcc($id)) {
                    $data['err'] ="Xóa thành công tài khoản: ";
                    $this->view('admin', [
                       'page'=>'manager-account',
                        'acc' => $this->acc->LimitAcc($this->start, $this->limit),
                        'page1' => $this->data,
                        'lock' => $data
                    ]);
                }
            } else {
                $this->view('admin', [
                   'page'=>'manager-account',
                    'acc' => $this->acc->LimitAcc($this->start, $this->limit),
                    'page1' => $this->data,
                    'lock' => $data
                ]);
            }
        } else {
            $this->view('admin', [
               'page'=>'manager-account',
                'acc' => $this->acc->LimitAcc($this->start, $this->limit),
                'page1' => $this->data,
            ]);
        }
    }

    
}