<?php

class ReviewController extends
    ViewController
{

    public $update;
    private $reviews;
    private $review;
    private $data;
    public $message;
    private $status;

    public function __construct()
    {
        $this->update = false;
        $this->reviews = new Review();
        $this->status = new Convert();
    }

    public function setreview(): void
    {

        if (isset($_POST['submit-new'])) {
            $this->setData();
            $this->reviews->createreview($this->data);
        } elseif (isset($_POST['update'])) {
            $this->update = true;
            $this->review = $this->reviews->fetchOne('review', 'reviewID', $_POST['reviewID']);
        } elseif (isset($_POST['submit-update'])) {
            $this->setUpdateData();
            $this->reviews->updatereview($this->data, $_POST['reviewID']);
        } elseif (isset($_POST['delete'])) {
            $this->reviews->deleteRow('review', 'reviewID', $_POST['reviewID']);
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
            'rating' => trim($_POST['rating']) ?? 4,
            'state' => 0,
        ];
        $this->data = $data;
    }

    public function setUpdateData() {
        $_POST = filter_input_array(INPUT_POST,
            FILTER_SANITIZE_STRING);
        $data = [
            'title' => trim($_POST['title']) ?? "",
            'content' => trim($_POST['content']) ?? "",
            'userID' => trim($_POST['userID']) ?? "",
            'rating' => trim($_POST['rating']) ?? 4,
            'state' => trim($_POST['state']) ?? 0
        ];
        $this->data = $data;
    }

    /**
     * @param mixed $message
     */
    public function setMessage(): void
    {
        $this->message = $this->reviews->message;
    }


    public function getReviews()
    {
        return $this->reviews;
    }

    public function fetchAllReviews() {
        return $this->reviews->fetchAll('review');
    }


    /**
     * @return mixed
     */
    public function getOneReview()
    {
        return $this->review;
    }

    /**
     * @return false
     */
    public function getUpdate(): bool
    {
        return $this->update;
    }

    public function getStatuses() {
        return $this->status->getReviewStatuses();
    }

    /**
     * @return Convert
     */
    public function getStatus(): Convert
    {
        return $this->status;
    }

}