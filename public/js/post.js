$(document).ready(function(){

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	//Submit post form
	$('#post-form').on('submit',function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: '/add-post',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function(){
				$('#post-content-input').attr('disabled','disabled');
				$('#file-input').attr('disabled','disabled');
				$('#post-submit-btn').attr('disabled','disabled');
				$('#post-form').css('opacity','0.5');
			},
			error:function(data){
				var response = data.responseJSON.message;
				$('#post-content-input').removeAttr('disabled','disabled');
				$('#file-input').removeAttr('disabled','disabled');
				$('#post-submit-btn').removeAttr('disabled','disabled');
				$('#post-form').css('opacity','1');
				$('#post-msg').text(response);
			}
		}).done(function(data){

			console.log(data);

			$('#post-content-input').removeAttr('disabled','disabled');
			$('#file-input').removeAttr('disabled','disabled');
			$('#post-submit-btn').removeAttr('disabled','disabled');
			$('#post-form').css('opacity','1');
			$('#post-msg').text('Success');
			$('#post-form')[0].reset();			

			if(data.content != null){
				content = '<p class="content-'+data.post_id+'">'+ data.content +'</p>'
			}else{
				content = '';
			}

			if(data.image != null){
				image = '<img src="'+data.image+'" height="50" width="50">';
			}else{
				image = '';
			}

			var post = '<div class="post-item-'+data.post_id+' card mb-5">'+ data.user +' '+ content + ' '+ image +'  ' + data.created_at +'</div>';
			
			$(post).hide().prependTo('#posts-section').fadeIn('slow');
		});
	});

	////////////////////////////////////////////////


	//Submit post form
	$('#edit-post-form').on('submit',function(e){
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: '/edit-post',
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			beforeSend: function(){
				$('#edit-post-content-input').attr('disabled','disabled');
				$('#file-input').attr('disabled','disabled');
				$('#post-edit-btn').attr('disabled','disabled');
				$('#edit-post-form').css('opacity','0.5');
			},
			error:function(data){
				var response = data.responseJSON.message;
				$('#edit-post-content-input').removeAttr('disabled','disabled');
				$('#file-input').removeAttr('disabled','disabled');
				$('#post-edit-btn').removeAttr('disabled','disabled');
				$('#edit-post-form').css('opacity','1');
				$('.post-msg').text(response);
			}
		}).done(function(data){

			console.log(data);

			$('#edit-post-content-input').removeAttr('disabled','disabled');
			$('#file-input').removeAttr('disabled','disabled');
			$('#post-edit-btn').removeAttr('disabled','disabled');
			$('#edit-post-form').css('opacity','1');
			$('.post-msg').text('Success');			

			// if(data.content != null){
			// 	content = '<p class="content-'+data.post_id+'">'+ data.content +'</p>'
			// }else{
			// 	content = '';
			// }

			// if(data.image != null){
			// 	image = '<img src="'+data.image+'" height="50" width="50">';
			// }else{
			// 	image = '';
			// }

			// var post = '<div class="post-item-'+data.post_id+' card mb-5">'+ data.user +' '+ content + ' '+ image +'  ' + data.created_at +'</div>';
			
			// $(post).hide().prependTo('#posts-section').fadeIn('slow');
		});
	});

	///////////////////////////////////////////////

	//file type validation
	$("#file-input").change(function() {
		var file = this.files[0];
		var imagefile = file.type;
		var match= ["image/jpeg","image/png","image/jpg", "image/gif"];
		if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2] || (imagefile==match[3])))){
			$('#post-submit-btn').attr('disabled','disabled');
			$('#post-edit-btn').attr('disabled','disabled');
			$('.post-msg').text('The image must be JPEG,JPEG,PNG or GIF format. Max size 2MB.');
			$("#file-input").val('');
		}else{
			$('#post-submit-btn').removeAttr('disabled','disabled');
			$('#post-edit-btn').removeAttr('disabled','disabled');
			$('.post-msg').html('');
		}
	});

	//delete post
	$('#deletePostForm').on('submit',function(e){
		e.preventDefault();
		var id = $('#deletePostID').val();
		$.ajax({
			url:'/delete_post',
			method:'DELETE',
			data:{'id':id}
		}).done(function(data){
			if(data == 'ok'){
				$('#deletePostModal').modal('hide');
				$('.post-item-'+id).fadeOut('slow').remove();
			}
		});
	});
});// end doc ready

//toggle edit post modal
function toggleEditPostModal(id,content,image){

	console.log(content);
	$('#edit-post-content-input').val(content);
	//check for image
	if(image != ''){
		$('#edit-img-preview').attr('src', image);
	}

	$('#editPostID').val(id);
	$('#editPostModal').modal('show');
}
//toggle delete post modal
function toggleDeletePostModal(id){
	// console.log(id);
	$('#deletePostID').val(id);
	$('#deletePostModal').modal('show');
}

//save edit post
function saveEditPost(){
	$('#edit-post-form').submit();
}

//reset
function reset(){
	$('.post-msg').html('');
	$('#post-submit-btn').removeAttr('disabled','disabled');
	$('#post-edit-btn').removeAttr('disabled','disabled');
}