<?php

require_once "../controllers/purchases.controller.php";
require_once "../models/purchases.model.php";

require_once "../controllers/products.controller.php";
require_once "../models/products.model.php";

require_once "../controllers/suppliers.controller.php";
require_once "../models/suppliers.model.php";

class AjaxProducts
{
	/*=============================================
	      GENERATE CODE FROM ID CATEGORY
	=============================================*/

	public $idSuppliers;

	public function ajaxCreatePurchasetCode()
	{

		$item = "idSuppliers";
		$value = $this->idSuppliers;
		$order = "id";

		$answer = controllerPurchases::ctrShowPurchases($item, $value, $order);

		echo json_encode($answer);
	}

	/*=============================================
 	                 EDIT PURCHASE
  	=============================================*/

	public $idPurchase;
	public $getPurchase;
	public $purchaseName;

	public function ajaxEditPurchase()
	{
		if ($this->getPurchase == "ok") {

			$item = null;
			$value = null;
			$order = "id";

			$answer = controllerPurchases::ctrShowPurchases($item, $value, $order);

			echo json_encode($answer);

		} else if ($this->purchaseName != "") {

			$item = "description";
			$value = $this->purchaseName;
			$order = "id";

			$answer = controllerProducts::ctrShowProducts($item, $value, $order);

			echo json_encode($answer);
		} else {

			$item = "id";
			$value = $this->idPurchase;
			$order = "id";

			$answer = controllerPurchases::ctrShowPurchases($item, $value, $order);

			echo json_encode($answer);
		}
	}
}

/*=============================================
     GENERATE CODE FROM ID Supplier
=============================================*/

if (isset($_POST["idSupplier"])) {

	$productCode = new AjaxProducts();
	$productCode->idSuppliers = $_POST["idSupplier"];
	$productCode->ajaxCreatePurchasetCode();
}

/*=============================================
     GENERATE CODE FROM ID PRODUCT
=============================================*/

if (isset($_POST["idProduct"])) {

	$productCode = new AjaxProducts();
	$productCode->idPurchase = $_POST["idProduct"];
	$productCode->ajaxEditPurchase();
}

/*=============================================
              EDIT PURCHASE
=============================================*/

if (isset($_POST["idPurchase"])) {

	$editProduct = new AjaxProducts();
	$editProduct->idPurchase = $_POST["idPurchase"];
	$editProduct->ajaxEditPurchase();
}

/*=============================================
              GET PRODUCT
=============================================*/

if (isset($_POST["getPurchase"])) {

	$getPurchase = new AjaxProducts();
	$getPurchase->getPurchase = $_POST["getPurchase"];
	$getPurchase->ajaxEditPurchase();
}

/*=============================================
              GET PRODUCT NAME
=============================================*/

if (isset($_POST["purchaseName"])) {

	$getPurchase = new AjaxProducts();
	$getPurchase->purchaseName = $_POST["purchaseName"];
	$getPurchase->ajaxEditPurchase();
}
