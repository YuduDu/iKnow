$(function(){    $(".order-form")        .on('click','.delete-btn',function(){            var id=$(this).parent().parent().find('.orderid').html();            //var json_id=[{'id':id,'is_delete_user':'true'}];            if(confirm("确定要删除该信息吗？删除将不能恢复！")) {                var json_id = "id=" + id + "&is_delete_order=" + "true";                $this_btn = $(this);                //Ajax                if (json_id !== null) {                }                var url = "ad_delete_ord.php";                $.ajax({                    type: "post",                    url: url,                    data: json_id,                    success: function (msg) {                        //alert('succ in ajax');                        $this_btn.parent().parent().remove();                    },                    error: function () {                        alert('Error in ajax');                    }                });            }            else{                return false;            }        });});