<?php
if (!session_id())
{
    session_start();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>客户查询</title>
    <link href="../1210/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body class="sarchbody">
<?php
    require_once "../db_func.php";
    $_SESSION['customer_phone'] = null;
if($_SESSION['admin']==null){
    $url = "../1210/login.php";
    ?>
    <script type="text/javascript">
        alert("请登录！")
        window.location.href=location.href='../1210/login.php';
    </script>
    <?php

}
    $con = DBconnect();
    $select_all_m_name = "SELECT * FROM Customer ";
?>


<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="../1210/index.html">首页</a></li>
        <li><a href="javascript:history.go(-1);">返回</a></li>
    </ul>
</div>

<div class="formbody">
    <form id="ad_select" action="ad_select_custom_action.php" method="post">
        <div class="formtitle"><span>选择客户</span></div>

        <ul class="forminfo">
            <li><label>客户注册ID</label>
                <select id="select_custom" name="ad_select_customer" class="select3">
            <option disabled selected> -- 选择客户 -- </option>
            <?php
                $customer_name = array();
                $rs = mysql_query($select_all_m_name);
                $nr = mysql_num_rows($rs);
            for ($i=0; $i<$nr; $i++){
                        $r = mysql_fetch_array($rs);
//                        $customer_name[$i] = $r['name'];
                        echo "<option>".$r["phone"]."</option>";
                    }
            ?>
            </select>
                <label></label><input name="" type="submit" class="btn" value="查询"/>
            </li>


            </ul>
        </form>
    </div>



<!---->
<!---->
<!---->
<!--<form id="ad_select" action="ad_select_custom_action.php" method="post">-->
<!--    客户:-->
<!--    <select id="select_custom" name="ad_select_customer">-->
<!--        --><?php
//        $customer_name = array();
//        $rs = mysql_query($select_all_m_name);
//        $nr = mysql_num_rows($rs);
//        echo "<option disabled selected> -- select an option -- </option>";
//        for ($i=0; $i<$nr; $i++){
//            $r = mysql_fetch_array($rs);
////            $customer_name[$i] = $r['name'];
//            echo "<option>".$r["phone"]."</option>";
//        }
//        ?>
<!--    </select>-->
<!--    </br>-->
<!--    <input type="submit"/>-->
<!--    <input type="reset"/>-->
<!--</form>-->

</body>
</html>