$(function(){
	$(".user-form")/*.on('click','#edit-btn',function(){
		//event.preventDefault();

		var json_inputs=$('#email-form').find(":input").serialize();

		//Ajax
		var url = "lab_ajax.php";
		$.ajax({
			type: "post",
			url: url,
			dataType: "json",
			data: json_inputs,
			success: function (msg) {
				alert('sucess');
			},
			error: function () {
				alert('Error in ajax');
			}
		});
	})*/
	.on('click','.delete-btn',function(){
		var id=$(this).parent().parent().find('.phone').html();
		//var json_id=[{'id':id,'is_delete_user':'true'}];
		var json_id="id="+id+"&is_delete_user="+"true";
		$this_btn=$(this);
		
		//Ajax
		var url = "lab_ajax.php";
		$.ajax({
			type: "post",
			url: url,
			dataType: "json",
			data: json_id,
			success: function (msg) {
				//alert('succ in ajax');
				$this_btn.parent().parent().remove();
			},
			error: function () {
				alert('Error in ajax');
			}
		});

	})

	.on('click','.edit-btn',function(){
		$phone=$(this).parent().parent().find('.phone');
		var id=$phone.html();

		$pwd=$(this).parent().parent().find('.pwd');
		var password=$pwd.html();

		$name_massa=$(this).parent().parent().find('.name_ma');
		var name_ma = $name_massa.html();

		$levels=$(this).parent().parent().find('.level');
		var level = $levels.html();

		$stars=$(this).parent().parent().find('.stars');
		var star = $stars.html();



		$phone.html('<input class="phone-edit" value="'+id+'"/>');
		$pwd.html('<input class="pwd-edit" value="'+password+'"/>');
		$name_massa.html('<input class="name-ma-edit" value=" '+name_ma+'"/>');
		$levels.html('<input class="level-edit" value="'+level+'"/>');
		$stars.html('<input class="star-edit" value="'+star+'"/>');


	})

	.on('click','.save-btn',function(){
		var old_id=$(this).parent().parent().find('.old_id').val();
		var id=$(this).parent().parent().find('.phone-edit').val();
		var password=$(this).parent().parent().find('.pwd-edit').val();
		var name_massa=$(this).parent().parent().find('.name-ma-edit').val();
		var level=$(this).parent().parent().find('.level-edit').val();
		var stars=$(this).parent().parent().find('.star-edit').val();

		var json_data="old_id="+old_id+"&id="+id+"&pwd="+password+"&name_massa="+name_massa+"&levels="+level+"&stars="+stars+"&is_edit_user="+"true";
		$this_btn=$(this);

		//Ajax
		var url = "lab_ajax.php";
		$.ajax({
			type: "post",
			url: url,
			dataType: "json",
			data: json_data,
			success: function (msg) {
				//alert('succ in ajax');
				$this_btn.parent().parent().find('.phone').html(id);
				$this_btn.parent().parent().find('.pwd').html(password);
				$this_btn.parent().parent().find('.name_ma').html(name_massa);
				$this_btn.parent().parent().find('.level').html(level);
				$this_btn.parent().parent().find('.stars').html(stars);
			},
			error: function () {
				alert('Error in ajax');
			}
		});

	});
});