/*=============================================
               EDIT CATEGORY
=============================================*/

$(".tables").on("click", "tbody .btnEditCategory", function(){

	var idCategory = $(this).attr("idCategory");

	var datum = new FormData();

	datum.append("idCategory", idCategory);

	console.log(idCategory);

	$.ajax({
		
		url: "ajax/categories.ajax.php",
		method: "POST",
      	data: datum,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(answer){
     		
     		// console.log("answer", answer);

     		$("#editCategory").val(answer["Category"]);
     		$("#idCategory").val(answer["id"]);

     	}

	})

})

/*=============================================
DELETE CATEGORY
=============================================*/
$(".tables").on("click", ".btnDeleteCategory", function(){

	 var idCategory = $(this).attr("idCategory");

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

	 		window.location = "index.php?route=categories&idCategory="+idCategory;

	 	}

	 })

})