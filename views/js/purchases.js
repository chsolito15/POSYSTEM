/*=============================================
        LOAD DYNAMIC PRODUCTS TABLE
=============================================*/

/* $.ajax({

    url: "ajax/datatable-products.ajax.php",
    success:function(answer){	
        console.log("answer", answer);
    }
}); */

var hiddenProfile = $('#hiddenProfile').val();

$('.purchaseTable').DataTable({

   "ajax": "ajax/datatable-purchases.ajax.php?hiddenProfile="+hiddenProfile, 
   "deferRender": true,
   "retrieve": true,
   "processing": true
});


/*=============================================
           ADDING PRODUCT CODE
=============================================*/

$("#newProductDescription").on('change', function(){

    var ProductDescription = $(this).val();
 
  	var datum = new FormData();

   	datum.append("idProduct", ProductDescription);
 
   	$.ajax({
 
       url:"ajax/products.ajax.php",
       method: "POST",
       data: datum,
       cache: false,
       contentType: false,
      processData: false,
       dataType:"json",
      success:function(answer){
	   
      // console.log("answer", answer);
 
      	if(answer['code']){
   		
              var newCode = answer["code"];
              $("#newPurchaseCode").val(newCode);
 
       	}else{
            var newCode = ProductDescription;
            $("#newPurchaseCode").val(newCode);
 
       	}
				 
       }
 
  	})
});



/*=============================================
           ADDING SELLING PRICE
=============================================*/

$("#newBuyingSupplierPrice, #editBuyingSupplierPrice").change(function(){

   if($(".percentage").prop("checked")){

       var valuePercentage = $(".newPercentage").val();
       
       var percentage = Number(($("#newBuyingSupplierPrice").val()*valuePercentage/100))+Number($("#newBuyingSupplierPrice").val());

       var editPercentage = Number(($("#editBuyingSupplierPrice").val()*valuePercentage/100))+Number($("#editBuyingSupplierPrice").val());

       $("#newSellingSupplierPrice").val(percentage);
       $("#newSellingSupplierPrice").prop("readonly",true);

       $("#editSellingSupplierPrice").val(editPercentage);
       $("#editSellingSupplierPrice").prop("readonly",true);
   }
})

/*=============================================
            PERCENTAGE CHANGE
=============================================*/

$(".newPercentage").change(function(){

   if($(".percentage").prop("checked")){

       var valuePercentage = $(this).val();
       
       var percentage = Number(($("#newBuyingSupplierPrice").val()* valuePercentage/100)) + Number($("#newBuyingSupplierPrice").val());

       var editPercentage = Number(($("#editBuyingSupplierPrice").val() * valuePercentage/100)) + Number($("#editBuyingSupplierPrice").val());

       $("#newSellingSupplierPrice").val(percentage);
       $("#newSellingSupplierPrice").prop("readonly",true);

       $("#editSellingSupplierPrice").val(editPercentage);
       $("#editSellingSupplierPrice").prop("readonly",true);

   }

})

$(".percentage").on("ifUnchecked",function(){

   $("#newSellingSupplierPrice").prop("readonly",false);
   $("#editSellingSupplierPrice").prop("readonly",false);

})

$(".percentage").on("ifChecked",function(){

   $("#newSellingSupplierPrice").prop("readonly",true);
   $("#editSellingSupplierPrice").prop("readonly",true);

})

/*=============================================
       UPLOADING PRODUCT IMAGE
=============================================*/

$(".newImage").change(function(){

   var image = this.files[0];
   
   /*=============================================
     WE VALIDATE THAT THE FORMAT IS JPG OR PNG
     =============================================*/

     if(image["type"] != "image/jpeg" && image["type"] != "image/png"){

         $(".newImage").val("");

          Swal.fire({
             title: "Error uploading image",
             text: "¡The image should be in JPG o PNG format!",
             type: "error",
             confirmButtonText: "¡Close!"
           });

     }else if(image["size"] > 2000000){

         $(".newImage").val("");

          Swal.fire({
             title: "Error uploading image",
             text: "The image shouldn't be more than 2MB!",
             type: "error",
             confirmButtonText: "¡Close!"
           });

     }else{

         var imageData = new FileReader;
         imageData.readAsDataURL(image);

         $(imageData).on("load", function(event){

             var imagePath = event.target.result;

             $(".preview").attr("src", imagePath);

         })

     }
})

/*=============================================
            EDIT PRODUCT
=============================================*/

$(".productsTable tbody").on("click", "button.btnEditProduct", function(){

   var idPurchase = $(this).attr("idPurchase");
   
   var datum = new FormData();

   datum.append("idPurchase", idPurchase);

    $.ajax({

     url:"ajax/purchases.ajax.php",
     method: "POST",
     data: datum,
     cache: false,
     contentType: false,
     processData: false,
     dataType:"json",
     success:function(answer){
       
       // console.log("answer", answer);
         
       var categoryData = new FormData();

       categoryData.append("ProductDescription",answer["ProductDescription"]);

        $.ajax({

           url:"ajax/categories.ajax.php",
           method: "POST",
           data: categoryData,
           cache: false,
           contentType: false,
           processData: false,
           dataType:"json",
           success:function(answer){
               
               $("#editCategory").val(answer["id"]);
               $("#editCategory").html(answer["Category"]);

           }

       })

        $("#editCode").val(answer["code"]);

        $("#editDescription").val(answer["description"]);

        $("#editStock").val(answer["stock"]);

        $("#editBuyingSupplierPrice").val(answer["buyingPrice"]);

        $("#editSellingSupplierPrice").val(answer["sellingPrice"]);

        if(answer["image"] != ""){

              $("#currentImage").val(answer["image"]);

              $(".preview").attr("src",  answer["image"]);

        }

     }

 })

})

/*=============================================
                DELETE PRODUCT
=============================================*/

$(".productsTable tbody").on("click", "button.btnDeleteProduct", function(){

   var idPurchase = $(this).attr("idPurchase");
   var code = $(this).attr("code");
   var image = $(this).attr("image");
   
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
         window.location = "index.php?route=products&idPurchase="+idPurchase+"&image="+image+"&Code="+code;
     }
   })
})