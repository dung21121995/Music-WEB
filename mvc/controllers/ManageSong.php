<?php


class ManageSong  extends Controller
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
        
        $this->song = $this->model('SongModel');

        $this->result = $this->song->countSong();
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
        $this->result = $this->song->Limit($this->start, $this->limit);
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
            'page' => 'manager-song',
            'listManageSong' => $this->song->Limit($this->start, $this->limit),
            'page1' => $this->data
        ]);
    }
    function Page($page)
    {
        $result = $this->song->countSong();
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
        $result = $this->song->Limit($start, $limit);
        $_SESSION["recors"] =$total_records;
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
            'page' => 'manager-song',
            'listManageSong' => $this->song->Limit($start, $limit),
            'page1' => $data
        ]);
    }


    function editSong($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //file song
            //file imange song
            $target_dir1 = './public/images/';
            $target_file1 = $target_dir1 . basename($_FILES["song_part_img"]["name"]);
            $uploadOK1 = 1;

            $imangeFileTyle1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
            $data = [
                'song_name' => trim($_POST['song_name']),
                'singer_name' => trim($_POST['singer_name']),
                'category' => trim($_POST['category']),
                'song_part_img' => $target_file1,
                'lyric_song' => trim($_POST['lyric_song']),
                'id_song' => $id,
                'id_singer' => $id_singer,
                'link_err' => '',
                'song_name_err' => '',
                'singer_name_err' => '',
                'category-err' => '',
                'img_err' => '',
                'err' => '',
            ];

            if (isset($_POST["submit"])) {
                //echo $target_file;
                if (empty($data['song_name'])) {
                    $data['song_name_err'] = 'Vui lòng nhập tên bài hát';
                }
                if (empty($data['singer_name'])) {
                    $data['singer_name_err'] = 'Vui lòng nhập tên ca sĩ';
                }
                // if (empty($data['category'])) {
                //     $data['category_err'] = 'Vui lòng chọn thể loại';
                // }
                // if (empty($data['song_part_img'])) {
                //     $data['img_err'] = 'chưa chọn ảnh';
                // }
                // $check1 = ($_FILES["song_part_img"]["tmp_name"]);
                // if ($check1 !== FALSE) {
                //     $uploadOK1 = 1;
                //     if (file_exists($target_file1)) {
                //         $data['img_err'] = "file already exists .";
                //         $uploadOK1 = 0;
                //     }
                // }
                // if ($imangeFileTyle1 != "jpg" && $imangeFileTyle1 != "png" && $imangeFileTyle1 != "jpeg" && $imangeFileTyle1 != "gif") {
                //     $data['img_err'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                // }
                // if ($uploadOK1 == 0) {
                //     $data['img_err'] = "sorry, your file was not uploaded";
                    // echo "File is not an song .";

                    $this->view('admin', [
                        'page' => 'edit-song',
                        'result' => $data,
                        'result1' => $this->song->getid($id)
                    ]);
                } else {
                    if (empty($data['link_err']) && empty($data['song_name_err'])
                        && empty($data['singer_name_err']) && empty($data['category_err']) && empty($data['img_err'])) {

                        // if (move_uploaded_file($_FILES['song_part_img']["tmp_name"], $data['song_part_img'])) {
                            if ($this->song->updateSong(
                                $data['song_name'],
                                $data['lyric_song'],
                                $data['song_part_img'],
                                $data['id_song']
                            ) === true) {

                                if ($this->song->updateSinger($data['singer_name'], $data['id_singer']) === true) {
                                    $data['err']= 'Sửa thành công bài hát: ';
                                    $this->view('admin', [
                                        'page' => 'manager-song',
                                        'listsong' => $this->song->Limit($this->start, $this->limit),
                                        'page1' => $this->data,
                                        'result' => $data,
                                    ]);
                                } else {
                                    echo 'thất bại ca sĩ';
                                    $this->view('admin', [
                                        'page' => 'edit-song',
                                        'result' => $data,
                                        'result1' => $this->song->getid($id)
                                    ]);
                                }
                            } else {
                                echo 'thất bại song';
                                $this->view('admin', [
                                    'page' => 'edit-song',
                                    'result' => $data,
                                    'result1' => $this->song->getid($id)
                                ]);
                            }
                        } else {
                            $uploadOK = 0;
                            $this->view('admin', [
                                'page' => 'edit-song',
                                'result' => $data,
                                'result1' => $this->song->getid($id)
                            ]);
                        }
                    // } else {
                    //     $uploadOK = 0;
                    //     $this->view('admin', [
                    //         'page' => 'edit-song',
                    //         'result' => $data,
                    //         'result1' => $this->song->getid($id)
                    //     ]);
                    // }
                }
            }
        // }

        $this->view('admin', [
            'page' => 'edit-song',
            'result1' => $this->song->getid($id)
        ]);
    }

    function addSong()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //file song
            $target_dir = './public/songs/';
            $target_file = $target_dir . basename($_FILES["link_song"]["name"]);
            $uploadOK = 1;

            $songFileTyle = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            //file imange song
            $target_dir1 = './public/images/';
            $target_file1 = $target_dir1 . basename($_FILES["song_part_img"]["name"]);
            $uploadOK1 = 1;

            $imangeFileTyle1 = strtolower(pathinfo($target_file1, PATHINFO_EXTENSION));
            $data = [
                'link_song' => $_FILES["link_song"]["name"],
                'song_name' => trim($_POST['song_name']),
                'singer_name' => trim($_POST['singer_name']),
                'category' => trim($_POST['category']),
                'song_part_img' => $_FILES["song_part_img"]["name"],
                'lyric_song' => trim($_POST['lyric_song']),
                'id_song' => '',
                'id_singer' => '',
                'link_err' => '',
                'song_name_err' => '',
                'singer_name_err' => '',
                'category-err' => '',
                'img_err' => ''
            ];

            if (isset($_POST["submit"])) {
                //echo $target_file;
                $check = ($_FILES["link_song"]["tmp_name"]);
                if ($check !== FALSE) {
                    $uploadOK = 1;
                    if (file_exists($target_file)) {
                        $data['link_err'] = "file already exists.";
                        $uploadOK = 0;
                    }
                }
                if (empty($_FILES["link_song"]["name"])) {
                    $data['link_err'] = "vui lòng chọn bài hát";
                }
                if (empty($data['song_name'])) {
                    $data['song_name_err'] = 'Vui lòng nhập tên bài hát';
                }
                if (empty($data['singer_name'])) {
                    $data['singer_name_err'] = 'Vui lòng nhập tên ca sĩ';
                }
                if (empty($data['category'])) {
                    $data['category_err'] = 'Vui lòng chọn thể loại';
                }
                if (empty($data['song_part_img'])) {
                    $data['img_err'] = 'chưa chọn ảnh';
                }
                if (
                    $songFileTyle != "mp3" && $songFileTyle != "wma" && $songFileTyle != "mp2"
                    && $songFileTyle != "asf" && $songFileTyle != "wav" && $songFileTyle != "wmv" && $songFileTyle != "mp4"
                    && $songFileTyle != "flv" && $songFileTyle != "mpg" && $songFileTyle != "mpe" && $songFileTyle != "avi"
                    && $songFileTyle != "3gp" && $songFileTyle != "dat"  && $songFileTyle != "flac"
                ) {
                    $data['link_err'] = "Không phải nhạc";
                }
                // echo $_FILES["link_song"]["size"];
                // if ($_FILES["link_song"]["size"] < 125829120) {
                //     $data['link_err'] = "Sorry, your file is too large.";
                // }
                if ($uploadOK == 0) {
                    $data['link_err'] = "Sorry, your file was not uploaded";
                    $this->view('admin', [
                        'page'=>'add-song',
                        'result' => $data
                    ]);
                } 
                else {
                         //echo $target_file1;
                         $check1 = ($_FILES["song_part_img"]["tmp_name"]);
                         if ($check1 !== FALSE) {
                             $uploadOK1 = 1;
                             if (file_exists($target_file1)) {
                                 $data['img_err'] = "file already exists .";
                                 $uploadOK1 = 0;
                             }
                         }
                         if ($imangeFileTyle1 != "jpg" && $imangeFileTyle1 != "png" && $imangeFileTyle1 != "jpeg" && $imangeFileTyle1 != "gif") {
                             $data['img_err'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                         }
                         if ($uploadOK1 == 0) {
                             $data['img_err'] = "sorry, your file was not uploaded";
                             // echo "File is not an song .";
 
                             $this->view('admin', [
                                'page'=>'add-song',
                                "category" => $this->song->getCategory(),
                                 'result' => $data
                             ]);
                         } else {
                            if (empty($data['link_err']) && empty($data['song_name_err']) && empty($data['singer_name_err']) && empty($data['category_err']) && empty($data['img_err'])) {
                                $id_song= $this->song->addSongGetId(
                                    $data['song_name'],
                                    $data['link_song'],
                                    $data['lyric_song'],
                                    $data['song_part_img'],
                                    $_SESSION["id_user"]
                                );
                                if ($id_song != false) {
                                    $id_singer = $this->song->addSingerbySongGetId($data['singer_name']);
                                    // echo $id_singer .  '<br>';
                                    $row = mysqli_fetch_array($this->song->getCategoryByName($data['category']));
                                    $id_category = $row['id_category'];
                                    echo $id_category;
                                    if ($this->song->addDetailSong($id_song, $id_singer, $id_category)) {
                                        $data['err']= 'Thêm thành công bài hát: ';
                                        $this->view('admin', [
                                            'page' => 'add-song',
                                             
                                            "category" => $this->song->getCategory(),
                                            'page1' => $this->data,
                                            'result' => $data,
                                        ]);
                                        move_uploaded_file($_FILES["link_song"]["tmp_name"], $target_file);
                                        move_uploaded_file($_FILES['song_part_img']["tmp_name"], $target_file1);
                                    } else {
                                        echo 'thất bại';
                                    }
                                }
                                // echo $id_song . '<br>';
                              
 
                                //  if (move_uploaded_file($_FILES['song_part_img']["tmp_name"], $data['song_part_img'])) {
                                    
                                //  } else {
                                //      $uploadOK = 0;
                                //      $this->view('admin', [
                                //         'page'=>'upload',
                                //          'result' => $data,
 
                                //      ]);
                                //  }
                            }
                        }
                    // if (move_uploaded_file($_FILES["link_song"]["tmp_name"], $target_file)) {
                   
                    // } else {
                    //     $uploadOK = 0;
                    //     $this->view('admin', [
                    //        'page'=>'upload',
                    //         'result' => $data
                    //     ]);
                    // }
                }
            }
        } else {
            $this->view('admin', [
               'page'=>'add-song',
               "category" => $this->song->getCategory()
            ]);
        }
    }
    function DeleteSong($id, $id_singer)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id_singer' => $id_singer,
                'id' => $id,
                'err' => ''
            ];
            if (isset($_POST['submit'])) {
                if ($this->song->deleteDetail($id)) {
                    if ($this->song->deleteSong($id)) {
                        if ($this->song->deleteSinger($id_singer)) {
                            $data['err'] = "Xóa thành công bài hát ";
                            $this->view('admin', [
                                'admin' => 'admin-page/manager-song',
                                'result' => $data,
                                'listsong' => $this->song->Limit($this->start, $this->limit),
                                'page' => $this->data
                            ]);
                        }
                    }
                }
            } else {
                $this->view('admin', [
                    'admin' => 'admin-page/manager-song',
                    'result' => $data,
                    'listsong' => $this->song->Limit($this->start, $this->limit),
                    'page' => $this->data
                ]);
            }
        } else {
            $this->view('admin', [
                'admin' => 'admin-page/manager-song',
                'listsong' => $this->song->Limit($this->start, $this->limit),
                'page' => $this->data
            ]);
        }
    }
    public function Search($text)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'text' => trim($_POST['text']),
                'text_err' => '',

            ];
            if (isset($_POST['submit'])) {
                print_r($data);
                if (empty($data['text'])) {
                    $data['text_err'] = 'Bạn chưa nhập từ khóa!';
                    $this->view('admin', [
                        'admin' => 'admin-page/manager-song',
                        'search' => $data,
                        'listsong' => $this->song->Limit($this->start, $this->limit),
                        'page' => $this->data
                    ]);
                } else {
                    $text = $data['text'];
                    if ($this->song->TimKiem($text)) {

                        $this->view('admin', [
                            'admin' => 'admin-page/manager-song',
                            'search' => $data,
                            'listsong' => $this->song->Limit($this->start, $this->limit),
                            'page' => $this->data
                        ]);
                    } else { }
                }
            }
        } else {
            $this->view('admin', [
                'admin' => 'admin-page/manager-song',
                'result' => $data
            ]);
        }
    }
}