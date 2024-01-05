/*=============================================
EDIT CUSTOMER
=============================================*/

$(".tables").on("click", "tbody .btnEditCustomer", function(){

	var idCustomer = $(this).attr("idCustomer");

	var datum = new FormData();
  
    datum.append("idCustomer", idCustomer);

    $.ajax({

      url:"ajax/customers.ajax.php",
      method: "POST",
      data: datum,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(answer){
      
      	 $("#idCustomer").val(answer["id"]);
	       $("#editCustomer").val(answer["name"]);
	       $("#editIdDocument").val(answer["idDocument"]);
	       $("#editEmail").val(answer["email"]);
	       $("#editPhone").val(answer["phone"]);
	       $("#editAddress").val(answer["address"]);
         $("#editBirthdate").val(answer["birthdate"]);
	  }

  	})

})

/*=============================================
             DELETE CUSTOMER
=============================================*/

$(".tables").on("click", "tbody .btnDeleteCustomer", function(){

	var idCustomer = $(this).attr("idCustomer");
	
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
        if (result.value) {       
            window.location = "index.php?route=customers&idCustomer="+idCustomer;
        }

  })

})