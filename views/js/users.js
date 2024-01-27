/*=============================================
            UPLOADING USER PICTURE
=============================================*/

$(".newPics").change(function(){

	var newImage = this.files[0];

	/*===============================================
	=            validating image format            =
	===============================================*/
	
	if (newImage["type"] != "image/jpeg" && newImage["type"] != "image/png"){

		$(".newPics").val("");

		Swal.fire({
			type: "error",
			title: "Error uploading image",
			text: "Image has to be JPEG or PNG!",
			icon: 'error',
			timer: 1000
		});

	}else if(newImage["size"] > 2000000){

		$(".newPics").val("");

		Swal.fire({
			title: "Error uploading image",
			text: "Image too big. It has to be less than 2Mb!",
			type: "error",
			icon: 'error',
			timer: 1000
		});

	}else{

		var imgData = new FileReader;

		imgData.readAsDataURL(newImage);

		$(imgData).on("load", function(event){
			
			var routeImg = event.target.result;

			$(".preview").attr("src", routeImg);

		});

	}
		
	/*=====  End of validating image format  ======*/
	
})

/*=============================================
            EDITING USER PICTURE
=============================================*/

$(document).on("click", ".btnEditUser", function(){

 	var idUser = $(this).attr("idUser");

 	var data = new FormData();

 	data.append("idUser", idUser);

 	$.ajax({

 		url: "ajax/users.ajax.php",
 		method: "POST",
 		data: data,
 		cache: false,
 		contentType: false,
 		processData: false,
 		dataType: "json",
 		success: function(answer){
 			
 		 //console.log("answer", answer);

 			$("#EditName").val(answer["name"]);

 			$("#EditUser").val(answer["username"]);

 			$("#EditProfile").html(answer["profile"]);

 			$("#EditProfile").val(answer["profile"]);

 			$("#currentPasswd").val(answer["password"]);

 			$("#currentPicture").val(answer["photo"]);
 			
 			if(answer["photo"] != ''){

 				$('.preview').attr('src', answer["photo"]);

 			}

 		}

 	});

 });

/*=============================================
               ACTIVATE USER
=============================================*/

$(document).on("click", ".btnActivate", function(){

	var userId = $(this).attr("userId");
	var userStatus = $(this).attr("userStatus");

	var datum = new FormData();
 	datum.append("activateId", userId);
  	datum.append("activateUser", userStatus);

  	$.ajax({

	  url:"ajax/users.ajax.php",
	  method: "POST",
	  data: datum,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(answer){
    
			Swal.fire({
				title: 'Your work has been saved',
				type: "success",
				icon: 'success',
				timer: 1000
			})	
      }

  	})

  	if(userStatus == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Deactivated');
  		$(this).attr('userStatus',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Activated');
  		$(this).attr('userStatus',0);

  	}

});

/*=============================================
     VALIDATE IF USER ALREADY EXISTS
=============================================*/

$("#newUser").change(function(){

	$(".alert").remove();

	var user = $(this).val();

	var data = new FormData();
	
 	data.append("validateUser", user);

  	$.ajax({

	  url:"ajax/users.ajax.php",
	  method: "POST",
	  data: data,
	  cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(answer){ 

      	// console.log("answer", answer);

      	if(answer){

      		$("#newUser").parent().after('<div class="alert alert-warning">This user is already taken</div>');
      		
      		$("#newUser").val('');
      	}

      }

    });

});

/*=============================================
               DELETE USER
=============================================*/

$(document).on("click", ".btnDeleteUser", function(){

	var userId = $(this).attr("userId");
	var userPhoto = $(this).attr("userPhoto");
	var username = $(this).attr("username");

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
	  }).then((result) => {
		if (result.value) {		
           window.location = "index.php?route=users&userId="+userId+"&username="+username+"&userPhoto="+userPhoto;		  
		}
	  })

});



