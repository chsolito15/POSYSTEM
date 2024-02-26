<?php

class ControllerUsers
{
	/*=============================================
	                USER LOGIN
	=============================================*/

	public static function ctrUserLogin()
	{
		if (isset($_POST["loginUser"])) {
			if (
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["loginUser"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["loginPass"])

			) {
				$table = 'users';
				$item = 'username';
				$value = $_POST["loginUser"];

				$user = UsersModel::MdlShowUsers($table, $item, $value);

				if (is_array($user) && isset($user["username"]) && isset($user["password"])) {

					if (password_verify($_POST["loginPass"], $user["password"])) {
	
							if ($user["status"] == 1) {

								$_SESSION["loggedIn"] = "ok";
								$_SESSION["id"] = $user["id"];
								$_SESSION["name"] = $user["name"];
								$_SESSION["username"] = $user["username"];
								$_SESSION["photo"] = $user["photo"];
								$_SESSION["profile"] = $user["profile"];

								$item1 = "lastLogin";
								$value1 = 1;
								$item2 = "id";
								$value2 = $user["id"];

								$lastLogin = UsersModel::mdlUpdateUser($table, $item1, $value1, $item2, $value2);

								if ($lastLogin == "ok") {

									echo '<script>
	
											window.location = "home";
	
										  </script>';
								}
							} else {
								echo '<div class="alert alert-danger">Your account not activated by Admin</div>';
							}
					}else{
							echo '<div class="alert alert-danger">User or password incorrect</div>';
						}
				} else {
					echo '<div class="alert alert-danger">User not found</div>';
				}
			}
		}
	}

	/*=============================================
	                  CREATE USER
	=============================================*/

	public static function ctrCreateUser()
	{

		if (isset($_POST["newUser"])) {

			if (
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["newName"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["newUser"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["newPasswd"])
			) {

				/*=============================================
			                	VALIDATE IMAGE
				=============================================*/

				$photo = "views/img/users/default/anonymous.png";


				if (isset($_FILES["newPhoto"]["tmp_name"]) && $_FILES["newPhoto"]["error"] == 0) {

					list($width, $height) = getimagesize($_FILES["newPhoto"]["tmp_name"]);

					$newWidth = 500;
					$newHeight = 500;

					/*=============================================
					Let's create the folder for each user
					=============================================*/

					$folder = "views/img/users/" . $_POST["newUser"];

					mkdir($folder, 0755);

					/*=============================================
					PHP functions depending on the image
					=============================================*/

					if ($_FILES["newPhoto"]["type"] == "image/jpeg") {

						$randomNumber = mt_rand(100, 999);

						$photo = "views/img/users/" . $_POST["newUser"] . "/" . $randomNumber . ".jpg";

						$srcImage = imagecreatefromjpeg($_FILES["newPhoto"]["tmp_name"]);

						$destination = imagecreatetruecolor($newWidth, $newHeight);

						imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

						imagejpeg($destination, $photo);
					}

					if ($_FILES["newPhoto"]["type"] == "image/png") {

						$randomNumber = mt_rand(100, 999);

						$photo = "views/img/users/" . $_POST["newUser"] . "/" . $randomNumber . ".png";

						$srcImage = imagecreatefrompng($_FILES["newPhoto"]["tmp_name"]);

						$destination = imagecreatetruecolor($newWidth, $newHeight);

						imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

						imagepng($destination, $photo);
					}
				} else {
					echo "Error: File upload failed.";
				}

				$table = 'users';

				$encryptpass = password_hash($_POST["newPasswd"], PASSWORD_DEFAULT);

				$data = array(
					'name' => $_POST["newName"],
					'username' => $_POST["newUser"],
					'password' => $encryptpass,
					'profile' => $_POST["newProfile"],
					'photo' => $photo
				);

				$user = UsersModel::mdlAddUser($table, $data);

				if ($user == 'ok') {

					echo '<script>
						
						Swal.fire({
							type: "success",
							icon: "success",
							title: "User added Succesfully!",
							showConfirmButton: true,
							confirmButtonText: "Close"
						}).then((result) => {											
								window.location = "users";											
						  });
						
						</script>';
				}
			} else {

				echo '<script>
					
						Swal.fire({
							type: "error",
							icon: "error",
							title: "No special characters or blank fields",
						    showConfirmButton: true,
						    confirmButtonText: "Close"
						}).then((result) => {							
								window.location = "users";					
						  });
					
				</script>';
			}
		}
	}

	/*=============================================
	                   SHOW USER
	=============================================*/

	public static function ctrShowUsers($item, $value)
	{
		$table = "users";

		$user = UsersModel::MdlShowUsers($table, $item, $value);

		return $user;
	}

	/*=============================================
	                   EDIT USER
	=============================================*/

	public static function ctrEditUser()
	{
		if (isset($_POST["EditUser"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["EditName"])) {

				$photo = $_POST["currentPicture"];

				if (isset($_FILES["editPhoto"]["tmp_name"]) && !empty($_FILES["editPhoto"]["tmp_name"])) {

					list($width, $height) = getimagesize($_FILES["editPhoto"]["tmp_name"]);

					$newWidth = 500;
					$newHeight = 500;

					/*=============================================
					    Let's create the folder for each user 
					 =============================================*/

					$folder = "views/img/users/" . $_POST["EditUser"];

					/*=============================================
					 we ask first if there's an existing image in the database 
					 =============================================*/

					if (empty($_POST["currentPicture"])) {

						unlink($_POST["currentPicture"]);
					}
					mkdir($folder, 0755);
					/*=============================================
					 PHP functions depending on the image 
					 =============================================*/

					if ($_FILES["editPhoto"]["type"] == "image/jpeg") {

						/*We save the image in the folder*/

						$randomNumber = mt_rand(100, 999);

						$photo = "views/img/users/" . $_POST["EditUser"] . "/" . $randomNumber . ".jpg";

						$srcImage = imagecreatefromjpeg($_FILES["editPhoto"]["tmp_name"]);

						$destination = imagecreatetruecolor($newWidth, $newHeight);

						imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

						imagejpeg($destination, $photo);
					}

					if ($_FILES["editPhoto"]["type"] == "image/png") {

						/*We save the image in the folder*/

						$randomNumber = mt_rand(100, 999);

						$photo = "views/img/users/" . $_POST["EditUser"] . "/" . $randomNumber . ".png";

						$srcImage = imagecreatefrompng($_FILES["editPhoto"]["tmp_name"]);

						$destination = imagecreatetruecolor($newWidth, $newHeight);

						imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

						imagepng($destination, $photo);
					}
				}

				$table = 'users';

				if ($_POST["EditPasswd"] != "") {

					if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["EditPasswd"])) {

						$encryptpass = crypt($_POST["EditPasswd"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
					} else {

						echo '<script>
					
							Swal.fire({
								type: "error",
								icon: "error",
								title: "No special characters in the password or blank fields",
								showConfirmButton: true,
								confirmButtonText: "Close"

								}).then(function(result){										
									if (result.value) {		
										window.location = "users";
									}
								});
							
						</script>';
					}
				} else {

					$encryptpass = $_POST["currentPasswd"];
				}

				$data = array(
					'name' => $_POST["EditName"],
					'username' => $_POST["EditUser"],
					'password' => $encryptpass,
					'profile' => $_POST["EditProfile"],
					'photo' => $photo
				);

				$user = UsersModel::mdlEditUser($table, $data);

				if ($user == 'ok') {

					echo '<script>
					
						Swal.fire({
							type: "success",
							icon: "success",
							title: "User edited succesfully!",
							showConfirmButton: true,
							confirmButtonText: "Close"

						 }).then(function(result){
							
							if (result.value) {

								window.location = "users";
							}

						});
					
					</script>';
				} else {

					echo '<script>
						
						Swal.fire({
							type: "error",
							icon: "error",
							title: "No special characters in the name or blank field",
							showConfirmButton: true,
							confirmButtonText: "Close"
							 }).then(function(result){
									
								if (result.value) {

									window.location = "users";

								}

							});
						
					</script>';
				}
			}
		}
	}

	public static function ctrEditProfile()
	{
		if (isset($_POST["EditUser"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["EditName"])) {

				$photo = $_POST["currentPicture"];

				if (isset($_FILES["editPhoto"]["tmp_name"]) && !empty($_FILES["editPhoto"]["tmp_name"])) {

					list($width, $height) = getimagesize($_FILES["editPhoto"]["tmp_name"]);

					$newWidth = 500;
					$newHeight = 500;

					/*=============================================
					    Let's create the folder for each user 
					 =============================================*/

					$folder = "views/img/users/" . $_POST["EditUser"];

					/*=============================================
					 we ask first if there's an existing image in the database 
					 =============================================*/

					if (empty($_POST["currentPicture"])) {

						unlink($_POST["currentPicture"]);
					}
					mkdir($folder, 0755);

					/*=============================================
					 PHP functions depending on the image 
					 =============================================*/

					if ($_FILES["editPhoto"]["type"] == "image/jpeg") {

						/*We save the image in the folder*/

						$randomNumber = mt_rand(100, 999);

						$photo = "views/img/users/" . $_POST["EditUser"] . "/" . $randomNumber . ".jpg";

						$srcImage = imagecreatefromjpeg($_FILES["editPhoto"]["tmp_name"]);

						$destination = imagecreatetruecolor($newWidth, $newHeight);

						imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

						imagejpeg($destination, $photo);
					}

					if ($_FILES["editPhoto"]["type"] == "image/png") {

						/*We save the image in the folder*/

						$randomNumber = mt_rand(100, 999);

						$photo = "views/img/users/" . $_POST["EditUser"] . "/" . $randomNumber . ".png";

						$srcImage = imagecreatefrompng($_FILES["editPhoto"]["tmp_name"]);

						$destination = imagecreatetruecolor($newWidth, $newHeight);

						imagecopyresized($destination, $srcImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

						imagepng($destination, $photo);
					}
				}

				$table = 'users';

				$data = array(
					'name' => $_SESSION["name"] = $_POST["EditName"],
					'username' => $_POST["EditUser"],
					'photo' => $_SESSION["photo"] =  $photo
				);

				$user = UsersModel::mdlProfileUser($table, $data);

				if ($user == 'ok') {

					echo '<script>
					
						Swal.fire({
							type: "success",
							icon: "success",
							title: "Profile edited succesfully!",
							showConfirmButton: true,
							confirmButtonText: "Close"

						 }).then(function(result){
							
							if (result.value) {

								window.location = "profile";
							}

						});
					
					</script>';
				} else {

					echo '<script>
						
						Swal.fire({
							type: "error",
							icon: "error",
							title: "No special characters in the name or blank field",
							showConfirmButton: true,
							confirmButtonText: "Close"
							 }).then(function(result){
									
								if (result.value) {

									window.location = "profile";
								
								}

							});
						
					</script>';
				}
			}
		}
	}

	public static function crtProfilePassword()
	{
		$table = 'users';

		$userId = $_SESSION['id'];

		if (isset($_POST["EditPasswd"]) && isset($_POST['currentPasswd']) && isset($_POST['confirmPasswd'])) {

			$item = "id";
			$value = $_SESSION['id'];

			$encryptpass = crypt($_POST['currentPasswd'], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

			$user = UsersModel::MdlShowUsers($table, $item, $value);

			$oldPass = $user["password"];

			$newPasswd = $_POST['EditPasswd'];
			$confirmPasswd = $_POST['confirmPasswd'];

			if ($encryptpass === $oldPass) {

				if ($newPasswd !== $confirmPasswd) {

					echo 'Your new Password does not match to comfirm password';
				} else {

					if (preg_match('/^[a-zA-Z0-9]+$/', $newPasswd)) {

						$encryptpass = crypt($newPasswd, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

						$data = array(
							'password' => $encryptpass,
							'id' => $userId
						);

						$user = UsersModel::mdlEditProfilePass($table, $data);

						if ($user == 'ok') {

							echo '<script>
					
							Swal.fire({
								type: "success",
								icon: "success",
								title: "Password Change Successfully",
								showConfirmButton: true,
								confirmButtonText: "Close"
								 }).then(function(result){
										
									if (result.value) {
		
										window.location = "logout";
									
									}
		
								});
							
						</script>';
						} else {

							echo '<script>
					
					Swal.fire({
						type: "error",
						icon: "error",
						title: "No special characters in the name or blank field",
						showConfirmButton: true,
						confirmButtonText: "Close"
						 }).then(function(result){
								
							if (result.value) {

								window.location = "profile";
							
							}

						});
					
				</script>';
						}
					}
				}
			} else {
				echo 'Your current Password not match';
			}
		}
	}


	/*=============================================
					DELETE USER
	=============================================*/

	static public function ctrDeleteUser()
	{
		if (isset($_GET["userId"])) {

			$table = "users";

			$data = $_GET["userId"];

			if ($_GET["userPhoto"] != "views/img/users/default/anonymous.png") {

				unlink($_GET["userPhoto"]);
				rmdir('views/img/users/' . $_GET["username"]);
			}

			$user = UsersModel::mdlDeleteUser($table, $data);

			if ($user == "ok") {

				echo '<script>

				Swal.fire({
					type: "success",
					icon: "success",
					title: "The user has been succesfully deleted",
					showConfirmButton: true,
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					confirmButtonText: "Yes, delete it!"
				  }).then((result) => {
					if (result.isConfirmed) {
					
						window.location = "users";
					  
					}
				  })

				</script>';
			}
		}
	}
}
