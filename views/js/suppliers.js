/*=============================================
               EDIT CATEGORY
=============================================*/

$(".tables").on("click", "tbody .btneditSupplier", function(){

	var idSupplier = $(this).attr("idSupplier");

	var datum = new FormData();

	datum.append("idSupplier", idSupplier);

	//console.log(idSupplier);

	$.ajax({
		
		url: "ajax/suppliers.ajax.php",
		method: "POST",
      	data: datum,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(answer){
     		
     		// console.log("answer", answer);

     		$("#editSupplier").val(answer["Supplier"]);
            $("#editAddress").val(answer['address']);
            $('#editContact').val(answer['contact']);
     		$("#idSupplier").val(answer["id"]);

     	}

	})

})

/*=============================================
DELETE CATEGORY
=============================================*/
$(".tables").on("click", ".btnDeleteSupplier", function(){

	 var idSupplier = $(this).attr("idSupplier");

	 Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!',

		showClass: {
			backdrop: 'swal2-noanimation', // disable backdrop animation
			popup: '',                     // disable popup animation
			icon: ''                       // disable icon animation
		  },
		  hideClass: {
			popup: '',                     // disable popup fade-out animation
		  }

	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?route=suppliers&idSupplier="+idSupplier;

	 	}

	 })

})