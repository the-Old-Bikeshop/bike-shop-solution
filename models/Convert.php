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
//Order status
//Pending — Customer started the checkout process but did not complete it. Incomplete orders are assigned a "Pending" status and can be found under the More tab in the View Orders screen.
//Awaiting Payment — Customer has completed the checkout process, but payment has yet to be confirmed. Authorize only transactions that are not yet captured have this status.
//Awaiting Fulfillment — Customer has completed the checkout process and payment has been confirmed.
//Awaiting Shipment — Order has been pulled and packaged and is awaiting collection from a shipping provider.
//Awaiting Pickup — Order has been packaged and is awaiting customer pickup from a seller-specified location.
//Partially Shipped — Only some items in the order have been shipped.
//Completed — Order has been shipped/picked up, and receipt is confirmed; client has paid for their digital product, and their file(s) are available for download.
//Shipped — Order has been shipped, but receipt has not been confirmed; seller has used the Ship Items action. A listing of all orders with a "Shipped" status can be found under the More tab of the View Orders screen.
//Cancelled — Seller has cancelled an order, due to a stock inconsistency or other reasons. Stock levels will automatically update depending on your Inventory Settings. Cancelling an order will not refund the order. This status is triggered automatically when an order using an authorize-only payment gateway is voided in the control panel before capturing payment.
//Declined — Seller has marked the order as declined.
//Refunded — Seller has used the Refund action to refund the whole order. A listing of all orders with a "Refunded" status can be found under the More tab of the View Orders screen.
//Disputed — Customer has initiated a dispute resolution process for the PayPal transaction that paid for the order or the seller has marked the order as a fraudulent order.
//Manual Verification Required — Order on hold while some aspect, such as tax-exempt documentation, is manually confirmed. Orders with this status must be updated manually. Capturing funds or other order actions will not automatically update the status of an order marked Manual Verification Required.
//Partially Refunded — Seller has partially refunded the order.

//>>>>>>>>>>>>>>>>

//payment status
//Completed: The payment has been completed, and the funds have been added successfully to your account balance.
//Denied: You denied the payment. This happens only if the payment was previously pending because of possible reasons described for the pending_reason variable or the Fraud_Management_Filters_x variable.
//Expired: This authorization has expired and cannot be captured.
//Failed: The payment has failed. This happens only if the payment was made from your customer’s bank account.
//Pending: The payment is pending. See pending_reason for more information.
//Refunded: You refunded the payment.
//Processed: A payment has been accepted.






