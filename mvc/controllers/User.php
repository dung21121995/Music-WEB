<?php 
class User extends Controller{
    protected $song;

    public function __construct(){
        $this->song = $this->model("SongModel");
    }

    public function Info($id){
    
     $this->view("HomeView",
     [
         "page" => "profile",
        "dataUser"=> $this->model("UserModel")->getU($id)
    ]);
    
    
    }
    public function song($id){
        $this->view("HomeView",
        [
            "page" => "song",
            "dataUser"=> $this->model("UserModel")->getU($id)
       ]);
    }
    public function uploadPage($id){
    $this->view("HomeView",[
        "page" =>"upload",
        "songUpload"=>$this->song->getSongByIdUser($id)
    ]);
    }
    public function upload(){
        $this->view("HomeView",
        [
            "page" =>"upload-song",
            "category" => $this->song->getCategory()
           
        ]);

    }
    public function uploadSong(){
        
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
                    $this->view('HomeView', [
                        'page'=>'upload-song',
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
 
                             $this->view('HomeView', [
                                'page'=>'upload-song',
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
                                        $this->view('HomeView', [
                                            'page' => 'upload',
                                             "songUpload"=>$this->song->getSongByIdUser($_SESSION['id_user']),
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
                                //      $this->view('HomeView', [
                                //         'page'=>'upload',
                                //          'result' => $data,
 
                                //      ]);
                                //  }
                            }
                        }
                    // if (move_uploaded_file($_FILES["link_song"]["tmp_name"], $target_file)) {
                   
                    // } else {
                    //     $uploadOK = 0;
                    //     $this->view('HomeView', [
                    //        'page'=>'upload',
                    //         'result' => $data
                    //     ]);
                    // }
                }
            }
        } else {
            $this->view('HomeView', [
               'page'=>'upload-song'
            ]);
        }
    }
    function DeleteSongs($id)
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
                        $row = mysqli_fetch_array($this->song->getid($id));
                        unlink("./public/songs/".$row['link_song']);
                        
                            $data['err'] = "Xóa thành công bài hát ";
                            $this->view('HomeView', [
                                'page' => 'upload',
                                'result' => $data,
                                 "songUpload"=>$this->song->getSongByIdUser($_SESSION['id_user']),
                                'page1' => $this->data
                            ]);
                            header("location:".BASE_URL."User/uploadPage/".$_SESSION['id_user']);
                            exit();
                        
                    }
                }
            } else {
                $this->view('HomeView', [
                    'page' => 'upload',
                    'result' => $data,
                     "songUpload"=>$this->song->getSongByIdUser($_SESSION['id_user']),
                    'page1' => $this->data
                ]);
            }
        } else {
            $this->view('HomeView', [
                'page' => 'upload',
                 "songUpload"=>$this->song->getSongByIdUser($_SESSION['id_user']),
                'page1' => $this->data
            ]);
        }
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
                        unlink("./public/songs/");
                        $data['err'] = "Xóa thành công bài hát ";
                        $this->view('HomeView', [
                                'page'=>'upload',
                                "songUpload"=>$this->song->getSongByIdUser($_SESSION['id_user']),
                               'page1'=>$this->data,
                                'result' => $data
                        ]);
                       
                    }
                
            } else {
                $this->view('HomeView', [
                    'page'=>'upload',
                    "songUpload"=>$this->song->getSongByIdUser($_SESSION['id_user']),
                   'page1'=>$this->data,
                    'result' => $data
                ]);
            }
        } else {
            $this->view('HomeView', [
                'page'=>'upload',
                  "songUpload"=>$this->song->getSongByIdUser($_SESSION['id_user']),
               'page1'=>$this->data
            ]);
        }
    }
    
  
}

?>