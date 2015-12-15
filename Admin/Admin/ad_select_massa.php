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
    <title>技师查询</title>
</head>
<body>
<?php
    require_once "db_func.php";
    $con = DBconnect();
    $_SESSION['masaid'] = null;
    $select_all_m_name = "SELECT * FROM MassagistDetail ";
?>
<center>
<form id="ad_select" action="ad_select_massa_action.php" method="post">
    <p>
        技师姓名:
        <select id="selec_massagist" name="ad_select_massa">
            <?php
            $massa_name = array();
            $rs = mysql_query($select_all_m_name);
            $nr = mysql_num_rows($rs);
            echo "<option disabled selected> -- select an option -- </option>";
            for ($i=0; $i<$nr; $i++){
                $r = mysql_fetch_array($rs);
                $massa_name[$i] = $r['name'];
                echo "<option value= " .$r["phone"] .">".$r["name"]."</option>";
            }
            ?>
        </select>
        <input type="submit"/>
        <input type="reset"/>
    </p>

    </form>
</center>
</body>
</html>