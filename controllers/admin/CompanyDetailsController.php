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


class CompanyDetailsController extends ViewController {

    public $update;
    private $companyDetails;
    private $details;
    private $data;
    public $message;

    public function __construct() {
        $this->update = false;
        $this->companyDetails = new CompanyDetails();
    }

    public function setCompanyDetails(): void {

        if(isset($_POST['submit-new'])) {
            $this->setData();
            $this->companyDetails = new CompanyDetails();
            $this->companyDetails->createCompanyDetails($this->data);
        }elseif(isset($_POST['update'])) {
            $this->companyDetails = new CompanyDetails();
            $this->update= true;
            $this->details = $this->companyDetails->fetchOne( 'company_details', 'company_detailsID',  $_POST['company_detailsID']);
        }elseif(isset($_POST['submit-update'])){
            $this->companyDetails = new CompanyDetails();
            $this->setData();
            $this->companyDetails->updateCompanyDetails($this->data, $_POST['company_detailsID'] );
        }elseif(isset($_POST['delete'])) {
            $this->companyDetails = new CompanyDetails();
            $this->companyDetails->deleteRow('company_details', 'company_detailsID',  $_POST['company_detailsID']);
        }
    }

    /**
     * @param mixed $data
     */
    public function setData(): void
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'company_description' => trim($_POST['company_description']) ?? "",
            'opening_hours' => trim($_POST['opening_hours'])?? "",
            'mission' => trim($_POST['mission'])?? "",
            'email' => trim($_POST['email'])?? "",
            'vision' => trim($_POST['vision'])?? "",
            'statement' => trim($_POST['statement'])?? "",
            'phone' => trim($_POST['phone'])?? "",
            'address' => trim($_POST['address'])?? "",
            'instagram' => trim($_POST['instagram'])?? ""
        ];
        $this->data = $data;
    }

    /**
     * @param mixed $message
     */
    public function setMessage(): void {
        $this->message = $this->companyDetails->message;
    }

    /**
     * @return CompanyDetails()
     */
    public function getCompanyDetails() {
        return $this->companyDetails;
    }

    /**
     * @return mixed
     */
    public function getOneDetails() {
        return $this->details;
    }

    /**
     * @return false
     */
    public function getUpdate(): bool {
        return $this->update;
    }

    public function getAllCompanyDetails() {
        return $this->companyDetails->fetchAll('company_details');
    }
}