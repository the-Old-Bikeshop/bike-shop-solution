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

    public function setcategories(): void
    {

        if (isset($_POST['submit-new'])) {
            $this->setData();
            $this->categories = new Category();
            $this->categories->createCategories($this->data);
        } elseif (isset($_POST['update'])) {
            $this->categories = new Category();

            $this->update = true;
            $this->category = $this->categories->fetchOne('category', 'categoryID', $_POST['categoryID']);
        } elseif (isset($_POST['submit-update'])) {
            $this->categories = new Category();
            $this->setData();
            $this->categories->updateCategory($this->data,
                $_POST['categoryID']);
        } elseif (isset($_POST['delete'])) {
            $this->categories = new Category();
            $this->categories->deleteRow('category', 'categoryID', $_POST['categoryID']);
        }
    }

    //CREATE TABLE category (
    //    categoryID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    //  `name` VARCHAR(100) NOT NULL,
    //  `description` TEXT,
    //  short_description VARCHAR(255)
    //);

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