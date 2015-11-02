<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>技师查询</title>
</head>
<body>
<?php
    require_once "configs.php";
    require_once "ad_select.php";
    $con = DBconnect();
    $select_all_m_name = "SELECT name FROM MassagistDetail ";
?>
<center>
<form id="ad_select" action="ad_select.php" method="post">
    <p>
        技师姓名:
        <select id="selec_massagist" name="ad_select_massa">
            <?php
            $massa_name = array();
            $rs = mysql_query($select_all_m_name);
            $nr = mysql_num_rows($rs);
            for ($i=0; $i<$nr; $i++){
                $r = mysql_fetch_array($rs);
                $massa_name[$i] = $r['name'];
                echo "<option disabled selected> -- select an option -- </option>";
                echo "<option".(($year==$r["name"])?  : '').">".$r["name"]."</option>";
            }
            unset($massa_name);
            ?>
        </select>
        <input type="submit"/>
        <input type="reset"/>
    </p>

    </form>
</center>
</body>
</html>