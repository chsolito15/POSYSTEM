<?php

require_once "../../../controllers/sales.controller.php";
require_once "../../../models/sales.model.php";

require_once "../../../controllers/customers.controller.php";
require_once "../../../models/customers.model.php";

require_once "../../../controllers/users.controller.php";
require_once "../../../models/users.model.php";

require_once "../../../controllers/products.controller.php";
require_once "../../../models/products.model.php";

class printBill
{

	public $code;

	public function getBillPrinting()
	{

		//WE BRING THE INFORMATION OF THE SALE

		$itemSale = "code";
		$valueSale = $this->code;

		$answerSale = ControllerSales::ctrShowSales($itemSale, $valueSale);

		$saledate = substr($answerSale["saledate"], 0, -8);
		$products = json_decode($answerSale["products"], true);
		$netPrice = $answerSale["netPrice"];
		$tax = $answerSale["tax"];
		$totalPrice = $answerSale["totalPrice"];

		//TRAEMOS LA INFORMACIÓN DEL Customer
		//WE BRING THE INFORMATION OF THE CUSTOMER

		$itemCustomer = "id";
		$valueCustomer = $answerSale["idCustomer"];

		$answerCustomer = ControllerCustomers::ctrShowCustomers($itemCustomer, $valueCustomer);

		//TRAEMOS LA INFORMACIÓN DEL Seller
		//WE BRING THE INFORMATION OF THE CUSTOMER

		$itemSeller = "id";
		$valueSeller = $answerSale["idSeller"];

		$answerSeller = ControllerUsers::ctrShowUsers($itemSeller, $valueSeller);

		//REQUERIMOS LA CLASE TCPDF
		//WE REQUIRE THE TCPDF CLASS

		require_once('tcpdf_include.php');

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);

		$pdf->SetFont('dejavusans', '', 11, '', true);

		$pdf->AddPage('L', 'A5');

		//---------------------------------------------------------
		ob_start();

		$block1 = <<<EOD

<table cellspacing="0" cellpadding="" border="0">

	<tr>
	
		<td colspan="2"> 
			<strong>POS System </strong>
		</td>
		
		<td></td>

		<td> 
			Invoice: 		
		</td>	
			
	</tr>

	<tr>
	
		<td colspan="2"> 
			Address: 86 Bel Meadow Drive
		</td>
		
		<td></td>

		<td> 
			ID: #$valueSale
			
		</td>	
			
	</tr>

	<tr>
	
		<td colspan="2"> 
			Contact: 300 786 52 49
		</td>
		
		<td></td>

		<td> 
			Date: $saledate
			
		</td>	
			
	</tr>

	<tr>
	
		<td colspan="2"> 
			Customer:# $answerCustomer[idDocument]
		</td>
		
		<td></td>

		<td> 
			Seller: $answerSeller[name]		
		</td>	

	</tr>

</table>

EOD;

		$pdf->writeHTMLCell(0, 0, '', '', $block1, 0, 1, 0, true, 'L', true);

		$block2 = <<<EOD

		<br><br>

<table cellspacing="0" cellpadding="8" border="1" style="border-color:red;">

			<tr style="background-color:green;color:white;">
				<td>
					No. 
				</td>

				<td>
					Description
				</td>
		
				<td>
					Quantity
				</td>
		
				<td>
					Unity Price
				</td>
				
				<td>
					Amount
				</td>
		
			</tr>
		
		</table>
		
EOD;

		$pdf->writeHTMLCell(0, 0, '', '', $block2, 0, 1, 0, true, 'C', true);



		foreach ($products as $key => $item) {

			$key++;

			$unitValue = number_format($item["price"], 2);

			$totalPrice = number_format($item["totalPrice"], 2);

			$block3 = <<<EOD

<table cellspacing="0" cellpadding="0" border="1">

	<tr>
	
		<td>
			$key 
		</td>
		<td>
			$item[description] 
		</td>

		<td>
			$item[quantity]
		</td>

		<td>
			$unitValue
		</td>
		
		<td>
			$totalPrice
		</td>

	</tr>

</table>

EOD;

			$pdf->writeHTMLCell(0, 0, '', '', $block3, 0, 1, 0, true, 'C', true);
		}

		// ---------------------------------------------------------

		if ($netPrice && $tax) {
			$totalPrice = $netPrice + $tax;
		}

		$block4 = <<<EOD

		<br><br>

<table cellspacing="0" cellpadding="0" border="0">

	

	<tr>
		
		<td colspan="3"></td>
	
		<td>
			 SubTotal
		</td>

		<td>
			$ $netPrice
		</td>

	</tr>


	<tr>

		<td colspan="3"></td>
	
		<td>
			 TAX: 
		</td>

		<td>
			$ $tax
		</td>

	</tr>

	
	<tr>

		<td colspan="3"></td>
	
		<td>
			 Total Amount: 
		</td>

		<td>
			<strong>$$totalPrice</strong>
		</td>

	</tr>
		
	<p>Thank you for your purchase!</p>

</table>

EOD;

		$pdf->writeHTMLCell(0, 0, '', '', $block4, 0, 1, 0, true, 'C', true);


		ob_end_clean();

		$pdf->Output('bill.pdf');
	}
}

$bill = new printBill();
$bill->code = $_GET["code"];
$bill->getBillPrinting();
