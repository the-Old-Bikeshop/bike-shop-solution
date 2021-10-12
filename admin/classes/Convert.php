<?php

class Convert
{

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