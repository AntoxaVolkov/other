<?php
/*
Класс-маршрутизатор для определения запрашиваемой страницы.
> цепляет классы контроллеров и моделей;
> создает экземпляры контролеров страниц и вызывает действия этих контроллеров.
*/
class Route
{

	static function start()
	{
		// контроллер и действие по умолчанию
		$controller_name = 'gallery';
		$action_name = 'index';
		
		// Получаем имя контроллера
		if ( !empty($_REQUEST['controller']) )
		{	
			$controller_name = $_REQUEST['controller'];
		}
		
		// получаем имя экшена
		if ( !empty($_REQUEST['action']) )
		{	
			$action_name = $_REQUEST['action'];
		}
		

		// добавляем префиксы
		$action = 'action_'.$action_name;
		$controller = 'Controller_'.ucfirst($controller_name);
		$model = 'Model_'.ucfirst($controller_name);

		// подцепляем файл с классом модели (файла модели может и не быть)

		$model_file = strtolower($model).'.php';
		$model_path = PATH_MODL.$model_file;
		if(file_exists($model_path))
		{
			include $model_path;
		}

		// подцепляем файл с классом контроллера
		$controller_file = $controller.'.php';
		$controller_path = PATH_CONT.$controller_file;
		if(file_exists($controller_path))
		{
			include $controller_path;
		}
		else
		{
			/*
			правильно было бы кинуть здесь исключение,
			но для упрощения сразу сделаем редирект на страницу 404
			*/
			Route::ErrorPage404();
		}
		
		// создаем контроллер
		$controller = new $controller;
		
		if(method_exists($controller,'Request'))
		{
			// вызываем действие контроллера
			$controller->Request($action);
		}
		else
		{
			// здесь также разумнее было бы кинуть исключение
			Route::ErrorPage404();
		}
	
	}

	function ErrorPage404()
	{
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'error/404');
    }
    
}
