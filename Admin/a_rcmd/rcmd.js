$(function(){    $(".news-form")        .on('click','.delete-news-btn',function(){            var id=$(this).parent().parent().find('.id').val();            //var json_id=[{'id':id,'is_delete_user':'true'}];            var json_id="id="+id+"&is_delete_news="+"true";            $this_btn=$(this);            //Ajax            var url = "ad_rcmand_delete.php";            $.ajax({                type: "post",                url: url,                data: json_id,                success: function (msg) {                    //alert('succ in ajax');                    $this_btn.parent().parent().remove();                },                error: function () {                    alert('Error in ajax');                }            });        })        .on('click','.delete-ma-btn',function(){            // var id=$(this).parent().parent().find('.id').val();            var id=$(this).parent().parent().find('.massagistid').val();            //var json_id=[{'id':id,'is_delete_user':'true'}];            var json_id="id="+id+"&is_delete_ma="+"true";            $this_btn=$(this);            //Ajax            var url = "ad_rcmand_delete.php";            $.ajax({                type: "post",                url: url,                data: json_id,                success: function (msg) {                    //alert('succ in ajax');                    $this_btn.parent().parent().remove();                },                error: function () {                    alert('Error in ajax');                }            });        })        .on('click','.delete-service-btn',function(){            // var id=$(this).parent().parent().find('.id').val();            var id=$(this).parent().parent().find('.serviceid').val();            //var json_id=[{'id':id,'is_delete_user':'true'}];            var json_id="id="+id+"&is_delete_service="+"true";            $this_btn=$(this);            //Ajax            var url = "ad_rcmand_delete.php";            $.ajax({                type: "post",                url: url,                data: json_id,                success: function (msg) {                    //alert('succ in ajax');                    $this_btn.parent().parent().remove();                },                error: function () {                    alert('Error in ajax');                }            });        });});