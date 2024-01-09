<?php

require_once "../controllers/purchases.controller.php";
require_once "../models/purchases.model.php";

require_once "../controllers/suppliers.controller.php";
require_once "../models/suppliers.model.php";

class purchasesTable{

	/*=============================================
               SHOW PRODUCTS TABLE
  	=============================================*/
	
	public function showPurchaseTable(){

		$item = null;
		$value = null;
		$order = "id";

		$products = controllerPurchases::ctrShowPurchases($item, $value, $order);

		if(count($products) == 0){

			$jsonData = '{"data":[]}';

			echo $jsonData;

			return;
		}

		$jsonData = '{
			"data":[';

				for($i=0; $i < count($products); $i++){

					/*=============================================
			                		We bring the image
					=============================================*/
					
					$image = "<img src='".$products[$i]["image"]."' width='40px'>";

					/*=============================================
				                	We bring the category
					=============================================*/
					
					$item = 'id';
				  	$value = $products[$i]['idCategory'];

				  	$categories = ControllerSupplier::ctrCreateSupplier($item, $value);
				
		  			/*=============================================
		 	 	                	ACTION BUTTONS
		  			=============================================*/ 
					
		  			if (isset($_GET["hiddenProfile"]) && $_GET["hiddenProfile"] == "special") {

		  				$buttons =  "<div class='btn-group'><button class='btn btn-primary btnEditProduct' idPurchase='".$products[$i]["id"]."' data-bs-toggle='modal' data-bs-target='#modalEditProduct'><i class='fa fa-pencil'></i></button></div>";
		  			}
		  			else{
		  				$buttons =  "<div class='btn-group'><button class='btn btn-primary btnEditProduct' idPurchase='".$products[$i]["id"]."' data-bs-toggle='modal' data-bs-target='#modalEditProduct'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnDeleteProduct' idPurchase='".$products[$i]["id"]."' code='".$products[$i]["code"]."' image='".$products[$i]["image"]."'><i class='fa fa-trash'></i></button></div>";
		  			}

					$jsonData .='[
						"'.($i+1).'",
						"'.$image.'",
						"'.$products[$i]["code"].'",
						"'.$products[$i]["description"].'",
						"'.$categories["Supplier"].'",
						"'.$products[$i]["stock"].'",
						"$ '.$products[$i]["buyingPrice"].'",
						"$ '.$products[$i]["sellingPrice"].'",
						"'.$products[$i]["date"].'",
						"'.$buttons.'"
					],';
				}

				$jsonData = substr($jsonData, 0, -1);
				$jsonData .= '] 

			}';

		echo $jsonData;
	}
}

/*=============================================
          ACTIVATE PRODUCTS TABLE
=============================================*/ 

$activateProducts = new purchasesTable();
$activateProducts->showPurchaseTable();