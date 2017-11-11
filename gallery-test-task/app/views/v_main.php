<!DOCTYPE html>
<html>
<head>
	<link rel='stylesheet' type='text/css' href='<?=L_PATH_VIEW?>/css.css'/>
	<title><?=$title?></title>
</head>
<body>
	<div id='all'>
		<div id='head'>
			<h1>Галерея картинок</h1>
			<div id='m'><a href="/" >Главная</a> | <a href="/index.php?action=add">Добавить картинку</a></div>
			<hr>
		</div>
		<div id="content">
			<b><?if(isset($error) && !empty($error)) echo $error;?></b>
		<?=$content?>
		</div>
		<div id="foot">
			<hr>
			<small>
				<a href="">AVolkov</a> &copy
			</small>
		</div>
	</div>
</body>
</html>