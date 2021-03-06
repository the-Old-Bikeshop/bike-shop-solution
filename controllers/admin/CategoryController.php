<?php



class CategoryController extends ViewController {

    public $update;
    private $categories;
    private $category;
    private $data;
    public $message;

    public function __construct()
    {
        $this->update = false;
        $this->categories = new Category();
    }

    public function setCategories(): void
    {

        if (isset($_POST['submit-new'])) {
            $this->setData();
            $this->categories->createCategories($this->data);
        } elseif (isset($_POST['update'])) {
            $this->update = true;
            $this->category = $this->categories->fetchOne('category', 'categoryID', $_POST['categoryID']);
        } elseif (isset($_POST['submit-update'])) {
            $this->setData();
            $this->categories->updateCategory($this->data, $_POST['categoryID']);
        } elseif (isset($_POST['delete'])) {
            $this->categories->deleteRow('category', 'categoryID', $_POST['categoryID']);
        }
    }


    /**
     * @param mixed $data
     */
    public function setData(): void {

        $_POST = filter_input_array(INPUT_POST,
            FILTER_SANITIZE_STRING);

        $data = [
            'name' => trim($_POST['name']) ?? "",
            'description' => trim($_POST['description']) ?? "",
            'short_description' => trim($_POST['short_description']) ?? "",
        ];
        $this->data = $data;
    }

    /**
     * @param mixed $message
     */
    public function setMessage(): void
    {
        $this->message = $this->categories->message;
    }


    public function getCategories()
    {
        return $this->categories;
    }

    public function fetchAllCategories() {
        return $this->categories->fetchAll('category');
    }
    /**
     * @return mixed
     */
    public function getOneCategory()
    {
        return $this->category;
    }

    /**
     * @return false
     */
    public function getUpdate(): bool
    {
        return $this->update;
    }
}

