<?php


spl_autoload_register(function ($class_name) {

    // Define an array of directories in the order of their priority to iterate through.
    $dirs = array(
        'models/',
        'controllers/',
        'controllers/admin/',
    );

    // Looping through each directory to load all the class files. It will only require a file once.
    // If it finds the same class in a directory later on, IT WILL IGNORE IT! Because of that require once!
    foreach ($dirs as $dir) {
        if (file_exists($dir . $class_name . '.php')) {
            require_once($dir . $class_name . '.php');
            return;
        }
    }
});

class PostController extends
    ViewController
{

    private $update;
    private $posts;
    private $data;
    private $post;


    public function __construct() {
        $this->update = false;
        $this->posts = new Post();
    }

    public function setPost(): void
    {

        if (isset($_POST['submit-new'])) {
            $this->setData();
            $this->posts->createPost($this->data);
        } elseif (isset($_POST['update'])) {
            $this->update = true;
            $this->post = $this->posts->fetchOne('post', 'postID', $_POST['postID']);
        } elseif (isset($_POST['submit-update'])) {
            $this->setData();
            $this->posts->updatePost($this->data, $_POST['postID']);
        } elseif (isset($_POST['delete'])) {
            $this->posts->deleteRow('post', 'postID', $_POST['postID']);
        }
    }



    public function setData(): void {


        $data = [
            'title' => htmlspecialchars(trim($_POST['title'])) ?? "",
            'content' => htmlspecialchars(trim($_POST['content'])) ?? "",
            'productID' => htmlspecialchars(trim($_POST['productID'])) ?? "",
            'userID' => htmlspecialchars(trim($_POST['userID'])) ?? ""
        ];
        $this->data = $data;
//        print_r($data);
    }

    public function fetchAllPosts() {
        return $this->posts->fetchAll('post');
    }

    public function fetchAllProducts() {
        return $this->posts->fetchAll('product');
    }

    /**
     * @return false
     */
    public function getUpdate(): bool
    {
        return $this->update;
    }

    /**
     * @return Post
     */
    public function getPosts(): Post
    {
        return $this->posts;
    }

    /**
     * @return mixed
     */
    public function getOnePost()
    {
        return $this->post;
    }


}