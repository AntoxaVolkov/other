<?php

class Images 
{
	private static $instance; 
	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new Images();
		
		return self::$instance;
	}
	
	public function UploadImages($file,$name,$path,$size,$max_size = 1490000){
		 $valid_formats = array("jpg", "png", "gif");
		 $ext = substr($name,1 + strrpos($name, "."));
		 $imageinfo = getimagesize($file);
		 if(!in_array($ext,$valid_formats)){
				return false;	
		 }
		 if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg' && $imageinfo['mime'] != 'image/png') {
			return false;
		 }
		 if($size > $max_size){
			return false;
		 }
		 
		 $name = time().str_replace(" ", "_", $name);
		 
		 $uploadfile = ABSOLUTE_PATH.$path . basename($name);
		 if (@move_uploaded_file($file, $uploadfile)) {
		   return array('path'=>$path . $name, 'name' => $name, 'width'=> $imageinfo[0], 'height'=>$imageinfo[1]);
		 } else {
		   return false;
		 }
	}

	public function ResizeImage ($filename, $path_save, $new_filename, $size = 200, $quality = 85)
		{
			/*
			* Адрес директории для сохранения картинки
			*/
			$dir  = ABSOLUTE_PATH.$path_save;
			
			/*
			* Извлекаем формат изображения, то есть получаем 
			* символы находящиеся после последней точки
			*/
			$ext  = strtolower(strrchr(basename($filename), "."));
			
			/*
			* Допустимые форматы
			*/
			$extentions = array('.jpg', '.gif', '.png', '.bmp');
		
			if (in_array($ext, $extentions)) {   
				 $percent = $size; // Ширина изображения миниатюры
			
				 list($width, $height) = getimagesize($filename); // Возвращает ширину и высоту
				 $newheight    = $height * $percent;
				 $newwidth    = $newheight / $width;
			
				 $thumb = imagecreatetruecolor($percent, $newwidth);
			
				 switch ($ext) {
					 case '.jpg':
						 $source = @imagecreatefromjpeg($filename);
						 break;
					
					  case '.gif':
						 $source = @imagecreatefromgif($filename);
						 break;
					
					  case '.png':
						 $source = @imagecreatefrompng($filename);
						 break;
					
					  case '.bmp':
						  $source = @imagecreatefromwbmp($filename);
				  }
		
				/*
				* Функция наложения, копирования изображения
				*/
				imagecopyresized($thumb, $source, 0, 0, 0, 0, $percent, $newwidth, $width, $height);
			
				/*
				* Создаем изображение
				*/
				switch ($ext) {
					case '.jpg':
						imagejpeg($thumb, $dir . $new_filename, $quality);
						break;
						
					case '.gif':
						imagegif($thumb, $dir . $new_filename);
						break;
						
					case '.png':
						imagepng($thumb, $dir . $new_filename, $quality);
						break;
						
					case '.bmp':
						imagewbmp($thumb, $dir . $new_filename);
						break;
				}    
		} else {
			return false;
		}
		
		/* 
		*  Очищаем оперативную память сервера от временных файлов, 
		*  которые потребовались для создания миниатюры
		*/
			@imagedestroy($thumb);         
			@imagedestroy($source);  
				
			return $path_save.$new_filename;
		}
}