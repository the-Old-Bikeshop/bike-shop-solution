<?php

class BrandController extends
    ViewController
{

    private $update;
    private $brands;
    private $data;
    private $brand;
    private $imageController;
    private $postImage;
    private $image;


    public function __construct() {
        $this->update = false;
        $this->brands = new Brand();
        $this->imageController = new ImageController();
        $this->postImage = new PostHasImages();
    }

    public function setBrand(): void
    {

        if (isset($_POST['submit-new'])) {
            $this->setData();
            $this->brands->createBrand($this->data);
        } elseif (isset($_POST['update'])) {
            $this->update = true;
            $this->brand = $this->brands->fetchOne('brand', 'brandID', $_POST['brandID']);
        } elseif(isset($_POST['addImage'])){
            $this->brand = $this->brands->fetchOne('brand', 'brandID', $_POST['brandID']);
        }
        elseif (isset($_POST['submit-update'])) {
            $this->setData();
            $this->brands->updateBrand($this->data, $_POST['brandID']);
        } elseif (isset($_POST['delete'])) {
            $this->brands->deleteRow('brand', 'brandID', $_POST['brandID']);
        }elseif (isset($_POST['addNewImage'])) {
            $this->image = new Image();
            $this->imageController->setData();
            $this->imageID = $this->image->createImage($this->imageController->getData());
            $this->brands->updateImageId($this->image, $_POST['brandID'] );
        }
    }



    public function setData(): void {

        $_POST = filter_input_array(INPUT_POST,
            FILTER_SANITIZE_STRING);


        $data = [
            'name' => trim($_POST['name']) ?? "",
            'description' => trim($_POST['description']) ?? "",
            'short_description' => trim($_POST['short_description']) ?? "",
            'website' => trim($_POST['website']) ?? ""
        ];
        $this->data = $data;
        //        print_r($data);
    }

    public function fetchAllBrands() {
        return $this->brands->fetchAll('brand_view');
    }




    public function getOneImage() {
        if(isset($_POST['brandID'])) {
            if(isset($this->brand)) {
                return $this->brands->fetchOne('image', 'imageID', $this->brand['imageID']);
            } else {
                return false;
            }
        }
        return false;
    }



    /**
     * @return false
     */
    public function getUpdate(): bool
    {
        return $this->update;
    }

    /**
     * @return Brand
     */
    public function getBrands(): Brand
    {
        return $this->brands;
    }

    /**
     * @return mixed
     */
    public function getOneBrand()
    {
        return $this->brand;
    }


}