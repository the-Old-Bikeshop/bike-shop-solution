<?php


class BrakeSystemController extends ViewController
{
    public $convert;
    private $update;
    private $brake;
    private $val;

    public function __construct()
    {
        $this->convert = new Convert();
        $this->update = false;
        $this->brake = new BrakeType();
    }

    public function setBrake() {
        if(isset($_POST['submit-new'])) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $this->brake = new BrakeType($_POST['name'], $_POST['condition']);
            $this->brake->createBrakeSystem();
        }elseif(isset($_POST['update'])) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $this->update= true;
            $this->val = $this->brake->fetchOne("braking_system", "braking_systemID", $_POST['braking_systemID'] );
        }elseif(isset($_POST['submit-update'])){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $this->brake->updateBrakeSystem($_POST['name'], $_POST['condition'], $_POST['braking_systemID'] );
        }elseif(isset($_POST['delete'])) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $this->brake->deleteRow('braking_system', "braking_systemID" , $_POST['braking_systemID']);
        }
    }

    /**
     * @return BrakeType
     */
    public function getBrake(): BrakeType
    {
        return $this->brake;
    }

    /**
     * @return mixed
     */
    public function getVal()
    {
        return $this->val;
    }

    /**
     * @return false
     */
    public function getUpdate(): bool
    {
        return $this->update;
    }

    /**
     * @return Convert
     */
    public function getConvert(): Convert
    {
        return $this->convert;
    }

    public function braking_system() {
        return $this->brake->fetchAll('braking_system');
    }

    public function getOneCondition($cond) {
        $this->convert->condition($cond);
    }

    public function checkSelect($input, $condition) {

          return  $input !== null && $input == $condition ? 'selected' : "";
    }



}