<?php

class ControllerSupplier
{
	/*=============================================
	CREATE Supplier
	=============================================*/

	public static function ctrCreateSupplier()
	{

		if (isset($_POST['newSupplier'])) {

			if (
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newSupplier"]) &&
				preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["newAddrss"]) &&
				preg_match('/^[()\-0-9 ]+$/', $_POST["newContact"])

			) {

				$table = 'suppliers';

				$data = array(
					"Supplier" => $_POST['newSupplier'],
					"address" => $_POST["newAddrss"],
					"contact" => $_POST["newContact"]

				);

				$answer = SupplierModel::mdlAddSupplier($table, $data);

				//var_dump($answer);

				if ($answer == 'ok') {

					echo '<script>
						
						Swal.fire({
							type: "success",
							icon: "success",
							title: "Supplier has been successfully saved ",
							showConfirmButton: true,
							confirmButtonText: "Close"

							}).then(function(result){
								if (result.value) {
									window.location = "categories";
								}
							});
						
					</script>';
				}
			} else {

				echo '<script>
						
				Swal.fire({
							type: "error",
							icon: "error",
							title: "No especial characters or blank fields",
							showConfirmButton: true,
							confirmButtonText: "Close"
				
							 }).then(function(result){

								if (result.value) {
									window.location = "categories";
								}
							});
						
				</script>';
			}
		}
	}

	/*=============================================
	SHOW CATEGORIES
	=============================================*/

	public static function ctrShowSupplier($item, $value)
	{
		$table = "suppliers";

		$answer = SupplierModel::mdlShowSupplier($table, $item, $value);

		return $answer;
	}

	/*=============================================
	EDIT Supplier
	=============================================*/

	static public function ctrEditSupplier()
	{
		if (isset($_POST["editSupplier"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editSupplier"])) {

				$table = "suppliers";

				$data = array(
					"Supplier" => $_POST["editSupplier"],
					"id" => $_POST["idSupplier"]
				);

				$answer = SupplierModel::mdlEditSupplier($table, $data);
				// var_dump($answer);

				if ($answer == "ok") {

					echo '<script>

					Swal.fire({
						  type: "success",
						  icon: "success",
						  title: "Supplier Edited Successfully",
						  showConfirmButton: true,
						  confirmButtonText: "Close",

						  showClass: {
							backdrop: "swal2-noanimation", 
							popup: "",                    
							icon: "" 
						  },

						  hideClass: {
							popup: "",                     
						  }

						  }).then(function(result){
									if (result.value) {

									window.location = "categories";

									}
								})

					</script>';
				}
			} else {

				echo '<script>

				Swal.fire({
						  type: "error",
						  icon: "error",
						  title: "No especial characters or blank fields",
						  showConfirmButton: true,
						  confirmButtonText: "Close"

						  }).then(function(result){
							if (result.value) {

							window.location = "categories";

							}
						})

			  	</script>';
			}
		}
	}

	/*=============================================
	DELETE Supplier
	=============================================*/

	public static function ctrDeleteSupplier()
	{

		if (isset($_GET["idSupplier"])) {

			$table = "suppliers";

			$data = $_GET["idSupplier"];

			$answer = SupplierModel::mdlDeleteSupplier($table, $data);
			// var_dump($answer);

			if ($answer == "ok") {

				echo '<script>

				Swal.fire({
						  type: "success",
						  icon: "success",
						  title: "Supplier deleted successfully",
						  showConfirmButton: true,
						  confirmButtonText: "Close",

						  showClass: {
							backdrop: "swal2-noanimation", 
							popup: "",                    
							icon: "" 
						  },
						                       
						  hideClass: {
							popup: "",                     
						  }

						  }).then(function(result){
							
									if (result.isConfirmed) {

									window.location = "categories";

									}
								})

					</script>';
			}
		}
	}
}
