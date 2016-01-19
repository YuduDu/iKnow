
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Lab | MU Research</title>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <!-- CSS customizations -->
<!--    <link href="css/profile.css" rel="stylesheet" />-->
<!--    <link href="mycss/profile_page.css" rel="stylesheet" />-->
<!--    <link href="mycss/lab_page.css" rel="stylesheet" />-->
<!--	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />-->
<!--	<link href="mycss/style.css" rel="stylesheet" />-->

    
<!--    <script src="javascript/cytoscape.js"></script>-->
<!--    <script src="javascript/jquery.blockUI.js"></script>-->
<!--    <script src="javascript/network.js"></script>-->

	<script src="myjavascript/jquery.validate.min.js"></script>
    <script src="myjavascript/profile_page.js"></script>
    <script src="myjavascript/lab_page.js"></script>
</head>

<body style="margin-left: 10%; margin-right: 10%">

<table border="1px">
<?php
    require_once "../db_func.php";
    $con = DBconnect();
    $sql= "select Massagist.`phone`,MassagistDetail.name as name_mass, Shop.name as name_shop, Massagist.`password` ,MassagistDetail.city, `level`, stars from (Massagist inner join MassagistDetail on Massagist.phone = MassagistDetail.phone) inner join Shop on Shop.shopid = MassagistDetail.shopid;";
    $result = mysql_query( $sql, $con );
    $i = 1;
?>
    <tr>
        <td>序号</td>
        <td>手机号</td>
        <td>密码</td>
        <td>姓名</td>
        <td>所属商家</td>
        <td>所在城市</td>
        <td>级别</td>
        <td>星级</td>
        <td>删除</td>
        <td>编辑</td>
    </tr>

    <?php
    while ($row = mysql_fetch_assoc($result))
    {
        ?>
        <tr class="user-form">

                <td class="id"><?php echo $i;?> </td>

                <td class="phone" ><?php echo $row['phone'];?></td>
                <td class="pwd"> <?php echo $row['password'];?></td>
                <td class="name_ma"><?php echo $row['name_mass'];?></td>
                <td class="name_shop"><?php echo $row['name_shop'];?></td>
                <td class="city"><?php echo $row['city'];?></td>
                <td class="level"><?php echo $row['level'];?></td>
                <td class="stars"><?php echo $row['stars'];?></td>
                <td>
                    <input type="button" value="删除" class = "delete-btn">
                </td>
                 <td>
                    <input type="button" value="编辑" class = "edit-btn">
                    <input type="button" value="保存" class = "save-btn">
                </td>
                <input type="hidden" value="<?php echo $row['phone'];?>" class = "old_id">
        </tr>
<?php
    $i++;
    }?>
	
</body>
</html>
