<?php

require_once "../controllers/purchases.controller.php";
require_once "../models/purchases.model.php";

require_once "../controllers/products.controller.php";
require_once "../models/products.model.php";

require_once "../controllers/suppliers.controller.php";
require_once "../models/suppliers.model.php";

require_once "../controllers/categories.controller.php";
require_once "../models/categories.model.php";

class AjaxProducts
{
	/*=============================================
	      GENERATE CODE FROM ID CATEGORY
	=============================================*/

	public $idSupplier;

	public function ajaxCreateProductCode()
	{

		$item = "idSupplier";
		$value = $this->idSupplier;
		$order = "id";

		$answer = controllerProducts::ctrShowProducts($item, $value, $order);

		echo json_encode($answer);
	}

	/*=============================================
 	 EDIT PRODUCT
  	=============================================*/

	public $idProduct;
	public $getProducts;
	public $productName;

	public function ajaxEditProduct()
	{

		if ($this->getProducts == "ok") {

			$item = null;
			$value = null;
			$order = "id";

			$answer = controllerProducts::ctrShowProducts($item, $value, $order);

			echo json_encode($answer);

		} else if ($this->productName != "") {

			$item = "description";
			$value = $this->productName;
			$order = "id";

			$answer = controllerProducts::ctrShowProducts($item, $value, $order);

			echo json_encode($answer);
		} else {

			$item = "id";
			$value = $this->idProduct;
			$order = "id";

			$answer = controllerProducts::ctrShowProducts($item, $value, $order);

			echo json_encode($answer);
		}
	}
}

/*=============================================
     GENERATE CODE FROM ID Supplier
=============================================*/

if (isset($_POST["idSupplier"])) {

	$productCode = new AjaxProducts();
	$productCode->idSupplier = $_POST["idSupplier"];
	$productCode->ajaxCreateProductCode();
}

/*=============================================
              EDIT PRODUCT
=============================================*/

if (isset($_POST["idProduct"])) {

	$editProduct = new AjaxProducts();
	$editProduct->idProduct = $_POST["idProduct"];
	$editProduct->ajaxEditProduct();
}

/*=============================================
              GET PRODUCT
=============================================*/

if (isset($_POST["getProducts"])) {

	$getProducts = new AjaxProducts();
	$getProducts->getProducts = $_POST["getProducts"];
	$getProducts->ajaxEditProduct();
}

/*=============================================
              GET PRODUCT NAME
=============================================*/

if (isset($_POST["productName"])) {

	$getProducts = new AjaxProducts();
	$getProducts->productName = $_POST["productName"];
	$getProducts->ajaxEditProduct();
}
