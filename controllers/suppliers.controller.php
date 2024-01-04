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
				preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["newAddress"]) &&
				preg_match('/^[()\-0-9 ]+$/', $_POST["newContact"])

			) {

				$table = 'suppliers';

				$data = array(
					"Supplier" => $_POST['newSupplier'],
					"address" => $_POST["newAddress"],
					"contact" => $_POST["newContact"]

				);

				$answer = ModelSupplier::mdlAddSupplier($table, $data);

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
									window.location = "suppliers";
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
									window.location = "suppliers";
								}
							});
						
				</script>';
			}
		}
	}

	/*=============================================
	SHOW Supplier
	=============================================*/

	public static function ctrShowSupplier($item, $value)
	{
		$table = "suppliers";

		$answer = ModelSupplier::mdlShowSupplier($table, $item, $value);

		return $answer;
	}

	/*=============================================
	EDIT Supplier
	=============================================*/

	static public function ctrEditSupplier()
	{
		if (isset($_POST["editSupplier"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editSupplier"] &&
				preg_match('/^[#\.\-a-zA-Z0-9 ]+$/', $_POST["editAddress"]) &&
				preg_match('/^[()\-0-9 ]+$/', $_POST["editContact"])
				)) {

				$table = "suppliers";

				$data = array(
					"Supplier" => $_POST["editSupplier"],
					"address" => $_POST['editAddress'],
					"contact" => $_POST['editContact'],
					"id" => $_POST["idSupplier"]
				);

				$answer = ModelSupplier::mdlEditSupplier($table, $data);
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

									window.location = "suppliers";

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

							window.location = "suppliers";

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

			$answer = ModelSupplier::mdlDeleteSupplier($table, $data);
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

									window.location = "suppliers";

									}
								})

					</script>';
			}
		}
	}
}
