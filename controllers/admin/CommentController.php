<?php



class CommentController extends ViewController
{

    public $update;
    private $comments;
    private $comment;
    private $data;
    public $message;

    public function __construct()
    {
        $this->update = false;
        $this->comments = new Comment();
    }

    public function setComment(): void
    {

        if (isset($_POST['submit-new'])) {
            $this->setData();
            $this->comments->createComment($this->data);
        } elseif (isset($_POST['update'])) {
            $this->update = true;
            $this->comment = $this->comments->fetchOne('comment', 'commentID', $_POST['commentID']);
        } elseif (isset($_POST['submit-update'])) {
            $this->setData();
            $this->comments->updateComment($this->data, $_POST['commentID']);
        } elseif (isset($_POST['delete'])) {
            $this->comments->deleteRow('comment', 'commentID', $_POST['commentID']);
        }
    }


    /**
     * @param mixed $data
     */
    public function setData(): void {

        $_POST = filter_input_array(INPUT_POST,
            FILTER_SANITIZE_STRING);

        $data = [
            'title' => trim($_POST['title']) ?? "",
            'content' => trim($_POST['content']) ?? "",
            'userID' => trim($_POST['userID']) ?? "",
            'postID' => trim($_POST['postID']) ?? ""
        ];
        $this->data = $data;
    }

    /**
     * @param mixed $message
     */
    public function setMessage(): void
    {
        $this->message = $this->comments->message;
    }


    public function getComments()
    {
        return $this->comments;
    }

    public function fetchAllComments() {
        return $this->comments->fetchAll('comment');
    }

    public function fetchAllPosts() {
        return $this->comments->fetchAll('post');
    }
    /**
     * @return mixed
     */
    public function getOneComment()
    {
        return $this->comment;
    }

    /**
     * @return false
     */
    public function getUpdate(): bool
    {
        return $this->update;
    }

}