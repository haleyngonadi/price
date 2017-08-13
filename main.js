jQuery(function($) { 

var imageURL = "";
var editURL = "";

$('.loading').hide();

$('.uploaded').hide();
$('.end').hide();


$uploadCrop = $('#upload-demo').croppie({
    enableExif: true,
    viewport: {
        width: 100,
        height: 75,
        type: 'square'
    },
    boundary: {
        width: 200,
        height: 200
    }
});


$editCrop = $('#uploader-demo').croppie({
    enableExif: true,
    viewport: {
        width: 100,
        height: 75,
        type: 'square'
    },
    boundary: {
        width: 200,
        height: 200
    }
});

 $('#upload').on('change', function () { 


 	
	var reader = new FileReader();
    reader.onload = function (e) {
    	$uploadCrop.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
    		$('#upload-demo').addClass('upload');
		$('.uploaded').show();

    	});
    	
    }
    reader.readAsDataURL(this.files[0]);
});


$('.uploaded').click(function(e){


	$uploadCrop.croppie('result', {
		type: 'canvas',
		size: 'viewport'
	}).then(function (resp) {

		$('.loading').show();


		$.ajax({
			url: "ajaxpro.php",
			type: "POST",
			data: {"image":resp},
			success: function (data) {
				console.log(data);
				imageURL = data;
						$('.loading').text('Image uploaded.');

				
			}
		});
	});

});




$('.addnew').click(function(e){
$('.additem').toggleClass('allitems');
});

$('.add').click(function(e){
    e.preventDefault();

    var code = $("[name='code']").val();
    var price = $("[name='price']").val();
    var qty = $("[name='quantity']").val();
    var category = $("[name='category']").val();
    var image = $("#upload").val();

    var watts = $("[name='more']").val();
    var remarks = $("[name='remarks']").val();
    var type = $("[name='tag']").val();
    var desc = $("[name='description']").val();


    if (code  === '') {
        $("[name='code']").toggleClass('shake');
        return false;
    }


    else  { 

    	if (image.length > 0) {

    			$uploadCrop.croppie('result', {
		type: 'canvas',
		size: 'viewport'
	}).then(function (resp) {

		$('.loading').show();


		$.ajax({
			url: "ajaxpro.php",
			type: "POST",
			data: {"image":resp},
			success: function (data) {
				imageURL = data;
				

				$('.loading').show().text('Saving Item...');
   
    	  var dataString = 'item_code='+ code + '&item_image='+ imageURL+  '&item_type='+ type+ 
    	  '&item_description='+ desc+ '&item_more='+ watts+ '&item_quantity='+ qty+ '&item_price='+ price+ '&item_remarks='+ remarks;


    	  $.ajax({
        url:'ajaxsubmit.php',
        type:'post',
        data:dataString,
        success:function(data){

        	if (data == 'good') {  
        		success();
        	  }

          else {
			error();

          }
        }
    });


				
			}
		});
	});


    	}

    	else{

    		$('.loading').show().text('Saving Item...');
   
    	  var dataString = 'item_code='+ code + '&item_image='+ imageURL+  '&item_type='+ type+ 
    	  '&item_description='+ desc+ '&item_more='+ watts+ '&item_quantity='+ qty+ '&item_price='+ price+ '&item_remarks='+ remarks;


    	  $.ajax({
        url:'ajaxsubmit.php',
        type:'post',
        data:dataString,
        success:function(data){

        	if (data == 'good') {  
        		success();
        	  }

          else {
			error();

          }
        }
    });


}
    }


});


 $('.end').click(function() {
 	$('.my-box').remove();
 	$('.end').remove();

});

 $('.generate').click(function() {

 	var tea = 'data_table='+ $('table').html();

 	$('.my-box').removeClass('activated');

 $.ajax({
  type: "POST",
  url: "functions.php",
  data: tea,
  beforeSend: function(){
        $('.my-box').html('<div class="progress"><div class="progress-bar progress-bar-success active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">30%</div></div>');
        $('.progress-bar').animate({width: "30%"}, 100);
        $('.generate').html('Generating...');
    },
    success: function(data){  
      
      	$('.generate').html('Generate Again');
            $('.progress-bar').animate({width: "100%"}, 100);
            setTimeout(function(){
                $('.progress-bar').css({width: "100%"});
                setTimeout(function(){
                    $('.my-box').addClass('activated');
                    $('.my-box').html('PDF Generated. Download it <a href="page.pdf" target="blank">here</a>');
					$('.end').show();

                }, 100);
            }, 500);
        
    },
    error: function(request, status, err) {
         $('.my-box').addClass('activated');

        $('.my-box').html((status == "timeout") ? "Timeout" : "error: " + request + status + err);
    }

});
});

 function success() {


 	    var code = $("[name='code']").val();
    var price = $("[name='price']").val();
    var qty = $("[name='quantity']").val();
    var category = $("[name='category']").val();
    var image = $("#upload").val();

    var watts = $("[name='more']").val();
    var remarks = $("[name='remarks']").val();
    var type = $("[name='tag']").val();
    var desc = $("[name='description']").val();


         	var photo = imageURL;

         	if (imageURL) {
         		photo = '<img src='+imageURL+'>';
         	}

         	else {
         	//	photo = '<div class="circle" style="width: 75px; height: 56px; background: #f3f3f3; margin: 0 auto; display: block;"></div>'
         	photo = '';
         	}

    

     if ($('table').length > 0){
         $('<tr data-item="'+code+'"><td><div style="height: 56px; width: 75px; margin: 0 auto;">'+photo+'</div></td><td>'+code+'</td><td>'+desc+ '</td><td>'+type+ '</td><td>'+watts +'</td><td>'+qty +'</td><td>'+price+'</td><td>'+remarks+'</td><td class="edit-table" style="display: none"> <button data-code="'+code+'" class="edit-button change" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil" aria-hidden="true"></i></button> <button data-code="'+code+'" class="edit-button delete" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>').insertBefore('table > tbody > tr:first');

     }

     else {
     		$('.nothing').addClass("shown");
         $('.nothing').html('<table><thead><tr> <th>Photo</th> <th>Item Code</th> <th>Description (LED)</th> <th>Light Type</th> <th>Watts</th> <th>Qty</th> <th>Unit Price</th> <th>Remarks</th> </tr></thead><tr data-item="'+code+'"><td><div style="height: 56px; width: 75px; margin: 0 auto;">'+photo+'</div></td><td>'+code+'</td><td>'+desc+ '</td><td>'+type+ '</td><td>'+watts +'</td><td>'+qty +'</td><td>'+price+'</td><td>'+remarks+'</td><td class="edit-table" style="display: none"> <button data-code="'+code+'" class="edit-button change" data-toggle="modal" data-target="#editModal"><i class="fa fa-pencil" aria-hidden="true"></i></button> <button data-code="<?php echo $row["item_code"]?>" class="edit-button delete" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr></table>');

     }

         $(':input').val('');
         $('.upload-demo').html('');

         $('.loading').hide(0);

          $('.bg-success').show(0).delay(5000).hide(0);
         $('.bg-success').text('The item has successfully been added.');
 }


function error() {
$('.bg-warning').show(0).delay(5000).hide(0);
        $('.bg-warning').text('Oops. Something went wrong!');
}


 $('.editing').click(function() {
 

  if ($(this).html() === "Turn Editing On") {
	$('.editing').html('Turn Editing Off');
	$('.generate').hide();
	$('.edit').show();
	$('.edit-table').show();
  }

  else {
	$('.generate').show();
	$('.editing').html('Turn Editing On');
	$('.edit').hide();
	$('.edit-table').hide();


  
  }

});


  $('#editModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var received = button.data('code') 
  var modal = $(this)
  modal.find('.modal-title').text('Edit Item ' + received);

      		$('.uploader-demo').removeClass('upload');
      		  $("#uploader").val('');


  modal.find('.modal-body').append('<span id="thecode" style="display: none">'+received+'</div>');

 	var recipient = $('#thecode').text();


  $("#code").val(recipient);

  $("#price").val($('tr[data-item="'+recipient+'"] > td:nth-child(7)').text());
  $("#qty").val($('tr[data-item="'+recipient+'"] > td:nth-child(6)').text());
  $("#desc").val($('tr[data-item="'+recipient+'"] > td:nth-child(3)').text());

  $("#tag").val($('tr[data-item="'+recipient+'"] > td:nth-child(4)').text());


  $("#watts").val($('tr[data-item="'+recipient+'"] > td:nth-child(5)').text());
  $("#remarks").val($('tr[data-item="'+recipient+'"] > td:nth-child(8)').text());

$( "#old-image" ).html( $('tr[data-item="'+recipient+'"] > td:first > div').html() );


 $('.modal-footer .btn-success').click(function() {


    var editted = $("#uploader").val();


 	    	if (editted.length > 0) {

    	$editCrop.croppie('result', {
		type: 'canvas',
		size: 'viewport'
	}).then(function (resp) {


		$.ajax({
			url: "ajaxpro.php",
			type: "POST",
			data: {"image":resp},
			success: function (data) {

			$('#loader').show().text('Uploading Image...');
			console.log(recipient);
   
    	  var oldString = 'item_code='+ $("#code").val() + '&item_image='+ data+  '&item_type='+ $("#tag").val()+ 
    	  '&item_description='+ $("#desc").val()+ '&item_more='+ $("#watts").val()+ '&item_quantity='+ $("#qty").val()+ '&item_price='+ $("#price").val()+ '&item_remarks='+ $("#remarks").val();


    	  $.ajax({
        url:'edit.php',
        type:'post',
        data:oldString,
        success:function(result){

        	$('#loader').show().text('Saving Item');

        	if (result == 'good') {  
    $('tr[data-item="'+$('#thecode').text()+'"] > td:nth-child(7)').text($("#price").val());
 	$('tr[data-item="'+$('#thecode').text()+'"] > td:nth-child(6)').text($("#qty").val());
 	$('tr[data-item="'+$('#thecode').text()+'"] > td:nth-child(3)').text($("#desc").val());
 	$('tr[data-item="'+$('#thecode').text()+'"] > td:nth-child(4)').text($("#tag").val());
 	$('tr[data-item="'+$('#thecode').text()+'"] > td:nth-child(5)').text($("#watts").val());
 	$('tr[data-item="'+$('#thecode').text()+'"] > td:nth-child(8)').text($("#remarks").val());
 	$('tr[data-item="'+$('#thecode').text()+'"] > td:first' ).html('<img style="" src="'+data+'">' );
 	$('#loader').show().text('Item Saved').delay(15000).hide();


        	  }

          else {
          	$('#loader').hide();
			modal.find('.modal-body').append('<div class="bg-warning text-white col-md-12">Oops. Something went wrong. Contact Chideraa!</div>');

          }
        }
    });


				
			}
		});
	});


    	}


    	else {
    		    	  var newString = 'item_code='+ $("#code").val() + '&item_image='+ '&item_type='+ $("#tag").val()+ 
    	  '&item_description='+ $("#desc").val()+ '&item_more='+ $("#watts").val()+ '&item_quantity='+ $("#qty").val()+ '&item_price='+ $("#price").val()+ '&item_remarks='+ $("#remarks").val();

    	  $.ajax({
        url:'edit.php',
        type:'post',
        data:newString,
        success:function(data){

        	$('#loader').show().text('Saving Item');

        	if (data == 'good') {  

    $('tr[data-item="'+$('#thecode').text()+'"] > td:nth-child(7)').text($("#price").val());
 	$('tr[data-item="'+$('#thecode').text()+'"] > td:nth-child(6)').text($("#qty").val());
 	$('tr[data-item="'+$('#thecode').text()+'"] > td:nth-child(3)').text($("#desc").val());
 	$('tr[data-item="'+$('#thecode').text()+'"] > td:nth-child(4)').text($("#tag").val());
 	$('tr[data-item="'+$('#thecode').text()+'"] > td:nth-child(5)').text($("#watts").val());
 	$('tr[data-item="'+$('#thecode').text()+'"] > td:nth-child(8)').text($("#remarks").val());


 	        $('#loader').show().text('Item Saved').delay(15000).hide();
			          




        	  }

          else {
          	$('#loader').hide();
			modal.find('.modal-body').append('<div class="bg-warning text-white col-md-12">Oops. Something went wrong. Contact Chideraa!</div>');

          }
        }
    });
    	}



 	
 	

 });



});


 $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('code') 
  var modal = $(this)
  modal.find('.modal-title').text('Item ' + recipient)
  modal.find('.modal-body').html('<span class="deleted">Are you sure you want to delete Item ' + recipient + '?</span>');
  modal.find('.modal-body').append('<span id="deletecode" style="display:none">'+ recipient +'</span>');

 $('.btn-danger').show();
  $('.my-box').remove();


 $('.btn-danger').click(function() {
 	  $.ajax({
        url:'delete.php',
        type:'post',
        data: 'item_code='+$('#deletecode').text(),
        success:function(data){

        if (data == 'deleted') {  
        		modal.find('.modal-body .deleted').text('Item deleted!');
        		 $('.btn-danger').hide();
        		 $('tr[data-item="'+$('#deletecode').text()+'"]').remove();

        	  }

          else {
        		modal.find('.modal-body').text(data + '. Contact Chideraa!');
        		 $('.btn-danger').hide();
			

          }
        }
    });

});


});


$('#exampleModal').on('hidden.bs.modal', function (e) {
  $("#deletecode").remove();
  $('.btn-danger').show();


});

$('#editModal').on('hidden.bs.modal', function (e) {

  $("#thecode").remove();
  $("#price").val('');
  $("#qty").val('');
  $("#desc").val('');

  $("#tag").val('');
  $("#uploader").val('');

  $("#watts").val('');
  $("#remarks").val('');
$( "#old-image" ).html('');


 console.log('Closed');
})


 $('#uploader').on('change', function () { 
 	
	var reader = new FileReader();
    reader.onload = function (e) {
    	$editCrop.croppie('bind', {
    		url: e.target.result
    	}).then(function(){

    		$( "#old-image" ).hide();
    		editURL = e.target.result;

    		$('.uploader-demo').addClass('upload');

    	});
    	
    }
    reader.readAsDataURL(this.files[0]);
});

});