<?php

class Convert
{

    private $conditionValues = array();
    private $yesNo = array();


    public function __construct()
    {
        $this->conditionValues = [1,2,3,4,5];
        $this->yesNo = [0,1];
    }



    public function condition($val) {
        switch($val) {
            case 1:
                echo "New";
                break;
            case 2:
                echo "Used";
                break;
            case 3:
                echo "Repaired";
                break;
            case 4:
                echo "Refurbished";
                break;
            case 5:
                echo "New Open-box";
                break;
        }
    }

    public function yesNo($val) {
        switch ($val) {
            case 0:
                echo"No";
                break;
            case 1:
                echo"Yes";
                break;
        }
    }

    /**
     * @return int[]
     */
    public function getConditionValues(): array
    {
        return $this->conditionValues;
    }

    /**
     * @return int[]
     */
    public function getYesNo(): array
    {
        return $this->yesNo;
    }
}