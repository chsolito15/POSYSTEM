<?php

require_once "Connection.php";

class ModelSupplier{

	/*=============================================
	CREATE Supplier
	=============================================*/

	public static function mdlAddSupplier($table, $data){

		$stmt = Connection::connect()->prepare("INSERT INTO $table(Supplier, address, contact) VALUES (:Supplier, :address, :contact)");

		$stmt -> bindParam(":Supplier", $data["Supplier"], PDO::PARAM_STR);
		$stmt -> bindParam(":address", $data["address"], PDO::PARAM_STR);
		$stmt -> bindParam(":contact", $data["contact"], PDO::PARAM_STR);
		
		if ($stmt->execute()) {

			return 'ok';

		} else {

			return 'error';

		}
		
		$stmt = null;
	}
	
	/*=============================================
	SHOW Supplier 
	=============================================*/
	
	public static function mdlShowSupplier($table, $item, $value){

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
	                  EDIT Supplier
	=============================================*/

	static public function mdlEditSupplier($table, $data){

		$stmt = Connection::connect()->prepare("UPDATE $table SET Supplier = :Supplier, address = :address, contact = :contact WHERE id = :id");

		$stmt -> bindParam(":id", $data["id"], PDO::PARAM_INT);
		$stmt -> bindParam(":Supplier", $data["Supplier"], PDO::PARAM_STR);
		$stmt -> bindParam(":address", $data["address"], PDO::PARAM_STR);
		$stmt -> bindParam(":contact", $data["contact"], PDO::PARAM_STR);
		
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt = null;

	}

	/*=============================================
             	DELETE Supplier
	=============================================*/

	static public function mdlDeleteSupplier($table, $data){

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