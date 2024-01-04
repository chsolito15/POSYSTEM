<?php

require_once "../controllers/suppliers.controller.php";
require_once "../models/suppliers.model.php";

class AjaxSuppliers{

	/*=============================================
	EDIT SUPPLIER
	=============================================*/	

	public $idSupplier;

	public function ajaxEditSuppliers(){

		$item = "id";
		$valor = $this->idSupplier;

		$answer = ControllerSupplier::ctrShowSupplier($item, $valor);

		echo json_encode($answer);

	}
}

/*=============================================
EDIT SUPPLIER
=============================================*/	
if(isset($_POST["idSupplier"])){
	
	$supplier = new AjaxSuppliers();
	$supplier -> idSupplier = $_POST["idSupplier"];
	$supplier -> ajaxEditSuppliers();
}
?>


