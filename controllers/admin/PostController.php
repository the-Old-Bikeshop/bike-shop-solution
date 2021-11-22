<?php




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