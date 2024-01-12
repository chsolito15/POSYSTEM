<?php

require_once 'Connection.php';


class purchasesModel{
	/*=============================================
	             SHOWING purchase
	=============================================*/

	static public function mdlShowPurchases($table, $item, $value){

		if($item != null){

			$stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item ORDER BY id DESC");

			$stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Connection::connect()->prepare("SELECT * FROM $table");

			$stmt -> execute();

			return $stmt -> fetchAll();
		}

		$stmt = null;

	}


	/*=============================================
	                ADDING PURCHASE
	=============================================*/

	static public function mdlAddPurchases($table, $data){

		$stmt = Connection::connect()->prepare("INSERT INTO $table(idSupplier, code, idDescription, image, stock, buyingPrice, sellingPrice) VALUES (:idSupplier, :code, :idDescription, :image, :stock, :buyingPrice, :sellingPrice)");

		$stmt->bindParam(":idSupplier", $data["idSupplier"], PDO::PARAM_INT);
		$stmt->bindParam(":code", $data["code"], PDO::PARAM_INT);
		$stmt->bindParam(":idDescription", $data["idDescription"], PDO::PARAM_STR);
		$stmt->bindParam(":image", $data["image"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $data["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":buyingPrice", $data["buyingPrice"], PDO::PARAM_STR);
		$stmt->bindParam(":sellingPrice", $data["sellingPrice"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}
		
		$stmt = null;

	}

	/*=============================================
	               EDITING PURCHASE
	=============================================*/

	static public function mdlEditPurchases($table, $data){

		$stmt = Connection::connect()->prepare("UPDATE $table SET idSupplier = :idSupplier, idDescription = :idDescription, image = :image, stock = :stock, buyingPrice = :buyingPrice, sellingPrice = :sellingPrice WHERE code = :code");

		$stmt->bindParam(":idSupplier", $data["idSupplier"], PDO::PARAM_INT);
		$stmt->bindParam(":code", $data["code"], PDO::PARAM_INT);
		$stmt->bindParam(":idDescription", $data["idDescription"], PDO::PARAM_STR);
		$stmt->bindParam(":image", $data["image"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $data["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":buyingPrice", $data["buyingPrice"], PDO::PARAM_STR);
		$stmt->bindParam(":sellingPrice", $data["sellingPrice"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt = null;

	}
	
	/*=============================================
	              DELETING PURCHASE
	=============================================*/

	static public function mdlDeletePurchases($table, $data){

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