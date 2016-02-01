$(function() {

	var authorIndex = 0;

	$(".edit-zone .submit-btn, #upload-photo-url-form .submit-btn").click(function (event) {
		
		event.preventDefault();
		$form = this.closest('form');
		jQuery($form).validate();
		if(jQuery($form).valid()){
			var params = jQuery($form).find(":input").serialize();
			//alert(params);

			//Input varifying
			var is_valid = 1;
			params.split('&').forEach(function (param) {
				param = param.split('=');
				var name = param[0];
				var val = param[1];
				if (val == "") {
					alert(name + " cannot be empty!");
					is_valid = 0;
				}
				//$('#fs [name=' + name + ']').val(val);
			});
			if (is_valid == 0) {
				return false;
			}
			//Ajax
			var url = "profile_ajax.php";
			$.ajax({
				type: "post",
				url: url,
				dataType: "json",
				data: params,
				success: function (msg) {
					$('.edit-zone').css('display', 'none');
					if (msg.hasOwnProperty("is_title")) {
						$("#field_title").html(msg.title);
					}
					else if (msg.hasOwnProperty("is_phone")) {
						$("#field_phone").html(msg.phone);
					}
					else if (msg.hasOwnProperty("is_email")) {
						$("#field_email").html(msg.email);
					}
					else if (msg.hasOwnProperty("is_department")) {
						$("#field_department").html(msg.department);
					}
					else if (msg.hasOwnProperty("is_overview")) {
						$("#description_div").html(msg.description);
						$('#description_div').css("display", "block");
						$('#description_form').css("display", "none");
					}
					else if (msg.hasOwnProperty("is_photo_url")) {
						$("#field_photo").attr("src", msg.photo_url);
						hide_upload();
					}
				},
				error: function () {
					alert('Error in ajax');
				}
			});
		}
	});
	
	$("#publication").submit(function(e){

		//console.log("publication form is submitted");
		$("#publication").validate();
		if($("#publication").valid()){
			e.preventDefault();

			var url = "AddGraphDatabaseInterface.php";

			var publication_title = $("#publication input[name = 'publication_title']").val();
			var publication_url = $("#publication input[name = 'publication_url']").val();

			var authorList = [];

			for (var i=0; i<=authorIndex; i++){

				var fstName = "author[" + i + "].firstname";
				var lstName = "author[" + i + "].lastname";
				var affName = "author[" + i + "].affiliation";

				//console.log(fstName);
				//console.log($("#publication input[name = \"" + fstName + "\"]").val());

				authorList.push({
					"firstName": $("#publication input[name = \"" + fstName + "\"]").val(),
					"lastName" : $("#publication input[name = \"" + lstName + "\"]").val(),
					"affiliation" : $("#publication input[name = \"" + affName + "\"]").val(),
				});
			}

			//console.log(authorList);

			var data = {"title": publication_title, "url": publication_url, "people": authorList};

			$.ajax({
				async: false,
				type: "post",
				url: url,
				dataType: "text",
				data: {"data": data},

				success: function(msg){

					//console.log(msg);
					//console.log($("#unifiedname-of-current-person").val());
					loadPublication($("#unifiedname-of-current-person").val());
					show_hint(0);
					hide_dialog();
					//window.location.reload();
				},

				error:function(x,e) {

					if (x.status==0) {
						alert(x.responseText);
					} else if(x.status==404) {
						alert('Requested URL not found.');
					} else if(x.status==500) {
						alert('Internel Server Error.');
					} else if(e=='parsererror') {
						alert('Error. Parsing JSON Request failed.');
						alert()
					} else if(e=='timeout'){
						alert('Request Time out.');
					} else {
						alert('Unknow Error: '+x.responseText);
					}
				}
			});
		}
		return false;
	});

	$("#publication")
			.on('click', '.addButton', function () {
				authorIndex++;
				var $template = $('#AuthorTemplate'),
						$clone = $template
								.clone()
								.removeClass('hide')
								.removeAttr('id')
								.attr('data-author-index', authorIndex)
								.insertBefore($template);
				
				$clone
						.find('[name="firstname"]').attr('name', 'author[' + authorIndex + '].firstname').end()
						.find('[name="lastname"]').attr('name', 'author[' + authorIndex + '].lastname').end()
						.find('[name="affiliation"]').attr('name', 'author[' + authorIndex + '].affiliation').end();

			})

			// Remove button click handler
			.on('click', '.removeButton', function () {
				var $row = $(this).parents('.form-group'),
						index = $row.attr('data-author-index');

				// Remove element containing the fields
				$row.remove();
				authorIndex--;
			});
	/*
	$("#add-publication-btn").click(function(event) {
		event.preventDefault();
		$form=this.closest('form');
		var params = jQuery($form).find(":input").serialize();
		alert(params);
		var url = "publication_ajax.php";
		$.ajax({
			type: "post",
			url: url,
			dataType: "json",
			data: params,
			success: function(msg){			
				alert(msg.publication_url);
			},
			error: function(){  
				alert('Error in ajax');  
			}
		});
	});
	*/
});

function show_icon(){
	//if(window.edit_icon==0){
		$('.edit-btn').css('visibility','visible');
		$('#profile-photo span').css('visibility','visible');
		$('.edit-btn').css('visibility','visible');
		window.edit_icon=1;
		$('#profile-overview').mouseleave(function(){
			$('.edit-btn').css('visibility','hidden');
			$('#profile-photo span').css('visibility','hidden');
		});

		//Added By Haotian
		//$('#publication-block').mouseleave(function(){
			//$('.edit-btn').css('visibility', 'hidden');
		//});
	//}
}
function show_dialog(type){
	window.edit_icon=1;
	//$('.edit-btn').css('visibility','hidden');
	if(type==0){
		$('#title').css('display','inline');
	}
	else if(type==1){
		$('#phone').css('display','inline');
	}
	else if(type==2){
		$('#email').css('display','inline');
	}
	else if(type==3){
		$('#department').css('display','inline');
	}
	else if(type==4){
		$('#description_div').css("display","none");
		$('#description_form').css("display","block");
		$('#description-btns').css('visibility','visible');
		$('.flex-text-wrap').css('display','block');
	}
	else if(type == 5){
		//$('.publication-add-zone').css('display', 'block');
		$('.publication-add-zone').slideDown("1000");
	}
}
function hide_dialog(){
	//window.edit_icon=0;
	$('.edit-zone').css('display','none');

	//Added by Haotian
	$('.publication-add-zone').slideUp("1000");
}
function show_upload(){
	$('#upload-photo').css('display','inline');
}
function hide_upload(){
	$('#upload-photo').css('display','none');
}
function enable_description(){
	$('.field-content textarea').removeAttr("disabled");
	$('#description-btns').css('visibility','visible');
}
function disable_description(){
	$('#description_div').css("display","block");
	$('#description_form').css("display","none");
	$('#description-btns').css('visibility','hidden');
	$('.flex-text-wrap').css('display','none');
}
function show_hint(position){
	//var height = document.documentElement.clientHeight;
	if(position==0){
		//$('#hint-success-publication').css("position","absolute");
		//$('#hint-success-publication').css("top",height);
		$('#hint-success-publication').css("display","block");
		setTimeout(function(){
			$('#hint-success-publication').slideUp("fast");
		},2500);
	}
}