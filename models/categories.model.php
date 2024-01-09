<?php

require_once "Connection.php";

class CategoriesModel{

	/*=============================================
	            CREATE CATEGORY
	=============================================*/

	public static function mdlAddCategory($table, $data){

		$stmt = Connection::connect()->prepare("INSERT INTO $table(category) VALUES (:category)");

		$stmt -> bindParam(":category", $data, PDO::PARAM_STR);
		
		if ($stmt->execute()) {

			return 'ok';

		} else {

			return 'error';

		}
		
		$stmt = null;
	}
	
	/*=============================================
	SHOW CATEGORY 
	=============================================*/
	
	public static function mdlShowCategories($table, $item, $value){

		if($item != null){

			$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}
		else{
			$stmt = Connection::connect()->prepare("SELECT * FROM $table");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt = null;

	}
	
	/*=============================================
	EDIT CATEGORY
	=============================================*/

	static public function mdlEditCategory($table, $data){

		$stmt = Connection::connect()->prepare("UPDATE $table SET Category = :Category WHERE id = :id");

		$stmt -> bindParam(":Category", $data["Category"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $data["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt = null;

	}

	/*=============================================
             	DELETE CATEGORY
	=============================================*/

	static public function mdlDeleteCategory($table, $data){

		$stmt = Connection::connect()->prepare("DELETE FROM $table WHERE id = :id");

		$stmt -> bindParam(":id", $data, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

	
		$stmt = null;

	}
}