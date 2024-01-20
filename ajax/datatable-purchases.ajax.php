<?php

require_once "../controllers/purchases.controller.php";
require_once "../models/purchases.model.php";

require_once "../controllers/products.controller.php";
require_once "../models/products.model.php";

require_once "../controllers/suppliers.controller.php";
require_once "../models/suppliers.model.php";

class purchasesTable
{
	/*=============================================
               SHOW purchase TABLE
  	=============================================*/

	public function showPurchaseTable()
	{

		$item = null;
		$value = null;
		$order = "id";

		$purchase = controllerPurchases::ctrShowPurchases($item, $value, $order);

		if (count($purchase) == 0) {

			$jsonData = '{"data":[]}';

			echo $jsonData;

			return;
		}

		$jsonData = '{
			"data":[';

		for ($i = 0; $i < count($purchase); $i++) {

			/*=============================================
			                		We bring the image
					=============================================*/

			$image = "<img src='" . $purchase[$i]["image"] . "' width='40px'>";

			/*=============================================
				                	We bring the Supplier
					=============================================*/

			$item = 'id';
			$value = $purchase[$i]['idSuppliers'];

			$suppliers = ControllerSupplier::ctrShowSupplier($item, $value);

			/*=============================================
				                	We bring the Products
					=============================================*/

			$item = "id";
			$value = $purchase[$i]['idDescription'];
			$order = "id";

			$products = controllerProducts::ctrShowProducts($item, $value, $order);

			/*=============================================
		 	 	                	ACTION BUTTONS
		  			=============================================*/

			if (isset($_GET["Profile"]) && $_GET["Profile"] == "special") {

				$buttons =  "<div class='btn-group'><button class='btn btn-primary btnEditPurchase' idPurchase='" . $purchase[$i]["id"] . "' data-bs-toggle='modal' data-bs-target='#modalEditPurchase'><i class='fa fa-pencil'></i></button></div>";
			} else {
				$buttons =  "<div class='btn-group'><button class='btn btn-primary btnEditPurchase' idPurchase='" . $purchase[$i]["id"] . "' data-bs-toggle='modal' data-bs-target='#modalEditPurchase'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnDeletePurchase' idPurchase='" . $purchase[$i]["id"] . "' code='" . $purchase[$i]["code"] . "' image='" . $purchase[$i]["image"] . "'><i class='fa fa-trash'></i></button></div>";
			}

			$jsonData .= '[
						"' . ($i + 1) . '",
						"' . $image . '",
						"' . $purchase[$i]["code"] . '",
						"' . $products["description"] . '",
						"' . $suppliers["Supplier"] . '",
						"' . $purchase[$i]["stock"] . '",
						"$ ' . $purchase[$i]["buyingPrice"] . '",
						"$ ' . $purchase[$i]["sellingPrice"] . '",
						"' . $purchase[$i]["date"] . '",
						"' . $buttons . '"
					],';
		}

		$jsonData = substr($jsonData, 0, -1);
		$jsonData .= '] 

			}';

		echo $jsonData;
	}
}

/*=============================================
          ACTIVATE purchase TABLE
=============================================*/

$activatepurchase = new purchasesTable();
$activatepurchase->showPurchaseTable();
