
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>查询订单</title>
</head>
<body>

<center>
	<form id = "select_order" action = "ad_select_order_action.php" method="post">
	<p>订单查询:</p>
		<p>月份:
			<select name = "month" id = "month">
				<option value = "01" > January </option>
				<option value = "02" > February </option>
				<option value = "03" > March </option>
				<option value = "04" > April </option>
				<option value = "05" > May </option>
				<option value = "06" > June </option>
				<option value = "07" > July </option>
				<option value = "08" > August </option>
				<option value = "09" > September </option>
				<option value = "10" > October </option>
				<option value = "11" > November </option>
				<option value = "12" > December </option>
		</select>
		</p>
		<p>年份:
			<select name = "year" id = "year">
				<option value = "2015" > 2015 </option>
				<option value = "2016" > 2016 </option>
				<option value = "2017" > 2017 </option>
				<option value = "2018" > 2018 </option>
				<option value = "2019" > 2019 </option>
				<option value = "2020" > 2020 </option>
				<option value = "2021" > 2021 </option>
				<option value = "2022" > 2022 </option>
				<option value = "2023" > 2023 </option>
				<option value = "2024" > 2024 </option>
				<option value = "2025" > 2025 </option>
				<option value = "2026" > 2026 </option>
			</select>
		</p>
	<input type="submit"/>
	<input type="reset"/>
	</form>
</center>
</body>
</html>