<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
		<link rel="stylesheet" href="css/main.css">
		<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
		<script type="text/javascript" src="js/request.js"></script>
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<meta charset="utf-8">
		<title>Smartis</title>
	</head>
	<body>
		<h1>График изменений курса валюты (доллар США)</h1>
		<form action="/" method="post" id="request">
			<p>Диапазон дат:</p>
			<input type="date" name="startDate" id="startDate" value="<?=date("Y-m-d", strtotime('-180 days'))?>">
			<input type="date" name="endDate" id="endDate" value="<?=date("Y-m-d")?>">
			<input type="submit" value="Запрос">
			<div class="wait"><span>Wait...</span></div>
		</form>
		<div class="result" id="result"></div>
	</body>
</html>
