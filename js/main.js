$(document).ready(function(){
	function verify_email(email){
	$(".email_error").hide();
     $.ajax({
     	url : "action.php",
     	method : "POST",
     	data : {check_email:1,email:email},
     	 success : function(data){
     	 	alert(data);
     	 	$(".email_error").show();
     	 	if(data == "already_exist"){
     	 		$(".email_error").html("Email Already Exists");
     	 	}else if(data == "invalid_email"){
     	 		$(".email_error").html("Invalid Email Address");
     	 	}else if{data == "Wonderful"{
     	 		$(".email_error").html("Wonderful")
     	 	

     	 	}
     	 }
     })
	}
	$("#customer_email").focusout(function(){
	 var email = $("#customer_email").val();
	 verify_email(email);
	})
	// Register user
	$("#customer_register-form").on("submit",function()){
		$.ajax({
			url : "action.php",
			method : "POST",
			data : $("#customer_register-form").serialise(),
			success : function(data){
				alert(data);
			}
		})
	})
})