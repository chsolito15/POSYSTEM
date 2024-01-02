<?php


require_once "../../../../../../controllers/sales.controller.php";
require_once "../../../../../../models/sales.model.php";

require_once "../../../../../../controllers/customers.controller.php";
require_once "../../../../../../models/customers.model.php";

require_once "../../../../../../controllers/users.controller.php";
require_once "../../../../../../models/users.model.php";

require_once "../../../../../../controllers/products.controller.php";
require_once "../../../../../../models/products.model.php";

class printBill
{

    public $code;

    public function getBillPrinting()
    {

        //WE BRING THE INFORMATION OF THE SALE

        $itemSale = "code";
        $valueSale = $this->code;

        $answerSale = ControllerSales::ctrShowSales($itemSale, $valueSale);

        $saledate = substr($answerSale["saledate"], 0, -8);
        $products = json_decode($answerSale["products"], true);
        $netPrice = $answerSale["netPrice"];
        $tax = $answerSale["tax"];
        $totalPrice = $answerSale["totalPrice"];

        //TRAEMOS LA INFORMACIÓN DEL Customer
        //WE BRING THE INFORMATION OF THE CUSTOMER

        $itemCustomer = "id";
        $valueCustomer = $answerSale["idCustomer"];

        $answerCustomer = ControllerCustomers::ctrShowCustomers($itemCustomer, $valueCustomer);

        //TRAEMOS LA INFORMACIÓN DEL Seller
        //WE BRING THE INFORMATION OF THE CUSTOMER

        $itemSeller = "id";
        $valueSeller = $answerSale["idSeller"];

        $answerSeller = ControllerUsers::ctrShowUsers($itemSeller, $valueSeller);
    }
}
