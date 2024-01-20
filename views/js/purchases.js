/*=============================================
        LOAD DYNAMIC PURCHASE TABLE
=============================================*/

var Profile = $('#Profile').val();

$('.purchaseTable').DataTable({

   "ajax": "ajax/datatable-purchases.ajax.php?Profile="+Profile, 
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

$("#newBuyingPurchasePrice, #editBuyingPurchasePrice").change(function(){

   if($(".percentage").prop("checked")){

       var valuePercentage = $(".newPercentage").val();
       
       var percentage = Number(($("#newBuyingPurchasePrice").val()*valuePercentage/100))+Number($("#newBuyingPurchasePrice").val());

       var editPercentage = Number(($("#editBuyingPurchasePrice").val()*valuePercentage/100))+Number($("#editBuyingPurchasePrice").val());

       $("#newSellingPurchasePrice").val(percentage);
       $("#newSellingPurchasePrice").prop("readonly",true);

       $("#editSellingPurchasePrice").val(editPercentage);
       $("#editSellingPurchasePrice").prop("readonly",true);
   }
})

/*=============================================
            PERCENTAGE CHANGE
=============================================*/

$(".newPercentage").change(function(){

   if($(".percentage").prop("checked")){

       var valuePercentage = $(this).val();
       
       var percentage = Number(($("#newBuyingPurchasePrice").val()* valuePercentage/100)) + Number($("#newBuyingPurchasePrice").val());

       var editPercentage = Number(($("#editBuyingPurchasePrice").val() * valuePercentage/100)) + Number($("#editBuyingPurchasePrice").val());

       $("#newSellingPurchasePrice").val(percentage);
       $("#newSellingPurchasePrice").prop("readonly",true);

       $("#editSellingPurchasePrice").val(editPercentage);
       $("#editSellingPurchasePrice").prop("readonly",true);

   }

})

$(".percentage").on("ifUnchecked",function(){

   $("#newSellingPurchasePrice").prop("readonly",false);
   $("#editSellingPurchasePrice").prop("readonly",false);

})

$(".percentage").on("ifChecked",function(){

   $("#newSellingPurchasePrice").prop("readonly",true);
   $("#editSellingPurchasePrice").prop("readonly",true);

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

$(".purchaseTable tbody").on("click", "button.btnEditPurchase", function(){

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
       
       var supplierData = new FormData();
       supplierData.append("idSupplier",answer["idSuppliers"]);

        $.ajax({

           url:"ajax/suppliers.ajax.php",
           method: "POST",
           data: supplierData,
           cache: false,
           contentType: false,
           processData: false,
           dataType:"json",
           success:function(answer){
              
               $("#editSupplier").html(answer["Supplier"]);
                 $("#editSupplier").val(answer["id"]);
           }
       });

       var productData = new FormData();
       productData.append("idProduct",answer["idDescription"]);

        $.ajax({

           url:"ajax/products.ajax.php",
           method: "POST",
           data: productData,
           cache: false,
           contentType: false,
           processData: false,
           dataType:"json",
           success:function(answer){
                             
               $("#editDescription").val(answer["id"]);
               $("#editDescription").html(answer["description"]);
           }
       });

        $("#editPurchaseCode").val(answer["code"]);

        $("#editPurchaseStock").val(answer["stock"]);

        $("#editBuyingPurchasePrice").val(answer["buyingPrice"]);

        $("#editSellingPurchasePrice").val(answer["sellingPrice"]);

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

$(".purchaseTable tbody").on("click", "button.btnDeletePurchase", function(){

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
         window.location = "index.php?route=purchases&idPurchase="+idPurchase+"&image="+image+"&Code="+code;
     }
   })
})