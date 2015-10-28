<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>客户查询</title>
</head>
<body>
<?php
require_once "configs.php";
require_once "ad_select.php";
$con = DBconnect();
$select_all_m_name = "SELECT phone FROM Customer ";
?>

<form id="ad_select" action="ad_select.php" method="post">
    客户:
    <select id="select_custom" name="ad_select_customer">
        <?php

        $customer_name = array();
        $rs = mysql_query($select_all_m_name);
        $nr = mysql_num_rows($rs);
        for ($i=0; $i<$nr; $i++){
            $r = mysql_fetch_array($rs);
            $customer_name[$i] = $r['name'];
            echo "<option".(($year==$r["phone"])? ' selected="selected"' : '').">".$r["phone"]."</option>";
        }
        unset($customer_name);
        ?>
    </select>

    <input type="submit"/>
    <input type="reset"/>

</form>
</body>
</html>