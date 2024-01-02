<?php

class ControllerCategories
{
	/*=============================================
	CREATE CATEGORY
	=============================================*/

	public static function ctrCreateCategory()
	{

		if (isset($_POST['newCategory'])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newCategory"])) {

				$table = 'categories';

				$data = $_POST['newCategory'];

				$answer = CategoriesModel::mdlAddCategory($table, $data);
				// var_dump($answer);

				if ($answer == 'ok') {

					echo '<script>
						
						Swal.fire({
							type: "success",
							icon: "success",
							title: "Category has been successfully saved ",
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

	public static function ctrShowCategories($item, $value)
	{
		$table = "categories";

		$answer = CategoriesModel::mdlShowCategories($table, $item, $value);

		return $answer;
	}

	/*=============================================
	EDIT CATEGORY
	=============================================*/

	static public function ctrEditCategory()
	{
		if (isset($_POST["editCategory"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editCategory"])) {

				$table = "categories";

				$data = array(
					"Category" => $_POST["editCategory"],
					"id" => $_POST["idCategory"]
				);

				$answer = CategoriesModel::mdlEditCategory($table, $data);
				// var_dump($answer);

				if ($answer == "ok") {

					echo '<script>

					Swal.fire({
						  type: "success",
						  icon: "success",
						  title: "Category Edited Successfully",
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
	DELETE CATEGORY
	=============================================*/

	public static function ctrDeleteCategory()
	{

		if (isset($_GET["idCategory"])) {

			$table = "categories";
			$data = $_GET["idCategory"];

			$answer = CategoriesModel::mdlDeleteCategory($table, $data);
			// var_dump($answer);

			if ($answer == "ok") {

				echo '<script>

				Swal.fire({
						  type: "success",
						  icon: "success",
						  title: "Category deleted successfully",
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
