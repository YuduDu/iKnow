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
    <title>技师查询</title>
    <link href="./1210/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
    require_once "db_func.php";
    $con = DBconnect();
    $_SESSION['masaid'] = null;
    $select_all_m_name = "SELECT * FROM MassagistDetail ";
    $massa_name = array();
    $rs = mysql_query($select_all_m_name);
    $nr = mysql_num_rows($rs);
?>

<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="./1210/index.html">首页</a></li>
        <li><a href="javascript:history.go(-1);">返回</a></li>
    </ul>
</div>

<div class="formbody">
    <form id="ad_select" action="ad_select_massa_action.php" method="post">
        <div class="formtitle"><span>选择技师</span></div>
        <ul class="forminfo">
            <li><label>技师姓名</label>
                <select id="selec_massagist" name="ad_select_massa">
                    <option disabled selected> -- select an option -- </option>
                    <?php
                    for ($i=0; $i<$nr; $i++){
                        $r = mysql_fetch_array($rs);
                        $massa_name[$i] = $r['name'];
                        echo "<option value= " .$r["phone"] .">".$r["name"]."</option>";
                    }
                    ?>
                    ?>
                </select>
            </li>
            <li><label></label><input name = "" type="submit" class="btn" value="查询"/>
            <label></label><input name = "" type = "reset" class="btn" value="重置"/> </li>















<!--<center>-->
<!--<form id="ad_select" action="ad_select_massa_action.php" method="post">-->
<!--    <p>-->
<!--        技师姓名:-->
<!--        <select id="selec_massagist" name="ad_select_massa">-->
<!--            --><?php
//            $massa_name = array();
//            $rs = mysql_query($select_all_m_name);
//            $nr = mysql_num_rows($rs);
//            echo "<option disabled selected> -- select an option -- </option>";
//            for ($i=0; $i<$nr; $i++){
//                $r = mysql_fetch_array($rs);
//                $massa_name[$i] = $r['name'];
//                echo "<option value= " .$r["phone"] .">".$r["name"]."</option>";
//            }
//            ?>
<!--        </select>-->
<!--        <input type="submit"/>-->
<!--        <input type="reset"/>-->
<!--    </p>-->
<!---->
<!--    </form>-->
<!--</center>-->
</body>
</html>