<?php

require_once 'Connection.php';

class UsersModel
{

	/*=============================================
	                 SHOW USER 
	=============================================*/

	public static function MdlShowUsers($tableUsers, $item, $value)
	{

		if ($item != null) {

			$stmt = Connection::connect()->prepare("SELECT * FROM $tableUsers WHERE $item = :$item");

			$stmt->bindParam(":" . $item, $value, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {
			$stmt = Connection::connect()->prepare("SELECT * FROM $tableUsers");

			$stmt->execute();

			return $stmt->fetchAll();
		}
		$stmt = null;
	}

	/*=============================================
	                   ADD USER 
	=============================================*/

	public static function mdlAddUser($table, $data)
	{

		$stmt = Connection::connect()->prepare("INSERT INTO $table(name, username, password, profile, photo) VALUES (:name, :username, :password, :profile, :photo)");

		$stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);
		$stmt->bindParam(":username", $data["username"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $data["password"], PDO::PARAM_STR);
		$stmt->bindParam(":profile", $data["profile"], PDO::PARAM_STR);
		$stmt->bindParam(":photo", $data["photo"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return 'ok';
		} else {

			return 'error';
		}

		$stmt = null;
	}

	/*=============================================
						EDIT USER 
	=============================================*/

	public static function mdlEditUser($table, $data)
	{
		$stmt = Connection::connect()->prepare("UPDATE $table SET name = :name, password = :password, profile = :profile, photo = :photo WHERE username = :username");

		$stmt->bindParam(":name", $data["name"], PDO::PARAM_STR);
		$stmt->bindParam(":username", $data["username"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $data["password"], PDO::PARAM_STR);
		$stmt->bindParam(":profile", $data["profile"], PDO::PARAM_STR);
		$stmt->bindParam(":photo", $data["photo"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return 'ok';
		} else {

			return 'error';
		}
		$stmt = null;
	}

	/*=============================================
					UPDATE USER 
	=============================================*/

	public static function mdlUpdateUser($table, $item1, $value1, $item2, $value2)
	{

		$stmt = Connection::connect()->prepare("UPDATE $table SET  $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt->bindParam(":" . $item1, $value1, PDO::PARAM_STR);
		$stmt->bindParam(":" . $item2, $value2, PDO::PARAM_STR);

		if ($stmt->execute()) {
			return 'ok';
		} else {
			return 'error';
		}
		$stmt = null;
	}

	public static function mdlEditPass($table, $data)
	{
		$stmt = Connection::connect()->prepare("UPDATE $table SET password = :password WHERE id = :id");
		
		$stmt->bindParam(":password", $data["password"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $data["id"], PDO::PARAM_INT);
		
		if ($stmt->execute()) {

			return 'ok';
		} else {

			return 'error';
		}
		$stmt = null;
	}

	/*=============================================
			    	DELETE USER 
	=============================================*/

	public static function mdlDeleteUser($table, $data)
	{

		$stmt = Connection::connect()->prepare("DELETE FROM $table WHERE id = :id");

		$stmt->bindParam(":id", $data, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return 'ok';
		} else {

			return 'error';
		}
		$stmt = null;
	}

}
