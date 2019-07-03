</div><br><br>
<div class="col-md-12 text-center" id="text">&copy; Copyright 2018 Apexcure Proprietary Limited</div>


<script>
jQuery(window).scroll(function(){
  var vscroll = jQuery(this).scrollTop();
  jQuery('#logotext').css({
    "transform" : "translate(0px, "+vscroll/2+"px)"
    });

    jQuery('#back-image').css({
      "transform" : "translate("+0+vscroll/5+"px, -"+vscroll/12+"px)"
    });

    jQuery('#fore-image').css({
      "transform" : "translate(0px, -"+vscroll/2+"px)"
    });
  });

  function detailsmodal(id){
  var data = {"id" : id};
  jQuery.ajax({
    url:'/eight/includes/detailsmodal.php',
    method : "post",
    data : data,
    success: function(data){
      jQuery('body').append(data);
      jQuery('#details-modal').modal('toggle');
    },
    error: function() {
      alert("Something went wrong");
    }
  });
  }

  function update_trolley(mode,edit_id,edit_size){
    var data = {"mode" : mode, "edit_id" : edit_id, "edit_size" : edit_size};
    jQuery.ajax({
     url : '/eight/admin/parsers/update_trolley.php',
     method : 'post',
     data : data,
     success : function(){location.reload();},
     error : function(){alert("Something went wrong");}
    });
  }

  function add_to_trolley(){
	jQuery('#modal_errors').html("");
	 var size = jQuery('#size').val();
	 var quantity = jQuery('#quantity').val();
	 var available = jQuery('#available').val();
	 var error ='';
	 var data = jQuery('#add_product_form').serialize();
	 if(size == '' || quantity == '' || quantity == 0){
		 error += '<p class="text-danger text-center">You must choose a size and quantity.</p>';
		 jQuery('#modal_errors').html(error);
		 return;
	 }else if(quantity > available){
		 error += '<p class="text-danger text-center">There are only '+available+' available.</p>'
		 jQuery('#modal_errors').html(error);
	    return;
	 }else {
		 jQuery.ajax({
			 url : '/eight/admin/parsers/add_trolley.php',
			 method : 'post',
			 data : data,
			 success : function(){location.reload();},
			 error : function(){alert("Something went wrong");}
		 });
	 }
  }
  /*
    At the top of page there is a search box with search button when user put name of product then we will take the user
    given string and with the help of sql query we will match user given string to our database keywords column then matched product
    we will show
  */
  $("#search_btn").click(function(){
    $("#get_product").html("<h3>Loading...</h3>");
    var keyword = $("#search").val();
    if(keyword != ""){
      $.ajax({
      url   : "navigation.php",
      method  : "POST",
      data  : {search:1,keyword:keyword},
      success : function(data){
        $("#get_product").html(data);
        if($("body").width() < 480){
          $("body").scrollTop(683);
        }
      }
    })
    }
  })
  //end
</script>
</body>
</html>
