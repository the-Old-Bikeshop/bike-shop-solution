<?php

class FavoriteProductsController extends ViewController
{

    private $likes;
    private $data;
    private $favs;
    public $message;


    public function __construct()
    {
        $this->likes = new FavoriteProduct();
        $this->favs = $this->getFavoritProducts();
    }

    public function setData(){
        $_POST = filter_input_array(INPUT_POST,
            FILTER_SANITIZE_STRING);

        $this->data = [
            'userID' => trim($_POST['userID']),
            'productID' => trim($_POST['likedProductsID']),
            'like' => trim($_POST['like']),
        ];

    }
    public function likeAction() {
            if ($_POST['like'] == 'like') {
                $this->likes->createFavorite($this->data);
            }else {
                $this->likes->deleteFavorite($this->data);
            }

    }

    public function getFavoritProducts() {
            $result = $this->likes->fetchUserFavorits();
            return $result;
    }


    /**
     * @return mixed
     */
    public function getLikes()
    {
        return $this->likes;
    }

    /**
     * @return array|false|void
     */
    public function getFavs()
    {
        return $this->favs;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }


}