<?php

class Convert
{

    private $conditionValues = array();
    private $yesNo = array();
    private $orderStatus = array();
    private $paymentStatus = array();

    public function __construct()
    {
        $this->conditionValues = [1,2,3,4,5];
        $this->yesNo = [0,1];
        $this->orderStatus = [0, 1, 2, 4, 5, 6, 7, 8, 9, 10];
        $this->paymentStatus = [0, 1, 2, 3, 4, 5, 6 ];
    }

    public function paymentStatus($val) {
        switch ($val) {
            case 0:
                echo "Pending";
                break;

            case 1:
                echo "Processed";
                break;
            case 2:
                echo "Completed";
                break;
            case 3:
                echo "Expired";
                break;
            case 4:
                echo "Failed";
                break;
            case 5:
                echo "Denied";
                break;
            case 6:
                echo "Refunded";
                break;
        }
    }

    public function orderStatus($val) {
        switch ($val) {
            case 0:
                echo "Pending";
                break;
            case 1:
                echo "Awaiting Payment";
                break;
            case 2:
                echo "Payment Confirmed";
                break;
            case 3:
                echo "Awaiting shipment";
                break;
            case 4:
                echo "Awaiting Pickup";
                break;
            case 5 :
                echo "Completed";
                break;
            case 6:
                echo "Shipped";
                break;
            case 7:
                echo "Cancelled";
                break;
            case 8:
                echo "Declined";
                break;
            case 9:
                echo "Refunded";
                break;
            case 10:
                echo "Delivered";
                break;

        }
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

    /**
     * @return int[]
     */
    public function getOrderStatus(): array
    {
        return $this->orderStatus;
    }

    /**
     * @return int[]
     */
    public function getPaymentStatus(): array
    {
        return $this->paymentStatus;
    }
}