<?php

class controllerPurchases
{

	/*=============================================
	                  SHOW PRODUCTS
	=============================================*/

	public static function ctrShowPurchases($item, $value, $order)
	{

		$table = "purchases";

		$answer = purchasesModel::mdlShowPurchases($table, $item, $value, $order);

		return $answer;
	}

	/*=============================================
	                 CREATE PRODUCTS
	=============================================*/

	static public function ctrCreatePurchases()
	{

		if (isset($_POST["newProductDescription"])) {

			if (
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newProductDescription"]) &&
				preg_match('/^[0-9]+$/', $_POST["newSupplierStock"]) &&
				preg_match('/^[0-9.]+$/', $_POST["newBuyingSupplierPrice"]) &&
				preg_match('/^[0-9.]+$/', $_POST["newSellingSupplierPrice"])
			) {

				/*=============================================
			                  	VALIDATE IMAGE
				=============================================*/

				$route = "views/img/products/default/anonymous.png";

				if (isset($_FILES["newProdPhoto"]["tmp_name"]) && $_FILES["newProdPhoto"]["error"] == 0) {

					list($width, $height) = getimagesize($_FILES["newProdPhoto"]["tmp_name"]);

					$newWidth = 500;
					$newHeight = 500;

					/*=============================================
					   we create the folder to save the picture
					=============================================*/

					$folder = "views/img/products/" . $_POST["newPurchaseCode"];

					mkdir($folder, 0755);

					/*=============================================
					WE APPLY DEFAULT PHP FUNCTIONS ACCORDING TO THE IMAGE FORMAT
					=============================================*/

					if ($_FILES["newProdPhoto"]["type"] == "image/jpeg") {

						/*=============================================
						WE SAVE THE IMAGE IN THE FOLDER
						=============================================*/

						$random = mt_rand(100, 999);

						$route = "views/img/products/" . $_POST["newPurchaseCode"] . "/" . $random . ".jpg";

						$origin = imagecreatefromjpeg($_FILES["newProdPhoto"]["tmp_name"]);

						$destiny = imagecreatetruecolor($newWidth, $newHeight);

						imagecopyresized($destiny, $origin, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

						imagejpeg($destiny, $route);
					}

					if ($_FILES["newProdPhoto"]["type"] == "image/png") {

						/*=============================================
					        	WE SAVE THE IMAGE IN THE FOLDER
						=============================================*/

						$random = mt_rand(100, 999);

						$route = "views/img/products/" . $_POST["newPurchaseCode"] . "/" . $random . ".png";

						$origin = imagecreatefrompng($_FILES["newProdPhoto"]["tmp_name"]);

						$destiny = imagecreatetruecolor($newWidth, $newHeight);

						imagecopyresized($destiny, $origin, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

						imagepng($destiny, $route);
					}
				}

				$table = "purchases";

				$data = array(
					"idSupplier" => $_POST["newSupplier"],
					"code" => $_POST["newPurchaseCode"],
					"idDescription" => $_POST["newProductDescription"],
					"stock" => $_POST["newSupplierStock"],
					"buyingPrice" => $_POST["newBuyingSupplierPrice"],
					"sellingPrice" => $_POST["newSellingSupplierPrice"],
					"image" => $route
				);

				$answer = purchasesModel::mdlAddPurchases($table, $data);

				if ($answer == "ok") {

					echo '<script>

						Swal.fire({
							  type: "success",
							  title: "The new Product Purchase has been added successfully",
							  showConfirmButton: true,
							  confirmButtonText: "Close"
							  }).then(function(result){
										if (result.value) {

										window.location = "purchases";

										}
									})

						</script>';
				}
			} else {

				echo '<script>

					Swal.fire({
						  type: "error",
						  title: "The Product cannot go with empty fields or carry special characters!",
						  showConfirmButton: true,
						  confirmButtonText: "Close"
						  }).then(function(result){
							if (result.value) {

							window.location = "products";

							}
						})

			  	</script>';
			}
		}
	}

	/*=============================================
	                EDIT PRODUCT
	=============================================*/

	static public function ctrEditPurchases()
	{

		if (isset($_POST["editDescription"])) {

			if (
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editDescription"]) &&
				preg_match('/^[0-9]+$/', $_POST["editStock"]) &&
				preg_match('/^[0-9.]+$/', $_POST["editBuyingPrice"]) &&
				preg_match('/^[0-9.]+$/', $_POST["editSellingPrice"])
			) {

				/*=============================================
				VALIDATE IMAGE
				=============================================*/

				$route = $_POST["currentImage"];

				if (isset($_FILES["editImage"]["tmp_name"]) && !empty($_FILES["editImage"]["tmp_name"])) {

					list($width, $height) = getimagesize($_FILES["editImage"]["tmp_name"]);

					$newWidth = 500;
					$newHeight = 500;

					/*=============================================
					WE CREATE THE FOLDER WHERE WE WILL SAVE THE PRODUCT IMAGE
					=============================================*/

					$folder = "views/img/products/" . $_POST["editCode"];

					/*=============================================
					WE ASK IF WE HAVE ANOTHER PICTURE IN THE DB
					=============================================*/

					if (!empty($_POST["currentImage"]) && $_POST["currentImage"] != "views/img/products/default/anonymous.png") {

						unlink($_POST["currentImage"]);
					} else {

						mkdir($folder, 0755);
					}

					/*=============================================
					WE APPLY DEFAULT PHP FUNCTIONS ACCORDING TO THE IMAGE FORMAT
					=============================================*/

					if ($_FILES["editImage"]["type"] == "image/jpeg") {

						/*=============================================
						WE SAVE THE IMAGE IN THE FOLDER
						=============================================*/

						$random = mt_rand(100, 999);

						$route = "views/img/products/" . $_POST["editCode"] . "/" . $random . ".jpg";

						$origin = imagecreatefromjpeg($_FILES["editImage"]["tmp_name"]);

						$destiny = imagecreatetruecolor($newWidth, $newHeight);

						imagecopyresized($destiny, $origin, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

						imagejpeg($destiny, $route);
					}

					if ($_FILES["editImage"]["type"] == "image/png") {

						/*=============================================
					        	WE SAVE THE IMAGE IN THE FOLDER
						=============================================*/

						$random = mt_rand(100, 999);

						$route = "views/img/products/" . $_POST["editCode"] . "/" . $random . ".png";

						$origin = imagecreatefrompng($_FILES["editImage"]["tmp_name"]);

						$destiny = imagecreatetruecolor($newWidth, $newHeight);

						imagecopyresized($destiny, $origin, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

						imagepng($destiny, $route);
					}
				}

				$table = "purchases";

				$data = array(
					"idSupplier" => $_POST["editSupplier"],
					   "code" => $_POST["editCode"],
					"idDescription" => $_POST["editDescription"],
					"stock" => $_POST["editStock"],
					"buyingPrice" => $_POST["editBuyingPrice"],
					"sellingPrice" => $_POST["editSellingPrice"],
					"image" => $route
				);

				$answer = purchasesModel::mdlEditPurchases($table, $data);

				if ($answer == "ok") {

					echo '<script>

						Swal.fire({
							  type: "success",
							  title: "The product has been updated",
							  showConfirmButton: true,
							  confirmButtonText: "Close"
							  }).then(function(result){
										if (result.value) {

										window.location = "products";

										}
									})

						</script>';
				}
			} else {

				echo '<script>

					Swal.fire({
						  type: "error",
						  title: "The Product cannot be empty or have special characters!",
						  showConfirmButton: true,
						  confirmButtonText: "Close"
						  }).then(function(result){
							if (result.value) {

							window.location = "products";

							}
						})

			  	</script>';
			}
		}
	}

	/*=============================================
	              DELETE PRODUCT
	=============================================*/

	public static function ctrDeletePurchases()
	{

		if (isset($_GET["idPurchase"])) {

			$table = "purchases";

			$datum = $_GET["idPurchase"];

			if ($_GET["image"] != "" && $_GET["image"] != "views/img/products/default/anonymous.png") {

				unlink($_GET["image"]);
				rmdir('views/img/products/' . $_GET["code"]);
			}

			$answer = purchasesModel::mdlDeletePurchases($table, $datum);

			if ($answer == "ok") {

				echo '<script>

				Swal.fire({
					  type: "success",
					  title: "The Product has been successfully deleted",
					  showConfirmButton: true,
					  confirmButtonText: "Close"
					  }).then(function(result){
								if (result.value) {

								window.location = "products";

								}
							})

				</script>';
			}
		}
	}
}
