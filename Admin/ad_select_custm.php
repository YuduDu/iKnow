<?php
if (!session_id())
{
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>客户查询</title>
</head>
<body>
<?php
require_once "db_func.php";
$_SESSION['customer_phone'] = null;
$con = DBconnect();
$select_all_m_name = "SELECT phone FROM Customer ";
?>
<center>
<form id="ad_select" action="ad_select_custom_action.php" method="post">
    客户:
    <select id="select_custom" name="ad_select_customer">
        <?php
        $customer_name = array();
        $rs = mysql_query($select_all_m_name);
        $nr = mysql_num_rows($rs);
        echo "<option disabled selected> -- select an option -- </option>";
        for ($i=0; $i<$nr; $i++){
            $r = mysql_fetch_array($rs);
            $customer_name[$i] = $r['name'];
            echo "<option>".$r["phone"]."</option>";
        }
        ?>
    </select>
    </br>
    <input type="submit"/>
    <input type="reset"/>
</form>
</center>
</body>
</html>