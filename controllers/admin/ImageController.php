<?php
spl_autoload_register(function($class_name) {

    // Define an array of directories in the order of their priority to iterate through.
    $dirs = array(
        'models/',
        'controllers/',
        'controllers/admin/',
    );

    // Looping through each directory to load all the class files. It will only require a file once.
    // If it finds the same class in a directory later on, IT WILL IGNORE IT! Because of that require once!
    foreach( $dirs as $dir ) {
        if (file_exists($dir . $class_name .'.php')) {
            require_once($dir . $class_name.'.php');
            return;
        }
    }
});

class ImageController extends ViewController {

    private CONST MAXSIZE = 3000;
    public $update;
    private $image;
    private $img;
    private $image_type;
    private $image_file;
    private $file;
    private $data;
    private $iName;

    public function __construct()
    {
        $this->update = false;
        $this->image = new Image();
    }

    public function setData() {
        if(isset($_POST['submit-new'])||isset($_POST['submit-update'])||isset($_POST['addNewImage'])) {
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

//            var_dump($_POST);
//            var_dump($_FILES);
//                echo  $_POST["tmp_name"];


            if(!($_FILES['image']['tmp_name']) == "") {
//                var_dump($_FILES);
                $imageName = $_FILES['image']['name'];
                $this->file = $_FILES['image']['tmp_name'];
                $imageType = getimagesize($this->file);
                if(($imageType[2] == 2) || ($imageType[2] == 1 ) || ($imageType[2] == 3 )) {
                    $size = filesize($this->file);
                    if ($size < self::MAXSIZE * 1024) {
                        $prefix = uniqid();
                        $this->iName = $prefix . "_" . $imageName;
                        $newName = $_SERVER['DOCUMENT_ROOT'] . '/bike-shop-solution/public/img/' . $this->iName;
                        $this->save($newName);
                        $this->data = [
                            'name' => trim($_POST['name']) ?? "",
                            'alt' => trim($_POST['alt']) ?? "",
                            'URL' => $this->iName
                        ];
//                        var_dump($this->data);
                    }
                }
            }else{

//                var_dump($_POST);
                $this->data = [
                    'name' => trim($_POST['name']) ?? "",
                    'alt' => trim($_POST['alt']) ?? "",
                    'URL' => $_POST['URL'],
                    'imageID'=>$_POST['imageID']
                ];
            }
        }
    }

    public function setImage(): void {

        if (isset($_POST['submit-new'])) {
            $this->setData();
            $this->image = new Image();
            $this->image->createImage($this->data);
        } elseif (isset($_POST['update'])) {
            $this->image = new Image();
            $this->update = true;
            $this->img = $this->image->fetchOne('image','imageID' ,$_POST['imageID']);
        } elseif (isset($_POST['submit-update'])) {
            $this->setData();
            $this->image = new Image();
            $this->image->updateImage($this->data);

        } elseif (isset($_POST['delete'])) {
            $this->image = new Image();
            $this->image->deleteRow('image','imageID' ,$_POST['imageID']);
        }
    }

    public function load($fileName) {

        $image_info = getimagesize($fileName);
        $this->image_type = $image_info[2];

        if($this->image_type == IMAGETYPE_JPEG) {
            $this->image_file = imagecreatefromjpeg($fileName);
        }elseif($this->image_type = IMAGETYPE_GIF) {
            $this->image_file = imagecreatefromgif($fileName);
        }elseif ($this->image_type = IMAGETYPE_PNG) {
            $this->image_file = imagecreatefrompng($fileName);
        }
    }

    public function save($filename, $image_type = IMAGETYPE_JPEG, $compression = 100) {

        $this->load($this->file);
        if ($image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image_file, $filename, $compression);
        }elseif($image_type == IMAGETYPE_GIF) {
            imagegif($this->image_file, $filename);
        }elseif ($image_type == IMAGETYPE_PNG) {
            imagepng($this->image_type, $filename);
        }
    }

    public function deleteImageFromFile($file) {
        unlink($file);
    }

    /**
     * @return Image
     */
    public function getImage(): Image {
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function getImg() {
        return $this->img;
    }

    /**
     * @return false
     */
    public function getUpdate(): bool{
        return $this->update;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
}


