$(function(){    $(".ma-service-form")        .on('click','.add-btn',function(){            var id=$(this).parent().find('#ma-id').val();            var service_id=$(this).parent().find('#select_service').val();            var service_name=$(this).parent().find('#select_service').find("option:selected").text();            //var json_id=[{'id':id,'is_delete_user':'true'}];            var json_id="ma_id="+id+"&is_add_ma_service=true&service_id="+service_id;            $this_btn=$(this);            //Ajax            var url = "ma_service.php";            $.ajax({                type: "post",                url: url,                //dataType: "json",                data: json_id,                success: function (msg) {                    $this_btn.parent().parent().before("<tr><td align='center'>"+service_name+"</td> </tr>");                },                error: function () {                    alert('Error in ajax');                }            });        });});