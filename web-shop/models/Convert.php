<?php

class Convert
{

    private $conditionValues = array();


    public function __construct()
    {
        $this->conditionValues = [1,2,3,4,5];
    }

    /**
     * @return int[]
     */
    public function getConditionValues(): array
    {
        return $this->conditionValues;
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
}