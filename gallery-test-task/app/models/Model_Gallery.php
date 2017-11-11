<?php
include_once(PATH_MYSQL);
class Model_Gallery{

	private static $instance; 	// ссылка на экземпляр класса
	private $msql; 				// драйвер БД

	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new Model_Gallery();
		
		return self::$instance;
	}
	public function __construct()
	{
		$this->msql = MSQL::Instance();
	}

	public function Get($id = NULL)
	{
		if($id == NULL){ $t = "SELECT * FROM gallery ORDER BY id DESC";
		}else{ 
			$t = sprintf("SELECT * FROM gallery  WHERE id='%d' ", $id);
		}
		$result = $this->msql->Select($t);
		$t = sprintf("SELECT b.tag_name as tag FROM tags_gallery AS a LEFT JOIN tags AS b ON b.id = a.id_tags WHERE id_gallery='%d' ", $result[0]['id']);
		$result2 = $this->msql->Select($t);
		foreach($result2 as $v){
			$arr[] = $v[tag];
		}
		$result[0]['tags'] = implode(',',$arr);
		return $result;
	}
	public function GetByTag($tag)
	{
		$t = sprintf("SELECT a.id_tags, a.id_gallery, b.count, c.path, c.path_mini, c.filename FROM tags_gallery AS a LEFT JOIN tags AS b ON a.id_tags = b.id LEFT JOIN gallery AS c ON c.id = a.id_gallery WHERE b.tag_name='%s'  ", $tag);
		$result = $this->msql->Select($t);
		return $result;
	}
	
	public function Add($data)
	{
		
		$id = $this->msql->Insert('gallery', $data);
		if($id)return $id;
		else return false;
	}
}